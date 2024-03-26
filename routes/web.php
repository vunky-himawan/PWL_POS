<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => "user"], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::resource('m_user', POSController::class);

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/level/tambah', [LevelController::class, 'create']);

// Route::prefix('/kategori')->controller(KategoriController::class)->group(function () {
//     Route::get("/", 'index');
//     Route::get('/create', 'create');
//     Route::post('/', 'store');
//     Route::get('/edit/{id}', 'edit');
//     Route::put('/update/{id}', 'update');
//     Route::get('/destroy/{id}', 'destroy');
// });

// Route::get("/user", [UserController::class, 'index'])->name('/user');
// Route::get("/user/tambah", [UserController::class, 'tambah'])->name('/user/tambah');
// Route::post("/user/tambah_simpan", [UserController::class, 'tambah_simpan'])->name('/user/tambah_simpan');
// Route::get("/user/ubah/{id}", [UserController::class, 'ubah'])->name('/user/ubah');
// Route::put("/user/ubah_simpan/{id}", [UserController::class, 'ubah_simpan'])->name('/user/ubah_simpan');
// Route::get("/user/hapus/{id}", [UserController::class, 'hapus'])->name('/user/hapus');
