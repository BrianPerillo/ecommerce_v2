<?php

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CartController;
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

// Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/', [ProductosController::class, "home"] )->name('index');

Route::get('/editform/{cart_product}', [CartController::class, "form_edit_cart"] )->name('edit.carrito');
Route::put('/edit/{cart_product}', [CartController::class, "edit_cart"] )->name('confirm_edit.carrito');
Route::delete('/delete/{cart_product}', [CartController::class, "delete_cart"] )->name('delete.carrito');

Route::get('/cart/{user}/productos', [CartController::class, "index"])->name('user.cart');

Route::middleware(['auth:sanctum', 'verified'])->get('/cart/{product}', [CartController::class, "agregar_al_carrito"] )->name('agregar_al_carrito');

Route::get('/remeras/{category}/{gender}', [ProductosController::class, "index"])->name('productos.remeras');
Route::get('/buzos/{category}/{gender}', [ProductosController::class, "index"])->name('productos.buzos');
Route::get('/pantalones/{category}/{gender}', [ProductosController::class, "index"])->name('productos.pantalones');
Route::get('/zapatillas/{category}/{gender}', [ProductosController::class, "index"])->name('productos.zapatillas');

Route::get('/{category}/{product}', [ProductosController::class, "show"])->name('productos.show');
