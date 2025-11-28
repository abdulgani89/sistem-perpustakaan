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
}
