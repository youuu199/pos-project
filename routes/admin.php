<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/home', function() {
    return view('admin.dashboard.home');
})->name('admin.home');
