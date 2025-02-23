<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // added import

use App\Models\Category;
use App\Models\Page; // added import
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

		if (Schema::hasTable('pages')) {
			$pages = Page::where('status', true)->get()->groupBy('position');
			View::share('informationPages', $pages->get(1, collect()));
			View::share('myaccountPages', $pages->get(2, collect()));
		}
	}
}
