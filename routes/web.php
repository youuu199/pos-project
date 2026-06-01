<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialContorller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require_once __DIR__."/admin.php";
require_once __DIR__."/user.php";

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(Auth::check()) {
        if(Auth::user()->role === 'admin' || Auth::user()->role == 'superadmin') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('user.home');
        }
    }
    return redirect()->route('login');
});


// Socialite routes
Route::get('/auth/{provider}/redirect', [SocialContorller::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialContorller::class, 'callback']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
