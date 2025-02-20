<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:255',
            'delivery_method' => 'required|string',
            'payment_option' => 'required|string',
            'proof' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'order_notes' => 'nullable|string',
        ]);

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

        // Handle the proof document
        $proofFilename = null;
        if ($request->hasFile('proof')) {
            $proofFilename = $request->file('proof')->store('proofs', 'public');
            $proofFilename = basename($proofFilename); // Store only the filename
        }

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

        // Create the order
        $order = Order::create([
            'user_id' => $userId,
            'product_details' => json_encode($productDetails), // Store product details as JSON
            'delivery_method' => $request->delivery_method,
            'payment_option' => $request->payment_option,
            'proof' => $proofFilename, // Store only the filename
            'total' => $total, // Calculate total from session
            'order_notes' => $request->order_notes,
            'status' => 'pending'
        ]);

        // Destroy the cart session
        session()->forget('cart');

        return response()->json(['success' => true, 'order' => $order], 201);
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
