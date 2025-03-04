<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request and prevent access for users with role = 2.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // First check if they're trying to login
        if ($request->is('login') || $request->is('register') || $request->routeIs('login') || $request->routeIs('register')) {
            // If they're already authenticated and have role = 2, prevent login page access
            if (Auth::check() && Auth::user()->role === 2) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Make sure the error message is flashed to the session
                return redirect()->route('login')
                    ->with('error', 'Your account has been disabled. Please contact the administrator.');
            }
        }
        
        // For any authenticated requests
        if (Auth::check() && Auth::user()->role === 2) {
            // If they're already logged in and trying to access any page, log them out
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // Make sure the error message is flashed with ->with()
            return redirect()->route('login')
                ->with('error', 'Your account has been disabled. Please contact the administrator.');
        }

        return $next($request);
    }
}
