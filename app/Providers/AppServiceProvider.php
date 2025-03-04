<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\PaymentMethod;
use App\Helpers\Settings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		// Register the settings singleton
        $this->app->singleton('settings', function ($app) {
            if (Schema::hasTable('settings')) {
                return Setting::get();
            }
            return [];
        });
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Paginator::useBootstrapFive();
		Paginator::useBootstrapFour();

		if (Schema::hasTable('settings')) {
			$settings = Setting::pluck('value', 'key')->toArray();
			Config::set('settings', $settings);
			View::share('settings', $settings);
		}

		if (Schema::hasTable('categories')) {
			$categories = Category::select('id', 'title')->take(10)->get();
			View::share('categories', $categories);
		}

		if (Schema::hasTable('pages')) {
			$pages = Page::where('status', true)->get()->groupBy('position');
			View::share('informationPages', $pages->get(1, collect()));
			View::share('myaccountPages', $pages->get(2, collect()));
		}

		if (Schema::hasTable('products')) {
			$topProducts = Product::getTopProducts(4, false);
			View::share('topProducts', $topProducts);
		}

		// Share payment methods with all views
		if (Schema::hasTable('payment_methods')) {
			$paymentMethods = PaymentMethod::select('name', 'image',)->where('status', true)->get();
			View::share('paymentMethods', $paymentMethods);
		}
	}
}
