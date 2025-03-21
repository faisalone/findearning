<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and has admin role (role==1 is admin)
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // If not admin, redirect to dashboard with message
        return redirect()->route('dashboard')->with('error', 'You do not have admin access.');
    }
}
