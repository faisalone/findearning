<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/index');
    }
    
    
    public function allCategory()
    {
        return view('home/allCategory');
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
