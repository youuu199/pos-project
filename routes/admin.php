<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'adminMiddleware', 'prefix' => 'admin'], function() {
    Route::get('\dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');    

});
