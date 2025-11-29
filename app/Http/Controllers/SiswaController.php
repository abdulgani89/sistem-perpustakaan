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
    
    public function riwayatPeminjaman()
    {
        $riwayat = [
            ['title' => 'Buku X', 'author' => 'Author X', 'borrowed_on' => '2024-01-15', 'returned_on' => '2024-01-25'],
            ['title' => 'Buku Y', 'author' => 'Author Y', 'borrowed_on' => '2024-02-10', 'returned_on' => '2024-02-20'],
            ['title' => 'Buku Z', 'author' => 'Author Z', 'borrowed_on' => '2024-03-05', 'returned_on' => '2024-03-15'],
        ];

        return view('siswa-page.content-riwayat-peminjaman', ['riwayat' => $riwayat]);
    }

    public function bukuDipinjam()
    {
        $pinjam = [
            ['title' => 'Buku M', 'author' => 'Author M', 'borrowed_on' => '2024-04-01', 'due_date' => '2024-04-15'],
            ['title' => 'Buku N', 'author' => 'Author N', 'borrowed_on' => '2024-04-05', 'due_date' => '2026-04-20'],
        ];
        return view('siswa-page.content-buku-dipinjam', ['pinjam' => $pinjam]);
    }
}
