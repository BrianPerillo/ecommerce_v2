<?php

use App\Http\Controllers\TokenController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\TokenController as ControllersTokenController;
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

Route::get('/location', [LocationController::class, "show"])->name('location.show');
Route::get('/location/searchStores', [LocationController::class, "search"])->name('location.search');

// Rutas protegidas AdminPanel
Route::middleware(['auth:sanctum'])->group(function () { //Acá falta chequear que el usuario logueado sea administrador - Agregar roles
    Route::get('/admin', [PanelController::class, "show"])->name('panel.index');
    Route::get('/admin/form/{section}', [PanelController::class, "form"])->name('panel.products');
    Route::get('/admin/form/edit/{section}', [PanelController::class, "formEdit"])->name('panel.products');
    Route::get('/admin/form/delete/{section}', [PanelController::class, "formDelete"])->name('panel.products');
    Route::post('/admin/saveproduct', [PanelController::class, "saveProduct"])->name('panel.save_product');
    Route::post('/admin/saveFeature', [PanelController::class, "saveFeature"])->name('panel.save_feature');
    Route::post('/admin/editFeature', [PanelController::class, "editFeature"])->name('panel.edit_feature');
    Route::post('/admin/editproduct', [PanelController::class, "editProduct"])->name('panel.edit_product');
    Route::post('/admin/findproduct', [PanelController::class, "findProduct"])->name('panel.find_product');
});

// Rutas protegidas CartController
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cart/{user}/productos', [CartController::class, "index"])->name('user.cart');
    Route::get('/cart/{product}', [CartController::class, "agregar_al_carrito"] )->name('agregar_al_carrito');
    Route::get('/editform/{cart_product}', [CartController::class, "form_edit_cart"] )->name('edit.carrito');
    Route::put('/edit/{cart_product}', [CartController::class, "edit_cart"] )->name('confirm_edit.carrito');
    Route::delete('/delete/{cart_product}', [CartController::class, "delete_cart"] )->name('delete.carrito');
    Route::post('/payment', [CartController::class, "processPayment"])->name('processPayment');
});

Route::get('/remeras/{category}/{gender}', [ProductosController::class, "index"])->name('productos.remeras');
Route::get('/buzos/{category}/{gender}', [ProductosController::class, "index"])->name('productos.buzos');
Route::get('/pantalones/{category}/{gender}', [ProductosController::class, "index"])->name('productos.pantalones');
Route::get('/zapatillas/{category}/{gender}', [ProductosController::class, "index"])->name('productos.zapatillas');
Route::get('/{category}/{product}', [ProductosController::class, "show"])->name('productos.show'); //Vista detalle producto

Route::post('/user/storetoken', [TokenController::class, "store_token"])->name('store.token');

Route::get('/adminlogin', [PanelController::class, "adminLogIn"])->name('panel.adminLogIn');

