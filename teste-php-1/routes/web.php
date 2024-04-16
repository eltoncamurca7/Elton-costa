<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
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
    return view('layouts.app');
});

// Rota de cliente
Route::get('/index-client', [ClientController::class, 'index'])->name('index-client');
Route::get('/new-client', [ClientController::class, 'newClient'])->name('new-client');
Route::post('/create-client', [ClientController::class, 'createClient'])->name('create-client');
Route::get('/list-clients', [ClientController::class, 'listClients'])->name('list-clients');
Route::delete('/delete-client/{id}', [ClientController::class, 'deleteClient'])->name('delete-client');
Route::get('/edit-client/{id}', [ClientController::class, 'editClient'])->name('edit-client');
Route::put('/update-client', [ClientController::class, 'updateClient'])->name('update-client');
Route::get('/get-client/{id}', [ClientController::class, 'getClientById'])->name('get-client');
Route::get('/details-client/{id}', [ClientController::class, 'detailsClient'])->name('details-client');

Route::get('/sort-clients/{field}', [ClientController::class, 'sortClients'])->name('sort-clients');

Route::delete('/deleteSelectedClient', [ClientController::class, 'deleteSelected'])->name('clients-deleteSelected');

// Rotas de produto
Route::get('/index-product', [ProductsController::class, 'index'])->name('index-product');
Route::get('/new-product', [ProductsController::class, 'newProduct'])->name('new-product');
Route::post('/create-product', [ProductsController::class, 'createProduct'])->name('create-product');
Route::get('/list-products', [ProductsController::class, 'listProducts'])->name('list-products');
Route::delete('/delete-product/{id}', [ProductsController::class, 'deleteProduct'])->name('delete-product');
Route::get('/edit-product/{id}', [ProductsController::class, 'editProduct'])->name('edit-product');
Route::put('/update-product', [ProductsController::class, 'updateProduct'])->name('update-product');
Route::get('/details-product/{id}', [ProductsController::class, 'detailsProduct'])->name('details-product');

Route::get('/sort-products/{field}', [ProductsController::class, 'sortProducts'])->name('sort-products');

// Rotas de pedidos
Route::get('/index-order', [OrderController::class, 'index'])->name('index-order');
Route::get('/new-order', [OrderController::class, 'newOrders'])->name('new-order');
Route::post('/resgister-order', [OrderController::class, 'registerOrders'])->name('resgister-order');
Route::get('/list-orders', [OrderController::class, 'listOrders'])->name('list-orders');
Route::post('/update-status-orders/{id}', [OrderController::class, 'upsateStatusOrders'])->name('update-status-orders');
