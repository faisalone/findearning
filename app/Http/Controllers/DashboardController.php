<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Newsletter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    /**
     * Display a listing of subscribers.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
     */
    public function subscribers()
    {
        // Check if user has admin role
        if (Auth::user()->role != 1) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }
        
        $subscribers = Newsletter::orderBy('created_at', 'desc')->get();
        
        // Process user agent information for better display
        foreach ($subscribers as $subscriber) {
            $subscriber->deviceInfo = $this->parseUserAgent($subscriber->user_agent);
        }
        
        return view('dashboard.subscribers.index', compact('subscribers'));
    }
    
    /**
     * Get details of a specific subscriber.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function subscriberShow($id)
    {
        // Check if user has admin role
        if (Auth::user()->role != 1) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
        
        try {
            $subscriber = Newsletter::findOrFail($id);
            $subscriber->deviceInfo = $this->parseUserAgent($subscriber->user_agent);
            $subscriber->formattedCreatedAt = $subscriber->created_at->format('F d, Y h:i A');
            $subscriber->formattedUpdatedAt = $subscriber->updated_at->format('F d, Y h:i A');
            
            return response()->json([
                'success' => true, 
                'subscriber' => $subscriber
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Subscriber not found'], 404);
        }
    }
    
    /**
     * Parse user agent string to extract useful information.
     *
     * @param  string  $userAgent
     * @return array
     */
    private function parseUserAgent($userAgent)
    {
        $result = [];
        
        // Extract browser information
        if (strpos($userAgent, 'Chrome') !== false) {
            $result['browser'] = 'Chrome';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            $result['browser'] = 'Firefox';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            $result['browser'] = 'Safari';
        } elseif (strpos($userAgent, 'Edge') !== false || strpos($userAgent, 'Edg') !== false) {
            $result['browser'] = 'Edge';
        } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) {
            $result['browser'] = 'Internet Explorer';
        } else {
            $result['browser'] = 'Unknown';
        }
        
        // Extract OS information
        if (strpos($userAgent, 'Windows') !== false) {
            $result['os'] = 'Windows';
        } elseif (strpos($userAgent, 'Mac') !== false) {
            $result['os'] = 'macOS';
        } elseif (strpos($userAgent, 'Linux') !== false) {
            $result['os'] = 'Linux';
        } elseif (strpos($userAgent, 'Android') !== false) {
            $result['os'] = 'Android';
        } elseif (strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) {
            $result['os'] = 'iOS';
        } else {
            $result['os'] = 'Unknown';
        }
        
        // Determine device type
        if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false && strpos($userAgent, 'Mobile') !== false) {
            $result['device'] = 'Mobile';
        } elseif (strpos($userAgent, 'iPad') !== false || strpos($userAgent, 'Tablet') !== false) {
            $result['device'] = 'Tablet';
        } else {
            $result['device'] = 'Desktop';
        }
        
        $result['raw'] = $userAgent;
        
        return $result;
    }
}