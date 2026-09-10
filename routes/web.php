<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductDocumentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::controller(StoreController::class)->group(function () {
    Route::get('/',  'home')->name('store.home');
    Route::get('/shop',  'shop')->name('store.shop');
    Route::get('/shop/{slug}/preview',  'preview')->name('store.preview');
    Route::get('/cart',  'cart')->name('store.cart');
    Route::post('/cart/{slug}', 'add')->name('store.cart.add');
    Route::patch('/cart/{slug}',  'update')->name('store.cart.update');
    Route::delete('/cart/{slug}',  'remove')->name('store.cart.remove');
    Route::get('/checkout',  'checkout')->name('store.checkout');
    Route::post('/checkout',  'placeOrder')->name('store.checkout.place');
    Route::get('/order/{order}/complete',  'complete')->name('store.complete');
});
Route::middleware('auth')->controller(ProductDocumentController::class)->group(function () {
    Route::get('/products/document', 'index')->name('document.index');
    Route::get('/products/document/create', 'create')->name('document.create');
    Route::post('/products/document', 'store')->name('document.store');
});

Auth::routes();
Route::controller(HomeController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});
