<?php

use App\Http\Controllers\Api\DetailTransaksiController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/barang/{id}/get', [BarangController::class, 'get'])->middleware('api');
Route::post('/register', RegisterController::class)->name('register');
Route::post('/register1', RegisterController::class)->name('register1');
Route::post('/login', LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', LogoutController::class)->name('logout');

/* LEVEL */
Route::get('levels', [LevelController::class, 'index']);
Route::post('levels', [LevelController::class, 'store']);
Route::get('levels/{level}', [LevelController::class, 'show']);
Route::put('levels/{level}', [LevelController::class, 'update']);
Route::delete('levels/{level}', [LevelController::class, 'destroy']);

/* KATEGORI */
Route::get('categories', [KategoriController::class, 'index']);
Route::post('categories', [KategoriController::class, 'store']);
Route::get('categories/{category}', [KategoriController::class, 'show']);
Route::put('categories/{category}', [KategoriController::class, 'update']);
Route::delete('categories/{category}', [KategoriController::class, 'destroy']);

/* BARANG */
Route::get('products', [BarangController::class, 'index']);
Route::post('products', [BarangController::class, 'store']);
Route::get('products/{product}', [BarangController::class, 'show']);
Route::put('products/{product}', [BarangController::class, 'update']);
Route::delete('products/{product}', [BarangController::class, 'destroy']);

/* TRANSAKSI */
Route::get('transactions', [DetailTransaksiController::class, 'index']);
Route::post('transactions', [DetailTransaksiController::class, 'store']);
Route::get('transactions/{transaction}', [DetailTransaksiController::class, 'show']);
Route::put('transactions/{transaction}', [DetailTransaksiController::class, 'update']);
Route::delete('transactions/{transaction}', [DetailTransaksiController::class, 'destroy']);

/* USER */
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/{user}', [UserController::class, 'update']);
Route::delete('users/{user}', [UserController::class, 'destroy']);
