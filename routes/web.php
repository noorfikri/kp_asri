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
use App\Http\Controllers\MessageController;
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

Auth::routes();

Route::get('/',[MessageController::class,'review'])->name('home');

Route::get('/gallery',[ItemController::class,'gallery'])->name('gallery');
Route::view('/contact','homepage/contact')->name('contact');

Route::middleware(['auth'])->group(function(){
    Route::view('/admin','dashboard/index')->name('dashboard');
    Route::view('/admin/profile','profile/index')->name('profile');

    Route::resource('/admin/suppliers',SupplierController::class);
    Route::post('/admin/suppliers/showDetail', [SupplierController::class, 'showDetail'])->name('suppliers.showDetail');
    Route::post('/admin/suppliers/showCreate', [SupplierController::class, 'showCreate'])->name('suppliers.showCreate');
    Route::post('/admin/suppliers/showEdit', [SupplierController::class, 'showEdit'])->name('suppliers.showEdit');

    Route::resource('/admin/items',ItemController::class);
    Route::post('/admin/items/showDetail', [ItemController::class, 'showDetail'])->name('items.showDetail');
    Route::post('/admin/items/showCreate', [ItemController::class, 'showCreate'])->name('items.showCreate');
    Route::post('/admin/items/showEdit', [ItemController::class, 'showEdit'])->name('items.showEdit');

    Route::resource('/admin/categories',CategoryController::class);
    Route::post('/admin/categories/showCreate', [CategoryController::class, 'showCreate'])->name('categories.showCreate');
    Route::post('/admin/categories/showEdit', [CategoryController::class, 'showEdit'])->name('categories.showEdit');

    Route::resource('/admin/sizes',SizeController::class);
    Route::post('/admin/sizes/showCreate', [SizeController::class, 'showCreate'])->name('sizes.showCreate');
    Route::post('/admin/sizes/showEdit', [SizeController::class, 'showEdit'])->name('sizes.showEdit');

    Route::resource('/admin/colours',ColourController::class);
    Route::post('/admin/colours/showCreate', [ColourController::class, 'showCreate'])->name('colours.showCreate');
    Route::post('/admin/colours/showEdit', [ColourController::class, 'showEdit'])->name('colours.showEdit');

    Route::resource('/admin/brands',BrandController::class);
    Route::post('/admin/brands/showCreate', [BrandController::class, 'showCreate'])->name('brands.showCreate');
    Route::post('/admin/brands/showEdit', [BrandController::class, 'showEdit'])->name('brands.showEdit');

    Route::resource('/admin/users',UserController::class);
    Route::post('/admin/users/showDetail', [UserController::class, 'showDetail'])->name('users.showDetail');
    Route::post('/admin/users/showCreate', [UserController::class, 'showCreate'])->name('users.showCreate');
    Route::post('/admin/users/showEdit', [UserController::class, 'showEdit'])->name('users.showEdit');
    Route::post('/admin/users/updateProfile/{user}', [UserController::class, 'updateProfile'])->name('users.updateProfile');

    Route::resource('/admin/messages',MessageController::class);
    Route::post('/admin/messages/showDetail', [MessageController::class, 'showDetail'])->name('messages.showDetail');

    Route::resource('/admin/buyingtransactions',BuyingTranscationController::class);
    Route::resource('/admin/buyingtransactionitems',BuyingTranscationItemController::class);

    Route::resource('/admin/sellingtransactions',SellingTransactionController::class);
    Route::resource('/admin/sellingtransactionitems',SellingTransactionItemController::class);

    Route::resource('/admin/reports',ReportController::class);

    Route::resource('/admin/reportbuyingtransactions',ReportBuyingTransactionController::class);
    Route::resource('/admin/reportsellingtransactions',ReportSellingTransactionController::class);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
