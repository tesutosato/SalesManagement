<?php
// Routeというツールを使うために必要な部品を読み込み
use Illuminate\Support\Facades\Route;
// ProductControllerに繋げるために取り込む(2/8追加)
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

// 以下２行はAuth作成時に自動作成。消さない
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('index')->middleware('auth');
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create')->middleware('auth');
Route::post('/products/store', [App\Http\Controllers\ProductController::class, 'store'])->name('store')->middleware('auth');

Route::get('/products/show/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('show');

Route::get('/products/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
Route::put('/products/edit/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');


Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');
