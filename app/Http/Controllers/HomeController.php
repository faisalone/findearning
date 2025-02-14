<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
	public function index()
    {
		$categories = Category::select('id', 'title', 'slug', 'image')->take(10)->get();
		$randomProducts = Product::inRandomOrder()->limit(8)->get();
        return view('home.index', compact('categories', 'randomProducts'));
    }
    
    
    public function allCategory()
    {
        return view('home.allCategory');
    }
    
    
    public function category()
    {
        return view('home/category');
    }
    
    
    public function externalProducts()
    {
        return view('home/externalProducts');
    }
    
    
    public function outOfStockProducts()
    {
        return view('home/outOfStockProducts');
    }
    
    
    public function shopFiveColumn()
    {
        return view('home/shopFiveColumn');
    }
    
    
    public function simpleProducts()
    {
        return view('home/simpleProducts');
    }
    
    
    public function thankYou()
    {
        return view('home/thankYou');
    }
    
    
    public function wishlist()
    {
        return view('home/wishlist');
    }
    
    
    public function login()
    {
        return view('home/login');
    }
}
