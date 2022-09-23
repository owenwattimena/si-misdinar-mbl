<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\MisaController;
use App\Http\Controllers\Web\KeuanganController;
use App\Http\Controllers\Web\MisdinarController;
use App\Http\Controllers\Web\PelayanMisaController;
use App\Http\Controllers\Web\JadwalIbadahController;
use App\Http\Controllers\Web\ProgramKerjaController;

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
    return view('home.index');
})->name('home');

Route::prefix('misdinar')->group(function () {
    Route::get('/', [MisdinarController::class, 'index'])->name('misdinar');
    Route::post('/', [MisdinarController::class, 'store'])->name('misdinar.store');
    Route::put('/{id}', [MisdinarController::class, 'update'])->name('misdinar.update');
    Route::get('/{id}', [MisdinarController::class, 'delete'])->name('misdinar.delete');
});

Route::prefix('program-kerja')->group(function(){
    Route::get('/', [ProgramKerjaController::class, 'index'])->name('program-kerja');
    Route::get('/tambah', [ProgramKerjaController::class, 'tambah'])->name('program-kerja.tambah');
    Route::post('/tambah', [ProgramKerjaController::class, 'store'])->name('program-kerja.store');
    Route::get('/{id}', [ProgramKerjaController::class, 'detail'])->name('program-kerja.detail');
    Route::put('/{id}', [ProgramKerjaController::class, 'update'])->name('program-kerja.update');
    Route::get('/delete/{id}', [ProgramKerjaController::class, 'delete'])->name('program-kerja.delete');
});

Route::prefix('jadwal-ibadah')->group(function(){
    Route::get('/', [JadwalIbadahController::class, 'index'])->name('jadwal-ibadah');
    Route::post('/tambah', [JadwalIbadahController::class, 'store'])->name('jadwal-ibadah.store');
    Route::put('/{id}', [JadwalIbadahController::class, 'update'])->name('jadwal-ibadah.update');
    Route::get('/delete/{id}', [JadwalIbadahController::class, 'delete'])->name('jadwal-ibadah.delete');
});

Route::prefix('pelayan-misa')->group(function(){
    Route::get('/', [PelayanMisaController::class, 'index'])->name('pelayan-misa');
    Route::post('/', [PelayanMisaController::class, 'store'])->name('pelayan-misa.store');
    Route::put('/{id}', [PelayanMisaController::class, 'update'])->name('pelayan-misa.update');
    Route::get('/delete/{id}', [PelayanMisaController::class, 'delete'])->name('pelayan-misa.delete');

    Route::get('/{id}/misa', [MisaController::class, 'index'])->name('pelayan-misa.misa');
    Route::post('/{id}/misa', [MisaController::class, 'store'])->name('pelayan-misa.misa.store');
    Route::put('/{id}/misa/{idMisa}', [MisaController::class, 'update'])->name('pelayan-misa.misa.update');
    Route::get('/{id}/misa/{idMisa}/hapus', [MisaController::class, 'delete'])->name('pelayan-misa.misa.delete');

    Route::post('/{id}/misa/{idMisa}/misdinar', [MisaController::class, 'misdinar'])->name('pelayan-misa.misa.store.misdinar');
    Route::get('/{id}/misa/{idMisa}/misdinar/{idPelayan}/hapus', [MisaController::class, 'deleteMisdinar'])->name('pelayan-misa.misa.store.misdinar.hapus');
});

Route::prefix('keuangan')->group(function(){
    Route::get('/', [KeuanganController::class, 'index'])->name('keuangan');
    Route::post('/', [KeuanganController::class, 'store'])->name('keuangan.store');
    Route::get('{id}/hapus',[KeuanganController::class, 'delete'])->name('keuangan.delete');
});


Route::middleware(['guest'])->group(function () {
    Route::prefix('masuk')->group(function(){
        Route::get("", [AuthController::class, 'login'])->name('login');
        Route::post("", [AuthController::class, 'doLogin'])->name('login.do');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::get("logout", [AuthController::class, 'logout'])->name('logout');
});