<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckUserRole;

// Apply the CheckUserRole middleware directly to Auth routes
Route::middleware([CheckUserRole::class])->group(function () {
    Auth::routes(['verify' => true]);
});

Route::controller(HomeController::class)->group(function () {
	Route::get('/', 'index')->name('index');
	Route::get('/all-category', 'allCategory')->name('allCategory');
	Route::get('/contact', 'contact')->name('contact');

});

Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');

Route::prefix('pages')->group(function () {
	Route::controller(PageController::class)->group(function () {
		Route::get('/about', 'about')->name('about');
		Route::get('/error-page', 'errorPage')->name('errorPage');
		Route::get('/faq', 'faq')->name('faq');
	});
});

// shop
Route::prefix('shop')->group(function () {
	Route::controller(ShopController::class)->group(function () {
		Route::get('/', 'shop')->name('shop');
		Route::get('/search', 'search')->name('shop.search'); // Add this new route
		Route::get('/cart', 'cart')->name('cart');
		Route::post('/add-to-cart', 'addToCart')->name('shop.addToCart');
		Route::post('/remove-from-cart', 'removeFromCart')->name('shop.removeFromCart');
		Route::post('/update-cart', 'updateCart')->name('shop.updateCart');
		Route::get('/check-out', 'checkOut')->name('checkOut');
		Route::get('/{order}/thank-you', 'thankYou')->name('thankYou');
		Route::get('/{category}', 'category')->name('shop.category');
		Route::get('/{category}/{product}', 'productDetails')
            ->name('productDetails');
	});
});

// shop
Route::prefix('order')->group(function () {
	Route::controller(OrderController::class)->group(function () {
		Route::post('/store', 'createOrder')->name('placeOrder');
	});
});

// Dashboard routes
Route::prefix('dashboard')->middleware(['auth', CheckUserRole::class])->group(function () {
    // Keep the main dashboard route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Customer-specific routes - these can be accessed by customers
    Route::get('/my-profile', [CustomerController::class, 'profile'])->name('myProfile');
    Route::post('/my-profile/update', [CustomerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/my-orders', [CustomerController::class, 'orders'])->name('myOrders');
    
    // Product Reviews - All users need to be authenticated
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('product.addReview');
    
    // Admin-only routes - customers will be redirected away from these
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
    Route::get('/wallet/recharge', [WalletController::class, 'rechargeIndex'])->name('recharge.index');
    Route::post('/wallet/recharge', [WalletController::class, 'recharge'])->name('recharge');
    Route::get('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
    Route::get('/transactions/{id}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');
    Route::patch('/transactions/{id}/adjust', [TransactionController::class, 'adjust'])->name('transactions.adjust');
    
    Route::resource('categories', CategoryController::class);
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::post('/{category}/status', 'updateStatus')->name('categories.updateStatus');
    });

    Route::resource('orders', OrderController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('payment-methods', PaymentMethodController::class);
    Route::resource('pages', PageController::class)->except(['show']);

    Route::resource('products', ProductController::class);
    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::post('/{product}/status', 'updateStatus')->name('products.updateStatus');
    });
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers/{customer}/toggle', [CustomerController::class, 'toggle'])->name('customers.toggle');
    Route::resource('settings', SettingController::class)->except(['create', 'edit', 'show']);

    // Reviews management routes - the admin middleware is handled in the controller
	Route::resource('reviews', ReviewController::class)->only(['index', 'update', 'destroy']);
    Route::patch('/reviews/{review}/toggle-status', [ReviewController::class, 'toggleStatus'])
        ->name('reviews.toggleStatus');
});