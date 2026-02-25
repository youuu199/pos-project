<?php
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'adminMiddleware', 'prefix' => 'admin'], function () {
    Route::get('/home', function () {
        return view('admin.dashboard.home');
    })->name('adminHome');
});


