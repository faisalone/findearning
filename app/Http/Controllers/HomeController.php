<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Social;
use App\Models\Slider;
use App\Models\Review;
use App\Models\Newsletter;

class HomeController extends Controller
{
	// public function __construct()
    // {
    //     $this->middleware('auth');
    // }
	
	public function index()
    {
		$categories = Category::where('status', true)
								->orderByRaw('`order` IS NULL ASC')
								->orderBy('order')
								->get();

		// Retrieve top products using getTopProducts and filter by valid category
		$topProducts = Product::getTopProducts(8);
		$topProducts = $topProducts->filter(function($product) {
			return optional($product->category)->status;
		})->values();

        $banners = Slider::all()
            ->map(function($slider) {
                return [
                    'title' => $slider->title,
                    'image' => $slider->image_path,
                    'link' => route('shop')
                ];
            });
		$reviews = Review::where('status', true)
						  ->orderBy('updated_at', 'desc')
						  ->get();
		// Pass the variable to the view
        return view('home.index', compact('categories', 'topProducts', 'banners', 'reviews'));
    }
    
    
    public function allCategory()
    {
        $categories = Category::orderByRaw('`order` IS NULL ASC')
								->orderBy('order')
								->get();

        return view('home.allCategory', compact('categories'));
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
		
        Newsletter::create([
            'email' => $request->email,
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }

}
