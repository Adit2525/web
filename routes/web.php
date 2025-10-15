<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\OrderPublicController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services.public');
Route::get('/services/{service}', [HomeController::class, 'serviceShow'])->name('services.show');
Route::get('/track', [HomeController::class, 'track'])->name('track');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');

// Public order routes
Route::get('/order', [OrderPublicController::class, 'create'])->name('order.create');
Route::post('/order', [OrderPublicController::class, 'store'])->name('order.store');
Route::get('/order/success/{kode}', [OrderPublicController::class, 'success'])->name('order.success');

// Auth routes (simple session-based)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('customers', CustomerController::class);
    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('orders-export', [OrderController::class, 'export'])->name('orders.export');
});
