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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::post('/search_result', [App\Http\Controllers\HomeController::class, 'search_result'])->name('search_result');
Route::post('/product_detail', [App\Http\Controllers\HomeController::class, 'product_detail'])->name('product_detail');
Route::post('/add_to_cart', [App\Http\Controllers\HomeController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/delete_from_cart', [App\Http\Controllers\HomeController::class, 'delete_from_cart'])->name('delete_from_cart');
