<?php

use App\Http\Controllers\Admin\Categories;
use App\Http\Controllers\Data\Products;
use App\Http\Controllers\User\Auth;
use App\Http\Controllers\Views;
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



Route::prefix('/')->group(function(){
    
    Route::get('/login', [Views::class, 'login'])->middleware('guest')->name('login');
    Route::get('/register', [Views::class, 'register'])->middleware('guest')->name('register');
    Route::get('/forgot-password', [Views::class, 'forgot_password'])->middleware('guest')->name('password.request');
    Route::get('/reset-password/{token}', [Views::class, 'reset_password'])->middleware('guest')->name('password.reset');


    Route::post('/forgot-password', [Auth::class, 'forgot_password'])->middleware('guest')->name('password.email');
    Route::post('/reset-password', [Auth::class, 'reset-password'])->middleware('guest')->name('password.update');
    Route::post('/login', [Auth::class, 'login'])->middleware('guest')->name('loginP');
    Route::post('/register', [Auth::class, 'register'])->middleware('guest')->name('registerP');
    Route::post('/logout', [Auth::class, 'logout'])->middleware('auth')->name('logoutP');


    Route::get('/categories', [Categories::class, 'add'])->middleware('auth');
    Route::post('/categories', [Categories::class, 'create'])->middleware('auth');


    Route::prefix('/products')->group(function(){

        Route::get('/', [Products::class, 'index'])->middleware('auth')->name('main');
        Route::get('/product', [Products::class, 'find'])->middleware('auth')->name('product');
        Route::get('/add', [Views::class, 'add_product'])->middleware('auth')->name('add');
        Route::get('/update', [Views::class, 'update_product'])->middleware('auth')->name('edit');
        Route::get('/byCategory', [Products::class, 'byCategory'])->middleware('auth')->name('byCategory');

        Route::post('/', [Products::class, 'create'])->middleware('auth')->name('create');
        Route::post('/update', [Products::class, 'update'])->middleware('auth')->name('update');
        Route::post('/delete', [Products::class, 'delete'])->middleware('auth')->name('delete');
    });


});