<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\CakeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // dashboard
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');

    // cakes
    Route::resource('cakes', CakeController::class);
});
