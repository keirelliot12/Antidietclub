<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Test routes
    Route::get('/test-cart', function() {
        return view('test-cart');
    });

    Route::get('/test-session', function() {
        return response()->json([
            'session_id' => session()->getId(),
            'session_path' => config('session.path'),
            'session_cookie' => config('session.cookie'),
            'cart' => session()->get('cart', []),
        ]);
    });

    Route::get('/test-cart-data', function() {
        $service = new \App\Services\CartService();
        return response()->json([
            'cart_count' => $service->getCount(),
            'cart_data' => $service->getCart(),
            'cart_items' => $service->getCartItems(),
        ]);
    });

    Route::get('/test-clear-cart', function() {
        $service = new \App\Services\CartService();
        $service->clear();
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared',
            'cart_count' => $service->getCount(),
        ]);
    });

    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{slug}/add-to-cart', [ProductController::class, 'addToCart'])->name('products.add-to-cart');

    // Blog routes
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/whatsapp', [CartController::class, 'whatsapp'])->name('cart.whatsapp');
});