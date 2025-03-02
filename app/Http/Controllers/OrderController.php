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

        // Conditionally add validation for email and contact fields
        if ($request->delivery_method === 'email') {
            $validationRules['email'] = 'required|email|max:255';
            $validationRules['contact'] = 'nullable|string|max:255';
        } else {
            $validationRules['contact'] = 'required|string|max:255';
            $validationRules['email'] = 'nullable|email|max:255';
        }

        // Validate the request with conditional rules
        $request->validate($validationRules);

        // Collect product details from the cart and calculate the total
        $cart = session('cart', []);
        $productDetails = [];
        $total = 0;

        // Check if products are in stock before proceeding
        $outOfStockItems = [];
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
        
        // If any products are out of stock, return with error
        if (!empty($outOfStockItems)) {
            $errorMessage = 'The following items are out of stock or have insufficient quantity:';
            foreach ($outOfStockItems as $item) {
                $errorMessage .= "\n• {$item['product']}: Requested {$item['requested']}, Available {$item['available']}";
            }
            return redirect()->back()->withErrors(['stock_error' => $errorMessage])->withInput();
        }

        // Check Wallet balance if payment_option is Wallet
        if ($request->payment_option === 'Wallet') {
            $user = auth()->check() ? auth()->user() : User::where('email', $request->email)->first();
            if ($user) {
                $wallet = Wallet::where('user_id', $user->id)->first();
                if (!$wallet || $wallet->balance === null) {
                    return redirect()->back()
                        ->withErrors(['payment_option' => 'eWallet not found or balance is empty. Please recharge your eWallet.'])
                        ->withInput();
                }
                if ($total > $wallet->balance) {
                    return redirect()->back()
                        ->withErrors(['payment_option' => 'Insufficient eWallet balance. Please Recharge your eWallet.'])
                        ->withInput();
                }
            }
        }

		// Check if the user is authenticated
		if (auth()->check()) {
			$userId = auth()->id();
		} else {
			// Check if the user exists by email or contact
			$user = User::where('email', $request->email)
				->orWhere('contact', $request->contact)
				->first();

			if ($user) {
			$userId = $user->id;
			} else {
			// Create a new user
			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'contact' => $request->contact,
				'password' => Hash::make($request->contact) // Use contact as the default password
			]);
			$userId = $user->id;
			}
		}

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
                'user_id' => $userId,
                'product_details' => json_encode($productDetails), // Store product details as JSON
                'delivery_method' => $request->delivery_method,
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
            
            // Destroy the cart session
            session()->forget('cart');

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
        $orders = Order::with('user')->get();
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

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }
}
