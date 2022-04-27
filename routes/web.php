<?php

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('user/{id}/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
    Route::post('add_to_cart', [App\Http\Controllers\HomeController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
    Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
    Route::post('/delete', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
    Route::post('/order', [App\Http\Controllers\HomeController::class, 'order'])->name('order'); 
 });
