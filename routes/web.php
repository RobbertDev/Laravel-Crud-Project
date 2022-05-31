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

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(ProductController::class)->middleware(['auth'])->group(function () {
    Route::get('/products', 'index')->name('product-overview');

    Route::get('/product/{id}', 'show')->name('product-detail');

    Route::get('/products/create', 'create')->name('product-create');
    Route::post('/products/create', 'store')->name('product-create');

    Route::get('/product/{id}/edit', 'edit')->name('product-edit');
    Route::post('/product/{id}/edit', 'update')->name('product-edit');

    Route::get('/product/{id}/delete', 'destroy')->name('product-delete');
});

require __DIR__.'/auth.php';
