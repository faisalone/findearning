<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StoreIntendedUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Store the current URL as the intended URL for post-login redirect
        // We'll add the #review-section fragment if appropriate
        $currentUrl = $request->fullUrl();
        if ($request->routeIs('productDetails')) {
            $currentUrl .= '#review-section';
        }
        
        // Store the URL in the session
        session()->put('url.intended', $currentUrl);
        
        return $next($request);
    }
}
