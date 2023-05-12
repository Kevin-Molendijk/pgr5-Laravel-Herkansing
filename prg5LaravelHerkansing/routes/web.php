<?php

use App\Http\Controllers\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'show'])->name('home');
Auth::routes();

Route::resource('storefront', App\Http\Controllers\StoreController::class)->names('products');
Route::resource('tags', App\Http\Controllers\TagsController::class);

Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('products', App\Http\Controllers\EditorController::class);
    Route::get('users', 'App\Http\Controllers\UserController@index')->name('users.index');

    Route::post('users/{user}/make-admin', 'App\Http\Controllers\UserController@makeAdmin')->name('users.make-admin');
    Route::post('products/{product}/toggle-visibility', 'App\Http\Controllers\EditorController@toggleVisibility')->name('products.toggle-visibility');
});
