<?php

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

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/{product}', [App\Http\Controllers\Controller::class, 'product'])->name('product');
Route::get('/category/{category}', [App\Http\Controllers\Controller::class, 'category'])->name('category');
Route::get('/news', [App\Http\Controllers\Controller::class, 'news'])->name('news');
Route::get('/about', [App\Http\Controllers\Controller::class, 'about'])->name('about');
Route::get('/buy/{product}/user/{user}', [App\Http\Controllers\HomeController::class, 'buy'])->name('buy');
Route::group(['prefix' => 'admin'], function (){
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'showAdminPanel'])->name('admin');
    Route::group(['prefix' => 'categories'], function (){
        Route::get('/', [\App\Http\Controllers\AdminControllerCategories::class, 'showCategories'])->name('admin.categories.index');
        Route::post('/create', [\App\Http\Controllers\AdminControllerCategories::class, 'create'])->name('admin.categories.create');
        Route::post('/delete', [\App\Http\Controllers\AdminControllerCategories::class, 'delete'])->name('admin.categories.delete');
        Route::post('/update', [\App\Http\Controllers\AdminControllerCategories::class, 'update'])->name('admin.categories.update');
        Route::post('/read', [\App\Http\Controllers\AdminControllerCategories::class, 'read'])->name('admin.categories.read');
    });
    Route::group(['prefix' => 'orders'], function (){
        Route::get('/', [\App\Http\Controllers\AdminControllerOrders::class,'showOrders'])->name('admin.orders.index');
        Route::post('/create', [\App\Http\Controllers\AdminControllerOrders::class, 'create'])->name('admin.orders.create');
        Route::post('/delete', [\App\Http\Controllers\AdminControllerOrders::class, 'delete'])->name('admin.orders.delete');
        Route::post('/update', [\App\Http\Controllers\AdminControllerOrders::class, 'update'])->name('admin.orders.update');
        Route::post('/read', [\App\Http\Controllers\AdminControllerOrders::class, 'read'])->name('admin.orders.read');
    });
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', [\App\Http\Controllers\AdminControllerProduct::class,'showProducts'])->name('admin.products.index');
        Route::post('/create', [\App\Http\Controllers\AdminControllerProduct::class, 'create'])->name('admin.products.create');
        Route::post('/delete', [\App\Http\Controllers\AdminControllerProduct::class, 'delete'])->name('admin.products.delete');
        Route::post('/update', [\App\Http\Controllers\AdminControllerProduct::class, 'update'])->name('admin.products.update');
        Route::post('/read', [\App\Http\Controllers\AdminControllerProduct::class, 'read'])->name('admin.products.read');
    });
});

