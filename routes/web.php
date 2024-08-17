<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('login', [LoginController::class, 'auth'])->name('login.auth')->middleware('guest');

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::get('products/detail/{product}', [ProductController::class, 'show'])->name('public.product.show');

Route::group(['middleware' => 'auth'], function(){
    
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::get('orders/success/{order}', [OrderController::class, 'success'])->name('order.success');
    Route::get('orders/cancelled/{order}', [OrderController::class, 'cancelled'])->name('order.cancelled');

    Route::get('logout', function(){
        Session::flush();
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
});
