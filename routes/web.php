<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

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

Route::get('/siswa', [SiswaController::class, 'index']);

Route::get('/siswa/daftar-buku', [SiswaController::class, 'daftarBuku'])->name('daftar-buku');

Route::get('/siswa/riwayat-peminjaman', [SiswaController::class, 'riwayatPeminjaman'])->name('riwayat-peminjaman');

Route::get('/siswa/buku-dipinjam', [SiswaController::class, 'bukuDipinjam'])->name('buku-dipinjam');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);