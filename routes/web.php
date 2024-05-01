<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LondriController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\SatuanController;
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

Route::get('/jasa', function () {
    return view('jasa');
})->name('jasa');

Route::get('/sewa', function () {
    return view('sewa');
})->name('sewa');



Route::get('/sesi', [LoginController::class, 'index']);
Route::post('/sesi/login', [LoginController::class, 'login'])->name('login');

Route::get('/londri', [LondriController::class, 'index']);

Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan');
Route::get('/satuan/create', [SatuanController::class, 'create'])->name('satuan.create');
Route::post('/satuan/store', [SatuanController::class, 'store'])->name('satuan.store');
Route::put('/satuan/update/{id}', [SatuanController::class, 'update'])->name('satuan.update');
Route::put('/satuan/aktion/{id}', [SatuanController::class, 'aktion'])->name('satuan.aktion');

Route::get('paket', [PaketController::class, 'index'])->name('paket');
Route::get('/paket', [PaketController::class, 'index'])->name('paket');
Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
Route::post('/paket/store', [PaketController::class, 'store'])->name('paket.store');
Route::put('/paket/update/{id}', [PaketController::class, 'update'])->name('paket.update');
Route::put('/paket/aktion/{id}', [PaketController::class, 'aktion'])->name('paket.aktion');


