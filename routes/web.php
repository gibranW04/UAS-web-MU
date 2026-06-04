<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AddressController;

use App\Http\Controllers\User\AddressController as UserAddressController;

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
        fn() => view('admin.dashboard')
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
        fn() => view('user.dashboard')
    )->name('dashboard');

    Route::resource(
        'addresses',
        UserAddressController::class
    );

});
