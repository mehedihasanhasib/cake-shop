<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;

//home
Route::get('/', [HomeController::class, 'index'])->name('home.index');

//shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/cake-details/{id}', [ShopController::class, 'singleCake'])->name('shop.details');
Route::get('/shop/{slug}', [ShopController::class, 'search_by_category'])->name('shop.search_by_category');

//contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('/test', function (\Illuminate\Http\Request $request) {
    dd($request->all());
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
