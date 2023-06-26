<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::prefix('users')->name('users.')->group(function() {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::get('/{id}', [UsersController::class, 'show'])->name('show');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::post('store', [UsersController::class, 'store'])->name('store');
        Route::post('update/{id}', [UsersController::class, 'update'])->name('update');
        Route::delete('destroy', [UsersController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->name('products.')->group(function() {
        Route::get('/', [ProductsController::class, 'index'])->name('index');
        Route::get('create', [ProductsController::class, 'create'])->name('create');
        Route::get('/{id}', [ProductsController::class, 'show'])->name('show');
        Route::get('edit/{id}', [ProductsController::class, 'edit'])->name('edit');
        Route::post('store', [ProductsController::class, 'store'])->name('store');
        Route::post('update/{id}', [ProductsController::class, 'update'])->name('update');
        Route::delete('destroy', [ProductsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::post('update/{id}', [OrderController::class, 'update'])->name('update');
    });
});