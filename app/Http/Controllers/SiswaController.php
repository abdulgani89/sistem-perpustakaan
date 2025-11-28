<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa-page.siswa-main-page');
    }
    
    public function daftarBuku()
    {
        $books = [
            ['title' => 'Buku A', 'author' => 'Author A'],
            ['title' => 'Buku B', 'author' => 'Author B'],
            ['title' => 'Buku C', 'author' => 'Author C'],
        ];

        return view('siswa-page.content-daftar-buku', ['books' => $books]);
    }
    
    public function riwayatPeminjaman()
    {
        $riwayat = [
            ['title' => 'Buku X', 'author' => 'Author X', 'borrowed_on' => '2024-01-15', 'returned_on' => '2024-01-25'],
            ['title' => 'Buku Y', 'author' => 'Author Y', 'borrowed_on' => '2024-02-10', 'returned_on' => '2024-02-20'],
            ['title' => 'Buku Z', 'author' => 'Author Z', 'borrowed_on' => '2024-03-05', 'returned_on' => '2024-03-15'],
        ];

        return view('siswa-page.content-riwayat-peminjaman', ['riwayat' => $riwayat]);
    }
}
