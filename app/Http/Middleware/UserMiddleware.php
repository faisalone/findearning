<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        if (auth()->user()->role !== 0) {
            abort(403, 'Access denied. Regular user privileges required.');
        }

        return $next($request);
    }
}
