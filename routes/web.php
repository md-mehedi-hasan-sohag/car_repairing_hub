<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\ShopController as CustomerShopController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\ShopOwner\DashboardController as ShopOwnerDashboardController;
use App\Http\Controllers\ShopOwner\ShopController as ShopOwnerShopController;
use App\Http\Controllers\ShopOwner\ServiceController;
use App\Http\Controllers\ShopOwner\ProfileController as ShopOwnerProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ShopController as AdminShopController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isShopOwner()) {
            return redirect()->route('shop-owner.dashboard');
        } else {
            return redirect()->route('customer.dashboard');
        }
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset.form');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/shops', [CustomerShopController::class, 'index'])->name('shops.index');
    Route::get('/shops/{id}', [CustomerShopController::class, 'show'])->name('shops.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/payment/checkout', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/history', [PaymentController::class, 'history'])->name('payment.history');

    Route::post('/reviews/{shop}', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/profile', [CustomerProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [CustomerProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [CustomerProfileController::class, 'showChangePassword'])->name('profile.change-password.show');
    Route::post('/profile/change-password', [CustomerProfileController::class, 'changePassword'])->name('profile.change-password');
});

Route::middleware(['auth', 'role:shop_owner'])->prefix('shop-owner')->name('shop-owner.')->group(function () {
    Route::get('/dashboard', [ShopOwnerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/shop/create', [ShopOwnerShopController::class, 'create'])->name('shop.create');
    Route::post('/shop', [ShopOwnerShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/edit', [ShopOwnerShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop', [ShopOwnerShopController::class, 'update'])->name('shop.update');

    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/profile', [ShopOwnerProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ShopOwnerProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ShopOwnerProfileController::class, 'showChangePassword'])->name('profile.change-password.show');
    Route::post('/profile/change-password', [ShopOwnerProfileController::class, 'changePassword'])->name('profile.change-password');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/shops', [AdminShopController::class, 'index'])->name('shops.index');
    Route::delete('/shops/{id}', [AdminShopController::class, 'destroy'])->name('shops.destroy');

    Route::get('/services', [AdminServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [AdminServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{id}', [AdminServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [AdminServiceController::class, 'destroy'])->name('services.destroy');
});
