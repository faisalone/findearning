<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is a general user (role = 0) and show customer dashboard
        if (Auth::check() && Auth::user()->role == 0) {
            // Call the customer dashboard code directly in the same method
            $user = Auth::user();
            
            // Get only the necessary data using existing fields
            $orders = Order::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
                
            $totalOrders = $orders->count();
            $completedOrders = $orders->where('status', 'completed')->count();
            $pendingOrders = $orders->where('status', 'pending')->count();
                
            // Total spent by customer
            $totalSpent = $orders->where('status', 'completed')
                ->sum('total');
                
            // Recent orders for display
            $recentOrders = $orders->take(5);
            
            // Return the customer view
            return view('dashboard.customer-index', compact(
                'user',
                'totalOrders',
                'completedOrders',
                'pendingOrders',
                'totalSpent',
                'recentOrders'
            ));
        }
        
        // Admin dashboard (role = 1) - keep your existing functionality
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Total revenue from completed orders
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total');
            
        // Recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Top categories by product count
        $categories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get();
            
        // Latest products
        $latestProducts = Product::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('dashboard.index', compact(
            'totalProducts',
            'totalOrders',
            'completedOrders',
            'pendingOrders',
            'totalRevenue',
            'recentOrders',
            'categories',
            'latestProducts'
        ));
    }
}