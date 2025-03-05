<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
	public const HOME = '/dashboard';
    // ...existing code...

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // ...existing code...

        // Add the CheckUserRole middleware to the auth routes
        $this->app['router']->middlewareGroup('auth', [
            \App\Http\Middleware\CheckUserRole::class,
        ]);

        // ...existing code...
    }
}
