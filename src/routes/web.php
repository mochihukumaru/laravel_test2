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

Route::get('/products',[ProductController::class,'index'])->name('index');
Route::get('/products/search',[ProductController::class,'search'])->name('products.search');
Route::get('/products/register',[ProductController::class,'register'])->name('register');
Route::post('/products',[ProductController::class,'store'])->name('store');
Route::get('/products/{productId}',[ProductController::class,'show'])->name('show');
Route::PATCH('/products/{productId}/update',[ProductController::class,'update'])->name('update');
Route::delete('products/{productId}/delete',[ProductController::class,'destroy'])->name('delete');

