<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/level/tambah', [LevelController::class, 'create']);

Route::prefix('/kategori')->controller(KategoriController::class)->group(function () {
    Route::get("/", 'index');
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/edit/{id}', 'edit');
    Route::put('/update/{id}', 'update');
    Route::get('/destroy/{id}', 'destroy');
});

Route::resource('m_user', POSController::class);

// Route::get("/user", [UserController::class, 'index'])->name('/user');
// Route::get("/user/tambah", [UserController::class, 'tambah'])->name('/user/tambah');
// Route::post("/user/tambah_simpan", [UserController::class, 'tambah_simpan'])->name('/user/tambah_simpan');
// Route::get("/user/ubah/{id}", [UserController::class, 'ubah'])->name('/user/ubah');
// Route::put("/user/ubah_simpan/{id}", [UserController::class, 'ubah_simpan'])->name('/user/ubah_simpan');
// Route::get("/user/hapus/{id}", [UserController::class, 'hapus'])->name('/user/hapus');
