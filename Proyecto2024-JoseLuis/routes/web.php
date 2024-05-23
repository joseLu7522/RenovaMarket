<?php

use App\Http\Controllers\StoreProductController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\InvoiceController;




Route::get('/', function () {
    return view('index');
})->name('home');

//RUTA CAMBIAR IDIOMA
Route::post('change-language', [LanguageController::class, 'changeLanguage'])->name('change-language');
//RUTAS LOGIN , SIGNUP Y LOGOUT
Route::get('signup', [LoginController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//RUTA PRODUCTOS DE USUARIOS
Route::resource('userProducts', UserProductController::class);
Route::get('/user-products', [UserProductController::class, 'filterAndSort'])->name('userProducts.filterAndSort');
Route::delete('/purchase/{userProduct}', [UserProductController::class, 'purchase'])->name('userProducts.purchase');

//RUTAS PRODUCTOS DE TIENDA/FILTROS/VALORACIÓN
Route::resource('storeProducts', StoreProductController::class);
Route::get('/store-products', [StoreProductController::class, 'filterAndSort'])->name('storeProducts.filterAndSort');

Route::post('storeProducts/{storeProduct}/rate', [StoreProductController::class, 'rate'])->name('storeProducts.rate');
//RUTAS CARRITO DE LA COMPRA
Route::get('/cart', [BasketController::class, 'cart'])->name('cart.index');
Route::post('/add', [BasketController::class, 'add'])->name('cart.store');
Route::post('/update', [BasketController::class, 'update'])->name('cart.update');
Route::post('/remove', [BasketController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [BasketController::class, 'clear'])->name('cart.clear');
/**/
Route::resource('users', UserController::class);
/*RUTA DE LOS MENSAJES*/
Route::resource('messages', MessageController::class);
/*GENERAR FACTURAS*/
Route::post('/complete-purchase', [InvoiceController::class, 'completePurchase'])->name('orders.completePurchase');
Route::get('/generate-invoice', [InvoiceController::class, 'generateInvoice'])->name('orders.generateInvoice');

