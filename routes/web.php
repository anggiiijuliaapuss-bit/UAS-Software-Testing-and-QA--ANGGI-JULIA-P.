<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// ----- Auth (single user: admin perpus) -----
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// ----- Halaman terproteksi -----
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('buku', BukuController::class);
    Route::get('/buku/{buku}/kode', [BukuController::class, 'kode'])->name('buku.kode');

    Route::resource('anggota', AnggotaController::class)->except(['show']);

    Route::resource('peminjaman', PeminjamanController::class)->except(['show', 'edit', 'update']);
    Route::get('/peminjaman/{peminjaman}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('peminjaman.update');

    Route::resource('pengembalian', PengembalianController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export-excel');
});
