<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ShopController extends Controller
{
    public function account()
    {
        return view('shop/account');
    }
    
    public function cart()
    {
        return view('shop/cart');
    }
    
    public function checkOut()
    {
        return view('shop/checkOut');
    }
    
    public function fullWidthShop()
    {
        return view('shop/fullWidthShop');
    }
    
    public function productDetails()
    {
        return view('shop/productDetails');
    }
    
    public function productDetails2()
    {
        return view('shop.productDetails2');
    }
    
    public function shop()
    {
        return view('shop.shop');
    }

    public function category($category)
    {
        // return $category;
        $category = Category::where('slug', $category)->first();
		return view('shop.shop');
        // return response()->json($category);
    }
    
    public function sidebarLeft()
    {
        return view('shop/sidebarLeft');
    }
    
    public function sidebarRight()
    {
        return view('shop/sidebarRight');
    }
    
    public function variableProducts()
    {
        return view('shop/variableProducts');
    }
    public function groupedProducts()
    {
        return view('shop/groupedProducts');
    }
    
}
