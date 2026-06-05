<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'adminMiddleware', 'prefix' => 'admin'], function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard.home');
    })->name('admin.home');

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
});
