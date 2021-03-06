<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\views;
use App\Http\Controllers\authentication;

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

Route::get('/', [views::class, 'main'])->middleware('auth');
Route::get('/register', [views::class, 'register'])->name('register');
Route::get('/login', [views::class, 'login'])->name('login');

Route::post('/register', [authentication::class, 'register']);
Route::post('/login', [authentication::class, 'login']);
Route::post('/logout', [authentication::class, 'logout']);