<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColourController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;
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


Route::view('/','welcome');

Route::resource('items',ItemController::class);

Route::post('/items/showDetail', [ItemController::class, 'showDetail'])->name('items.showDetail');
Route::post('/items/showCreate', [ItemController::class, 'showCreate'])->name('items.showCreate');
Route::post('/items/showEdit', [ItemController::class, 'showEdit'])->name('items.showEdit');


Route::resource('categories',CategoryController::class);
Route::resource('sizes',SizeController::class);
Route::resource('colours',ColourController::class);
Route::resource('brands',BrandController::class);
Route::resource('suppliers',SupplierController::class);
