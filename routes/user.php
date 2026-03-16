<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'userMiddleware', 'prefix' => 'user'], function() {
    Route::get('\dashboard', function() {
        return view('user.dashboard');
    })->name('user.dashboard');

});
