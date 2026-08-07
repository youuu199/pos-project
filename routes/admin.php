<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'adminMiddleware', 'prefix' => 'admin'], function() {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.home');

    // Category routes
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', [CategoryController::class, 'home'])->name('admin.categories');
        Route::post('create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('update', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    });

    // Product routes
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', [ProductController::class, 'home'])->name('admin.products');
        Route::get('add', [ProductController::class, 'add'])->name('admin.products.add');
        Route::post('create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::get('view/{id}', [ProductController::class, 'view'])->name('admin.products.view');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('update', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
    });

    // Order routes
    Route::group(['prefix' => 'orders'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('view/{id}', [OrderController::class, 'view'])->name('admin.orders.view');
        Route::post('update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });

    // User routes
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::get('view/{id}', [UserController::class, 'view'])->name('admin.users.view');
        Route::post('update-role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.changePassword');

    // Sale routes
    Route::group(['prefix' => 'sales'], function() {
        Route::get('/', [SaleController::class, 'index'])->name('admin.sales');
        Route::get('view/{id}', [SaleController::class, 'view'])->name('admin.sales.view');
    });

    // Contact routes
    Route::group(['prefix' => 'contacts'], function() {
        Route::get('/', [ContactController::class, 'index'])->name('admin.contacts');
        Route::get('view/{id}', [ContactController::class, 'view'])->name('admin.contacts.view');
        Route::get('delete/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.delete');
    });
});
