<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'adminMiddleware', 'prefix' => 'admin'], function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard.home');
    })->name('admin.home');

    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', [CategoryController::class, 'home'])->name('admin.categories');
        Route::post('create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('update', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    });
});
