<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Wallet; // Added Wallet model
use App\Http\Middleware\AdminMiddleware; // Added AdminMiddleware
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Cleaner constructor using only the admin middleware (which checks auth)
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->except(['createOrder', 'thankYou']);
    }

    public function createOrder(Request $request)
    {
		// return $request->all();
        // Dynamic validation rules based on delivery method
        $validationRules = [
            'name' => 'required|string|max:255',
            'delivery_method' => 'required|string',
            'payment_option' => 'required|string',
            'proof' => $request->input('payment_option') === 'Wallet'
                        ? 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
                        : 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'order_notes' => 'nullable|string',
        ];

        if ($request->delivery_method === 'email') {
            $validationRules['email'] = 'required|email|max:255';
            $validationRules['contact'] = 'nullable|string|max:255';
        } else {
            $validationRules['contact'] = 'required|string|max:255';
            $validationRules['email'] = 'nullable|email|max:255';
        }

        $validator = \Validator::make($request->all(), $validationRules);

        // After hook: if payment_option is Wallet, ensure the wallet exists for the user.
        $validator->after(function($validator) use ($request) {
            if ($request->payment_option === 'Wallet') {
                $user = auth()->check()
                    ? auth()->user()
                    : User::where('email', $request->email)
                          ->orWhere('contact', $request->contact)
                          ->first();
                if (!$user || !Wallet::where('user_id', $user->id)->exists()) {
                    $validator->errors()->add('payment_option', 'No wallet found.');
                }
            }
        });

        $validator->validate();

        // Check both the buy_now_product and regular cart
        $productDetails = [];
        $total = 0;
        $outOfStockItems = [];
        
        // Check if we have a buy now product
        $buyNowProduct = session('buy_now_product');
        if ($buyNowProduct) {
            $product = Product::find($buyNowProduct['product_id']);
            if ($product) {
                $quantity = $buyNowProduct['quantity'];
                
                // Check stock
                if ($product->quantity < $quantity) {
                    $outOfStockItems[] = [
                        'product' => $product->title,
                        'requested' => $quantity,
                        'available' => $product->quantity
                    ];
                } else {
                    $productDetails[] = ['id' => $product->id, 'quantity' => $quantity];
                    $total += $product->price * $quantity;
                }
            }
        } else {
            // If no buy now product, check the cart
            $cart = session('cart', []);
            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $quantity = is_array($item) && isset($item['quantity']) ? $item['quantity'] : $item;
                    
                    // Check if enough stock is available
                    if ($product->quantity < $quantity) {
                        $outOfStockItems[] = [
                            'product' => $product->title,
                            'requested' => $quantity,
                            'available' => $product->quantity
                        ];
                        continue;
                    }
                    
                    $productDetails[] = ['id' => $productId, 'quantity' => $quantity];
                    $total += $product->price * $quantity;
                }
            }
        }
        
        // If any products are out of stock, return with error
        if (!empty($outOfStockItems)) {
            $errorMessage = 'The following items are out of stock or have insufficient quantity:';
            foreach ($outOfStockItems as $item) {
                $errorMessage .= "\n• {$item['product']}: Requested {$item['requested']}, Available {$item['available']}";
            }
            return redirect()->back()->withErrors(['stock_error' => $errorMessage])->withInput();
        }

        // After collecting $productDetails:
        if (empty($productDetails)) {
            return redirect()->back()->withErrors(['cart' => 'No product found in Cart or Buy Now session.'])->withInput();
        }

        // Check Wallet balance if payment_option is Wallet
        if ($request->payment_option === 'Wallet') {
            $user = auth()->check()
                ? auth()->user()
                : User::where('email', $request->email)
                      ->orWhere('contact', $request->contact)
                      ->first();
            if ($user) {
                $wallet = Wallet::where('user_id', $user->id)->first();
                if (!$wallet) {
                    return redirect()->back()
                        ->withErrors(['payment_option' => 'No wallet found. Please recharge your eWallet.'])
                        ->withInput();
                }
                if ($wallet->balance === null || $total > $wallet->balance) {
                    return redirect()->back()
                        ->withErrors(['payment_option' => 'Insufficient eWallet balance. Please recharge your eWallet.'])
                        ->withInput();
                }
            }
        }

		// Check if the user is authenticated
		// if (auth()->check()) {
		// 	$userId = auth()->id();
		// } else {
		// 	// Check if the user exists by email or contact
		// 	$user = User::where('email', $request->email)
		// 		->orWhere('contact', $request->contact)
		// 		->first();

		// 	if ($user) {
		// 	$userId = $user->id;
		// 	} else {
		// 	// Create a new user
		// 	$user = User::create([
		// 		'name' => $request->name,
		// 		'email' => $request->email,
		// 		'contact' => $request->contact,
		// 		'password' => Hash::make($request->contact) // Use contact as the default password
		// 	]);
		// 	$userId = $user->id;
		// 	}
		// }

        // Use a database transaction to ensure all operations complete successfully
        DB::beginTransaction();
        
        try {
            // Handle the proof document
            $proofFilename = null;
            if ($request->hasFile('proof')) {
                $proofFilename = $request->file('proof')->store('proofs', 'public');
                $proofFilename = basename($proofFilename); // Store only the filename
            }

            // Deduct wallet balance if payment_option is wallet
            if ($request->payment_option === 'Wallet') {
                $wallet->balance -= $total;
                $wallet->save();
            }

            // Create the order
            $order = Order::create([
				'user_id' => auth()->id(),
                'product_details' => json_encode($productDetails), // Store product details as JSON
                'delivery_method' => $request->delivery_method,
                'customer_name' => $request->name,
                'customer_contact' => $request->contact,
                'customer_email' => $request->email,
                'payment_option' => $request->payment_option,
                'proof' => $proofFilename, // Store only the filename
                'total' => $total, // Calculate total from session
                'order_notes' => $request->order_notes,
                'status' => $request->payment_option === 'Wallet' ? 'processing' : 'pending'
            ]);

            // Decrement product quantities
            foreach ($productDetails as $item) {
                $product = Product::find($item['id']);
                if ($product) {
                    $product->quantity -= $item['quantity'];
                    $product->save();
                    
                    // Optional: Log low stock products that need replenishment
                    if ($product->quantity <= 5) {
                        Log::info("Low stock alert: Product {$product->title} (ID: {$product->id}) has only {$product->quantity} units left.");
                    }
                }
            }
            
            // Commit the transaction if everything is successful
            DB::commit();
            
            // Clear both session variables
            session()->forget(['cart', 'buy_now_product']);

            return redirect()->route('thankYou', ['order' => $order->id]);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();
            Log::error("Error creating order: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while processing your order. Please try again.'])->withInput();
        }
    }

	public function index()
	{
		$orders = Order::with('user')->orderBy('created_at', 'desc')->get();
		return view('dashboard.orders.index', compact('orders'));
	}

    public function edit($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('dashboard.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|string',
        ]);

        // If cancelling the order, refund the order total to the user's wallet
        if ($request->status === 'cancelled' && $order->status !== 'cancelled') {
            $user = $order->user; // Assumes relation exists
            if ($user) {
                $wallet = Wallet::where('user_id', $user->id)->first();
                if (!$wallet) {
                    // Create wallet if not found
                    $wallet = Wallet::create([
                        'user_id' => $user->id,
                        'balance' => 0,
                        // ...other attributes if needed...
                    ]);
                }
                $wallet->balance += $order->total;
                $wallet->save();
            }
        }

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Delete proof file from disk if exists
        if ($order->proof) {
            Storage::disk('public')->delete('proofs/' . $order->proof);
        }
        
        $order->delete();
        
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
