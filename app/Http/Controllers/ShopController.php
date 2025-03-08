<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\View;
use App\Traits\ProductSorting;

class ShopController extends Controller
{
    use ProductSorting;
    
    public function shop(Request $request)
    {
        $productsQuery = Product::select('products.*')
            ->with(['category:id,title,slug','images:id,product_id,image'])
            ->active(); // optional if you want only active products

        // Apply sorting via trait
        $productsQuery = $this->applySorting($productsQuery);

        $products = $productsQuery->paginate(8);

        // Check if this is an AJAX request for infinite scroll
        if ($request->ajax() && $request->has('page')) {
            $html = '';
            foreach ($products as $product) {
                // Render the exact same component used in the blade template
                $html .= View::make('components.product-item', ['product' => $product])->render();
            }
            return response()->json([
                'html'        => $html,
                'currentPage' => $products->currentPage(),
                'lastPage'    => $products->lastPage(),
            ]);
        }
        
        return view('shop.fullWidthShop', compact('products'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // Use getQuery() to get a Builder instance instead of a HasMany relationship
        $productsQuery = $category->products();
        
        // Apply sorting
        $productsQuery = $this->applySorting($productsQuery);
        
        $products = $productsQuery->paginate(8);
        
        // Check if this is an AJAX request for infinite scroll
        if (request()->ajax() && request()->has('page')) {
            $html = '';
            foreach ($products as $product) {
                // Render the exact same component used in the blade template
                $html .= View::make('components.product-item', ['product' => $product])->render();
            }
            return response()->json([
                'html'        => $html,
                'currentPage' => $products->currentPage(),
                'lastPage'    => $products->lastPage(),
            ]);
        }

        $title = $category->title;
        
        return view('shop.fullWidthShop', compact('category', 'products', 'title'));
    }

	/**
     * Show the product details page.
     *
     * @param string $category
     * @param string $product
     * @return \Illuminate\View\View
     */
	public function productDetails(string $category, string $product)
	{
		// $topProducts = Product::getTopProducts(9, false);
		// return response()->json($topProducts);
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

        // Load the product with its approved reviews and the users who wrote them
        $product->load(['approvedReviews' => function($query) {
            $query->orderBy('created_at', 'desc');
        }, 'approvedReviews.user']);
		// return response()->json($product->imagePaths);
		
		return view('shop.productDetails', compact('product'));
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
    
    public function checkOut(Request $request)
    {
        if ($request->input('source') === 'cart') {
            session()->forget('buy_now_product');
        }

        $buyNowProduct = session('buy_now_product');
        $cartItems = [];
        $subtotal = 0;

        if ($buyNowProduct) {
            // Only show the buy-now product
            $product = Product::find($buyNowProduct['product_id']);
            if ($product) {
                $quantity = $buyNowProduct['quantity'];
                $cartItems[] = [
                    'product'  => $product,
                    'quantity' => $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        } else {
            $cart = session('cart', []);
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
        }

        // Fetch active payment methods from DB
        $paymentMethods = PaymentMethod::where('status', true)->get();
		// return response()->json($paymentMethods);
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
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'action_type' => 'required|string'
        ]);
        
        $quantity = (int)$request->input('quantity', 1);
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        $productId = $product->id;

        if ($request->input('action_type') === 'buy-now') {
            session()->put('buy_now_product', [
                'quantity' => $quantity,
                'product_id' => $product->id,
            ]);
            return redirect()->route('checkOut');
        }

        // Only add to cart if action_type is add-to-cart
        if ($request->input('action_type') === 'add-to-cart') {
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
                // Return JSON response for AJAX requests
                return response()->json([
                    'success' => true, 
                    'message' => 'Product added to cart',
                    'count' => $uniqueCount  // Using the calculated count instead of Cart facade
                ]);
            }
            return redirect()->back()->with('success', 'Product added to cart');
        }

        return redirect()->back()->with('success', 'Product added to cart');
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
    
    /**
     * Search for products based on query
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categorySlug = $request->input('category');
        
        // Start with base query
        $productsQuery = Product::select('id', 'category_id', 'title', 'price', 'slug', 'status', 'updated_at')
            ->with([
                'category:id,title,slug',
                'images:id,product_id,image',
            ]);
        
        // Search by query
        if ($query) {
            $productsQuery->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('category', function($categoryQuery) use ($query) {
                      $categoryQuery->where('title', 'like', "%{$query}%");
                  });
            });
        }
        
        // Filter by category if provided
        if ($categorySlug) {
            $productsQuery->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        
        // Only active products
        $productsQuery->where('status', true);
        
        // Apply sorting
        $productsQuery = $this->applySorting($productsQuery);
        
        $products = $productsQuery->paginate(8)->withQueryString();
        
        // Check if this is an AJAX request for infinite scroll
        if ($request->ajax() && $request->has('page')) {
            $html = '';
            foreach ($products as $product) {
                // Render the exact same component used in the blade template
                $html .= View::make('components.product-item', ['product' => $product])->render();
            }
            
            return response()->json([
                'html' => $html,
                'lastPage' => $products->lastPage(),
                'currentPage' => $products->currentPage(),
                'totalResults' => $products->total()
            ]);
        }
        
        // Get all categories for filter sidebar
        $categories = Category::where('status', true)->get();
        $title = $query ? "Search results for: {$query}" : "All Products";
        
        return view('shop.fullWidthShop', compact('products', 'query', 'categorySlug', 'categories', 'title'));
    }
    
}
