<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\PaymentMethod;

class ShopController extends Controller
{
	public function shop()
    {
		$products = Product::select('id', 'category_id', 'title', 'price', 'slug', 'status', 'updated_at')
		->with([
			'category:id,title,slug',
			'images:id,product_id,image',
		])
		->orderBy('updated_at', 'desc')
		->paginate(5);

		// return response()->json($products);
		
		return view('shop.fullWidthShop', compact('products'));
    }

	public function category($slug)
	{
		$category = Category::where('slug', $slug)->firstOrFail();
		$products = $category->products()->paginate(6);
		return view('shop.fullWidthShop', compact('category', 'products'));
	}

	public function productDetails(string $category, string $product)
	{
		$product = Product::with('category')
			->where('slug', $product)
			->whereHas('category', function($query) use ($category) {
				$query->where('slug', $category);
			})
			->first();

		if (! $product) {
			return response()->json([
				'error'   => 'Product not found.',
				'message' => "No product matching '{$product}' in category '{$category}' was found."
			], 404);
		}
		// return response()->json($product->imagePaths);
		
		return view('shop.productDetails', compact('product'));
	}


    public function account()
    {
        return view('shop.account');
    }
    
    public function cart()
    {
        $cart = session('cart', []);
        $cartItems = [];
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'product'  => $product,
                    'quantity' => is_array($item) && isset($item['quantity']) ? $item['quantity'] : $item,
                ];
            }
        }
        return view('shop.cart', compact('cartItems'));
    }
    
    public function checkOut()
    {
        $cart = session('cart', []);
        $cartItems = [];
        $subtotal = 0;
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $quantity = is_array($item) && isset($item['quantity']) ? $item['quantity'] : $item;
                $cartItems[] = [
                    'product'  => $product,
                    'quantity' => $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        }
        // Fetch active payment methods from DB
        $paymentMethods = PaymentMethod::where('status', true)->get();
        return view('shop.checkOut', compact('cartItems', 'subtotal', 'paymentMethods'));
    }

	public function thankYou(Order $order)
    {
        return view('home.thankYou', compact('order'));
    }
    
    public function fullWidthShop()
    {
        return view('shop.fullWidthShop');
    }


    public function addToCart(Request $request)
    {
        $quantity = (int)$request->input('quantity', 1);
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        $productId = $product->id;

        if (isset($cart[$productId])) {
            // Add the quantity from input field to the existing quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
                'product'  => $product->id
            ];
        }
        
        session()->put('cart', $cart);
        
        $uniqueCount = count($cart);
        
        if ($request->ajax()) {
            return response()->json(['count' => $uniqueCount]);
        }

        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->product_id;
        $cart = session('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        $uniqueCount = count($cart);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'count' => $uniqueCount]);
        }
        return redirect()->back();
    }

    public function updateCart(Request $request) {
        $productId = $request->product_id;
        $newQuantity = max(1, (int)$request->quantity); // ensure at least 1
        $cart = session()->get('cart', []);

        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $newQuantity;
            session()->put('cart', $cart);
        }

        $uniqueCount = count($cart);
        return response()->json([
            'success' => true,
            'newQuantity' => $newQuantity,
            'count' => $uniqueCount,
        ]);
    }
    
}
