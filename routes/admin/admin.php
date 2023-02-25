<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

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