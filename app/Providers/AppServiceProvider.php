<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // added import

use App\Models\Category;
use Illuminate\Pagination\Paginator; // added import

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive(); // enable Bootstrap 5 pagination

        if (Schema::hasTable('categories')) {
			$categories = Category::select('id', 'title')->take(10)->get();
			View::share('categories', $categories);
	    }
    }
}

