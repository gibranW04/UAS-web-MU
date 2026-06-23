<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\SocialController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

use App\Http\Controllers\User\AddressController as UserAddressController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\WishlistController as UserWishlistController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/',
    [HomeController::class,'index']
)->name('home');


Route::get('/product/{slug}', [
    HomeController::class,
    'show'
])->name('product.show');

/*
|--------------------------------------------------------------------------
| SOCIALITE (OAuth)
|--------------------------------------------------------------------------
*/
Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/callback/{provider}', [SocialController::class, 'callback'])->name('social.callback');


/*
|--------------------------------------------------------------------------
| CART & CHECKOUT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post(
        '/cart/add',
        [CheckoutController::class, 'addToCart']
    )->name('cart.add');

    Route::get(
        '/cart',
        [CheckoutController::class, 'index']
    )->name('cart.index');

    Route::post(
        '/cart/update',
        [CheckoutController::class, 'updateQty']
    )->name('cart.update');

    Route::delete(
        '/cart/{variantId}',
        [CheckoutController::class, 'remove']
    )->name('cart.remove');

    Route::post(
        '/checkout',
        [CheckoutController::class, 'store']
    )->name('checkout.store');

    Route::post(
        '/payment/success',
        [PaymentController::class, 'success']
    )->name('payment.success');

    Route::get(
        '/payment/status/{order}',
        [PaymentController::class, 'status']
    )->name('payment.status');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin'
])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::resource(
        'categories',
        CategoryController::class
    );

    Route::resource(
        'products',
        ProductController::class
    );

    Route::resource(
        'addresses',
        AddressController::class
    );

    Route::resource(
        'banners',
        BannerController::class
    );

    Route::get(
        '/orders',
        [AdminOrderController::class, 'index']
    )->name('orders.index');

    Route::get(
        '/orders/{id}',
        [AdminOrderController::class, 'show']
    )->name('orders.show');

    Route::patch(
        '/orders/{id}/status',
        [AdminOrderController::class, 'updateStatus']
    )->name('orders.status');

    Route::get(
        '/customers',
        [CustomerController::class, 'index']
    )->name('customers.index');

    Route::get(
        '/reviews',
        [AdminReviewController::class, 'index']
    )->name('reviews.index');

});


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:user'
])
->prefix('user')
->name('user.')
->group(function () {

    Route::get(
        '/dashboard',
        [UserDashboardController::class, 'index']
    )->name('dashboard');

    Route::resource(
        'addresses',
        UserAddressController::class
    );

    Route::get(
        '/orders',
        [UserOrderController::class, 'index']
    )->name('orders.index');

    Route::get(
        '/orders/{id}',
        [UserOrderController::class, 'show']
    )->name('orders.show');

    Route::post(
        '/orders/{id}/cancel',
        [UserOrderController::class, 'cancel']
    )->name('orders.cancel');

    Route::get(
        '/wishlists',
        [UserWishlistController::class, 'index']
    )->name('wishlists.index');

    Route::post(
        '/wishlists',
        [UserWishlistController::class, 'store']
    )->name('wishlists.store');

    Route::delete(
        '/wishlists/{id}',
        [UserWishlistController::class, 'destroy']
    )->name('wishlists.destroy');

    Route::post(
        '/wishlists/toggle',
        [UserWishlistController::class, 'toggle']
    )->name('wishlists.toggle');

    Route::post(
        '/orders/{id}/receive',
        [UserOrderController::class, 'receive']
    )->name('orders.receive');

    Route::post(
        '/reviews',
        [UserReviewController::class, 'store']
    )->name('reviews.store');

});
