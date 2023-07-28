<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CommentsController;
use App\Http\Controllers\Web\InfoController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RatingController;

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
Route::get('/admin-login', [AuthController::class, 'showLoginForm'])->name('admin-login');

Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('show-login');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('register', [AuthController::class, 'register'])->name('do-register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('admin-login', [AuthController::class, 'adminLogin'])->name('admin-do-login');
Route::post('admin-logout', [AuthController::class, 'adminLogout'])->name('admin-logout');

Route::prefix('admin')->name('admin.')->group(function() {
    require __DIR__.'/admin/admin.php';
});

Route::get('menu', [MenuController::class, 'index'])->name('menu');
Route::middleware('web-auth')->group(function() {
    Route::get('info', [InfoController::class, 'index'])->name('info');
    Route::get('comment', [CommentsController::class, 'index'])->name('comment');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('ratings/{rateableType}/{rateableId}', [RatingController::class, 'rating'])->name('ratings.index');
    Route::get('profile/confirm-order/{id}', [ProfileController::class, 'confirmOrder'])->name('profile.confirm-order');
    Route::get('profile/reject-order/{id}', [ProfileController::class, 'rejectOrder'])->name('profile.reject-order');
    Route::post('profile/update-notification-status', [ProfileController::class, 'updateNotificationStatus']);
    Route::post('add-to-cart', [CartController::class, 'add'])->name('add-to-cart');
    Route::post('update-cart-item', [CartController::class, 'updateCartItem']);
    Route::post('deduct', [CartController::class, 'deduct'])->name('deduct');
    Route::post('delete', [CartController::class, 'delete'])->name('delete');
    Route::post('pay', [CartController::class, 'pay'])->name('pay');
    Route::post('change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');
    Route::post('ratings/{rateableType}/{rateableId}', [RatingController::class, 'store'])->name('ratings.store');
    Route::post('ratings/{orderId}', [CommentsController::class, 'store'])->name('comment.store');
    
});