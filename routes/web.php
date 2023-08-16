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

Route::get('/', function () {
    return view('welcome');
});

// 以下２行はAuth作成時に自動作成。消さない
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
Route::post('/products/store', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
