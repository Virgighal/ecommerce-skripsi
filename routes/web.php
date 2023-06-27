<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('show-login');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('do-register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function() {
    require __DIR__.'/admin/admin.php';
});

Route::get('menu', [MenuController::class, 'index'])->name('menu');
Route::middleware('web-auth')->group(function() {
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('add-to-cart', [CartController::class, 'add'])->name('add-to-cart');
    Route::post('pay', [CartController::class, 'pay'])->name('pay');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');
});