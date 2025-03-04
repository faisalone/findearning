<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request and allow only admin users (role = 1).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and has admin role (role = 1)
        if (!auth()->check() || auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action. Admin access required.');
        }
        
        return $next($request);
    }
}
