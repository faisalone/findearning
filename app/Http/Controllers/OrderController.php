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

class OrderController extends Controller
{
    // Cleaner constructor using only the admin middleware (which checks auth)
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->except(['createOrder', 'thankYou']);
    }

    public function createOrder(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:255',
            'delivery_method' => 'required|string',
            'payment_option' => 'required|string',
            'proof' => $request->input('payment_option') === 'Wallet'
                        ? 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
                        : 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'order_notes' => 'nullable|string',
        ]);

        // Collect product details from the cart and calculate the total
        $cart = session('cart', []);
        $productDetails = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $quantity = is_array($item) && isset($item['quantity']) ? $item['quantity'] : $item;
                $productDetails[] = ['id' => $productId, 'quantity' => $quantity];
                $total += $product->price * $quantity;
            }
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

        // Destroy the cart session
        session()->forget('cart');

		return redirect()->route('thankYou', ['order' => $order->id]);
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
