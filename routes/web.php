<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColourController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuyingTranscationController;
use App\Http\Controllers\BuyingTranscationItemController;
use App\Http\Controllers\ReportBuyingTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportSellingTransactionController;
use App\Http\Controllers\SellingTransactionController;
use App\Http\Controllers\SellingTransactionItemController;
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

Route::view('/','homepage/index')->name('home');

Route::view('/dashboard','dashboard/index')->name('dashboard');

Route::resource('items',ItemController::class);

Route::post('/items/showDetail', [ItemController::class, 'showDetail'])->name('items.showDetail');
Route::post('/items/showCreate', [ItemController::class, 'showCreate'])->name('items.showCreate');
Route::post('/items/showEdit', [ItemController::class, 'showEdit'])->name('items.showEdit');


Route::resource('categories',CategoryController::class);
Route::resource('sizes',SizeController::class);
Route::resource('colours',ColourController::class);
Route::resource('brands',BrandController::class);

Route::resource('suppliers',SupplierController::class);

Route::resource('users',UserController::class);

Route::resource('buyingtransactions',BuyingTranscationController::class);
Route::resource('buyingtransactionitems',BuyingTranscationItemController::class);

Route::resource('sellingtransactions',SellingTransactionController::class);
Route::resource('sellingtransactionitems',SellingTransactionItemController::class);

Route::resource('reports',ReportController::class);

Route::resource('reportbuyingtransactions',ReportBuyingTransactionController::class);
Route::resource('reportsellingtransactions',ReportSellingTransactionController::class);
