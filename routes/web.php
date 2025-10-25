<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\PaymentController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    
    // Order Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

// User Routes
Route::middleware(['auth', 'role:user', 'throttle:60,1'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Checkout Routes
    Route::get('/checkout', [CartController::class, 'checkoutForm'])->name('checkout.form');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/whatsapp', [CartController::class, 'checkoutWhatsApp'])->name('checkout.whatsapp');
    
    // Payment Routes
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order}/upload', [PaymentController::class, 'uploadProof'])->name('payment.upload');
    
    // Order Routes
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/success', [UserOrderController::class, 'success'])->name('order.success');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google OAuth
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'callback'])->name('google.callback');

require __DIR__.'/auth.php';