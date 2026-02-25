<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'userMiddleware', 'prefix' => 'user'], function () {
    Route::get('/home', function () {
        return view('user.dashboard.home');
    })->name('userHome');
});

