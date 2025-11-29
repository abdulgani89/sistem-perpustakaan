<?php

namespace App\Http\Controllers;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa-page.siswa-main-page');
    }

    public function daftarBuku()
    {
        return view('siswa-page.content-daftar-buku');
    }
}
