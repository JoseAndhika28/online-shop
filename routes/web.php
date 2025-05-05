<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('auth.login');
});

// Middleware
Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {
    // Dashboard Route
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category Routes
    Route::resource('category', CategoryController::class);

    // Book Routes
    Route::resource('book', BookController::class);

    // Confirm Routes
    Route::get('/confirm', [ConfirmController::class, 'index'])->name('confirm.index');
    Route::post('/confirm/{id}/mark-as-delivered', [ConfirmController::class, 'markAsDelivered'])->name('confirmed');
});

Route::middleware([AdminMiddleware::class])->prefix('user')->group(function () {
    // User Routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/account', [HomeController::class, 'account'])->name('account');
    Route::get('/books/{id}', [HomeController::class, 'show'])->name('book.detail');
    Route::post('/books/{book}/action', [HomeController::class, 'handleAction'])->name('book.action');
    Route::get('/order/detail', [HomeController::class, 'orderDetail'])->name('order.detail');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/books/{id}/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add'); // Route untuk menambahkan buku ke keranjang
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Route untuk melakukan checkout
    Route::delete('/cart', [CartController::class, 'deleteSelected'])->name('cart.delete'); // Route untuk menghapus item dari keranjang

    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store'); // Route untuk menyimpan pesanan

    Route::get('/history', [ConfirmController::class, 'history'])->name('user.history');
    Route::get('/history/{id}/download', [ConfirmController::class, 'downloadNota'])->name('user.downloadNota'); // Route untuk mengunduh nota

});

//Authentication Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
