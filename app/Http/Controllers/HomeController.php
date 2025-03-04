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
		$categories = Category::select('id', 'title', 'slug', 'image')->take(10)->get();
		$randomProducts = Product::inRandomOrder()->limit(8)->get();
        $banners = Slider::all()
            ->map(function($slider) {
                return [
                    'title' => $slider->title,
                    'image' => $slider->image_path,
                    'link' => route('shop')
                ];
            });
        $reviews = Review::where('status', true)->get(); // fetching approved reviews
		// return $reviews;
        
        return view('home.index', compact('categories', 'randomProducts', 'banners', 'reviews'));
    }
    
    
    public function allCategory()
    {
        $categories = Category::select('id', 'title', 'slug', 'image')->get();
        return view('home.allCategory', compact('categories'));
    }
    
    
	public function contact()
    {
		$address = Social::where('name', 'Address')->firstOrFail();
		$contact = Social::where('name', 'Telegram')->firstOrFail();
		$storeHours = Social::where('name', 'Store Hours')->firstOrFail();
        return view('home.contact', compact('address', 'contact', 'storeHours'));
    }

}
