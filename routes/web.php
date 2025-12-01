<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| LOGIN PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'loginUtama'])->name('login.utama');


Route::get('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'authAdmin']);


Route::get('/login/kepala', [AuthController::class, 'loginKepala'])->name('login.kepala');
Route::post('/login/kepala', [AuthController::class, 'authKepala']);


Route::get('/login/siswa', [AuthController::class, 'loginSiswa'])->name('siswa.login');
Route::post('/login/siswa', [AuthController::class, 'authSiswa'])->name('auth.siswa');

/*
|--------------------------------------------------------------------------
| DASHBOARD PAGE
|--------------------------------------------------------------------------
*/


Route::middleware(['checkAdminAuth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('index-admin');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    
    Route::get('/admin/buku', [AdminController::class, 'buku'])->name('admin.buku');
    Route::post('/admin/buku/store', [AdminController::class, 'storeBuku'])->name('admin.buku.store');
    Route::get('/admin/buku/{id}', [AdminController::class, 'getBuku'])->name('admin.buku.get');
    Route::post('/admin/buku/{id}', [AdminController::class, 'updateBuku'])->name('admin.buku.update');
    Route::delete('/admin/buku/{id}', [AdminController::class, 'deleteBuku'])->name('admin.buku.delete');
    
    Route::get('/admin/siswa', [AdminController::class, 'siswa'])->name('admin.siswa');
    Route::post('/admin/siswa/store', [AdminController::class, 'storeSiswa'])->name('admin.siswa.store');
    Route::get('/admin/siswa/{id}', [AdminController::class, 'getSiswa'])->name('admin.siswa.get');
    Route::post('/admin/siswa/{id}', [AdminController::class, 'updateSiswa'])->name('admin.siswa.update');
    Route::delete('/admin/siswa/{id}', [AdminController::class, 'deleteSiswa'])->name('admin.siswa.delete');
    
    Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');
    Route::post('/admin/transaksi/pengembalian', [AdminController::class, 'prosesPengembalian'])->name('admin.prosesPengembalian');
    Route::post('/admin/transaksi/buku-hilang', [AdminController::class, 'prosesBukuHilang'])->name('admin.prosesBukuHilang');
    Route::get('/admin/aktivitas', [AdminController::class, 'aktivitas'])->name('admin.aktivitas');
});


Route::get('/kepala/dashboard', [KepalaController::class, 'index'])->name('kepala.dashboard');


Route::middleware(['checkSiswaAuth'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/daftar-buku', [SiswaController::class, 'daftarBuku'])->name('daftar-buku');
    Route::get('/siswa/riwayat-peminjaman', [SiswaController::class, 'riwayatPeminjaman'])->name('riwayat-peminjaman');
    Route::get('/siswa/buku-dipinjam', [SiswaController::class, 'bukuDipinjam'])->name('buku-dipinjam');
    Route::get('/siswa/search-book', [SiswaController::class, 'searchBook'])->name('search-book');
    Route::post('/siswa/pinjam-buku', [SiswaController::class, 'pinjamBuku'])->name('siswa.pinjamBuku');
});

Route::middleware(['checkKepalaAuth'])->group(function () {
    Route::get('/kepala', [KepalaController::class, 'index'])->name('kepala.index');
    Route::get('/kepala/export-data', [KepalaController::class, 'exportData'])->name('kepala.exportData');
});
// LOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
