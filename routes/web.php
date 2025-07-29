<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlternatifMerekhp;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubkriteriaController;

//LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
});

// ADMIN
Route::middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // LOGOUT
    Route::get('/logout', [AuthController::class, 'logout']);
    // ALTERNATIF
    Route::get('/alternatif', [AlternatifMerekhp::class, 'index'])->name('alternatif.index');
    Route::post('/alternatif-add', [AlternatifMerekhp::class, 'store'])->name('alternatif.store');
    Route::get('/alternatif-edit/{id}', [AlternatifMerekhp::class, 'edit']);
    Route::post('/alternatif-edit/{id}', [AlternatifMerekhp::class, 'update']);
    Route::get('/alternatif-destroy/{id}', [AlternatifMerekhp::class, 'destroy']);
    Route::get('/alternatif-show/{id}', [AlternatifMerekhp::class, 'show'])->name('alternatif.show');
    Route::get('/alternatif-cetak', [AlternatifMerekhp::class, 'cetakalternatif'])->name('alternatif.cetak');
    //KRITERIA
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::post('/kriteria-add', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria-edit/{id}', [KriteriaController::class, 'edit']);
    Route::post('/kriteria-edit/{id}', [KriteriaController::class, 'update']);
    Route::get('/kriteria-destroy/{id}', [KriteriaController::class, 'destroy']);
    Route::get('/kriteria-show/{id}', [KriteriaController::class, 'show'])->name('kriteria.show');
    //SUB-KRITERIA
    Route::get('/kriteria/{kriteria}/sub', [SubkriteriaController::class, 'showSubPage'])->name('kriteria.sub');
    Route::post('/subkriteria-add', [SubkriteriaController::class, 'store'])->name('subkriteria.store');
    Route::get('/subkriteria-destroy/{id}', [SubkriteriaController::class, 'destroy']);
    //Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian-add', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian-destroy/{alternatif_id}', [PenilaianController::class, 'destroy']);
    //PERHITUNGAN
    Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
    Route::get('/perhitungan-cetak', [PerhitunganController::class, 'cetakperhitungan'])->name('perhitungan.cetak');
    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-add', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-edit/{id}', [UserController::class, 'edit']);
    Route::post('/user-edit/{id}', [UserController::class, 'update']);
    Route::get('/user-destroy/{id}', [UserController::class, 'destroy']);
    Route::get('/user-show/{id}', [UserController::class, 'show'])->name('user.show');
    // LAPORAN
    Route::get('/laporan-cetak', [LaporanController::class, 'cetaklaporan'])->name('laporan.cetak');
});
