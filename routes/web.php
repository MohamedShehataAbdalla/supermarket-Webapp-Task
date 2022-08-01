<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



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

Route::resource('products', ProductController::class);
Route::get('product/trash', [ProductController::class, 'trash'])->name('products.trash');
Route::get('product/softDelete/{id}', [ProductController::class,'softDelete'])->name('product.softDelete');
Route::get('product/hardDelete/{id}', [ProductController::class,'hardDelete'])->name('product.hardDelete');
Route::get('product/recover/{id}', [ProductController::class, 'recover'])->name('product.recover');
Route::get('product/active/{id}', [ProductController::class, 'active'])->name('product.active');
Route::get('product/deactive/{id}', [ProductController::class, 'deactive'])->name('product.deactive');

