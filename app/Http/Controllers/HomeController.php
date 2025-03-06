<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Social;
use App\Models\Slider;
use App\Models\Review; // added import

class HomeController extends Controller
{
	// public function __construct()
    // {
    //     $this->middleware('auth');
    // }
	
	public function index()
    {
        $categories = Category::getTopCategories(12);
		$topProducts = Product::getTopProducts(8);
		// $topProducts = Product::getTopProducts(8, false);
        $banners = Slider::all()
            ->map(function($slider) {
                return [
                    'title' => $slider->title,
                    'image' => $slider->image_path,
                    'link' => route('shop')
                ];
            });
		$reviews = Review::where('status', true)->orderBy('updated_at', 'desc')->get(); // Changed from first() to get()
		// Pass the variable to the view
        return view('home.index', compact('categories', 'topProducts', 'banners', 'reviews'));
    }
    
    
    public function allCategory()
    {
        $categories = Category::getTopCategories();

        return view('home.allCategory', compact('categories'));
    }
    
    
	public function contact()
    {

        return view('home.contact', );
    }

}
