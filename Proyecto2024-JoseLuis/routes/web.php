<?php

use App\Http\Controllers\StoreProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BasketController;




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
    return view('index');
})->name('home');

//RUTAS LOGIN , SIGNUP Y LOGOUT
Route::get('signup', [LoginController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('change-language', [LanguageController::class, 'changeLanguage'])->name('change-language');



Route::resource('storeProducts', StoreProductController::class);
Route::get('/store/filter/{category}', [StoreProductController::class, 'filterByCategory'])->name('storeProducts.filter');


Route::get('/cart', [BasketController::class, 'cart'])->name('cart.index');
Route::post('/add', [BasketController::class, 'add'])->name('cart.store');
Route::post('/update', [BasketController::class, 'update'])->name('cart.update');
Route::post('/remove', [BasketController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [BasketController::class, 'clear'])->name('cart.clear');
