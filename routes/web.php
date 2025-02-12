<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::controller(HomeController::class)->group(function () {
	Route::get('/', 'index')->name('index');
	Route::get('/all-category', 'allCategory')->name('allCategory');
	Route::get('/category', 'category')->name('category');
	Route::get('/external-products', 'externalProducts')->name('externalProducts');
	Route::get('/out-of-stock-products', 'outOfStockProducts')->name('outOfStockProducts');
	Route::get('/shop-five-column', 'shopFiveColumn')->name('shopFiveColumn');
	Route::get('/simple-products', 'simpleProducts')->name('simpleProducts');
	Route::get('/thank-you', 'thankYou')->name('thankYou');
	Route::get('/wishlist', 'wishlist')->name('wishlist');
	Route::get('/login', 'login')->name('login');
});

Route::prefix('pages')->group(function () {
	Route::controller(PagesController::class)->group(function () {
		Route::get('/about', 'about')->name('about');
		Route::get('/error-page', 'errorPage')->name('errorPage');
		Route::get('/faq', 'faq')->name('faq');
	});
});

// shop
Route::prefix('shop')->group(function () {
	Route::controller(ShopController::class)->group(function () {
		Route::get('/account', 'account')->name('account');
		Route::get('/cart', 'cart')->name('cart');
		Route::get('/check-out', 'checkOut')->name('checkOut');
		Route::get('/full-width-Shop', 'fullWidthShop')->name('fullWidthShop');
		Route::get('/grouped-products', 'groupedProducts')->name('groupedProducts');
		Route::get('/product-details', 'productDetails')->name('productDetails');
		Route::get('/product-details2', 'productDetails2')->name('productDetails2');
		Route::get('/shop', 'shop')->name('shop');
		Route::get('/sidebar-left', 'sidebarLeft')->name('sidebarLeft');
		Route::get('/sidebar-right', 'sidebarRight')->name('sidebarRight');
		Route::get('/variable-products', 'variableProducts')->name('variableProducts');
		Route::get('/grouped-products', 'groupedProducts')->name('groupedProducts');
	});
});

// blog
Route::prefix('blog')->group(function () {
	Route::controller(BlogController::class)->group(function () {
		Route::get('/contact', 'contact')->name('contact');
		Route::get('/news', 'news')->name('news');
		Route::get('/newsDetails', 'newsDetails')->name('newsDetails');
		Route::get('/newsGrid', 'newsGrid')->name('newsGrid');
	});
});

Route::prefix('dashboard')->group(function () {
	Route::get('/', function () {
		return view('dashboard.index');
	})->name('dashboard');

	Route::resource('categories', CategoryController::class);
	Route::prefix('categories')->controller(CategoryController::class)->group(function () {
		Route::post('/{category}/status', 'updateStatus')->name('categories.updateStatus');
	});
	Route::resource('/attributes', AttributeController::class);

	Route::prefix('attributes')->controller(AttributeController::class)->group(function () {
		Route::get('/{parentId}/children', 'children')->name('attributes.children');
	});
	// Route::resource('orders', OrderController::class);
	// Route::resource('users', UserController::class);
	// Route::resource('sites', SiteController::class);
	// Route::resource('pages', PageController::class);

	Route::resource('products', ProductController::class);
	Route::prefix('products')->controller(ProductController::class)->group(function () {
		Route::post('/{product}/status', 'updateStatus')->name('products.updateStatus');
		Route::get('/{product}/add-variant', 'addVariant')->name('products.addVariant');
		Route::post('/{product}/store-variant', 'storeVariant')->name('products.storeVariant');
		Route::post('/variants/{variant}', 'updateVariant')->name('products.updateVariant');
		Route::delete('/variants/{variant}', 'destroyVariant')->name('products.destroyVariant');
	});
});