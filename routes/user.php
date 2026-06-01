<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'userMiddleware', 'prefix' => 'user'], function() {
    Route::get('/profile', function() {
        return view('user.dashboard.home');
    })->name('user.home');
});
