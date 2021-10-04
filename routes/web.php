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

