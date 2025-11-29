<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin-page.admin-dashboard');
    }

    public function dashboard()
    {
        $peminjaman = [
            ['id_peminjaman' => '001', 'buku_id_buku' => 'B001', 'siswa_id_siswa' => 'S001', 'tanggal_pinjaman' => '2024-04-10', 'tanggal_kembali' => '2024-04-20'  ],
            ['id_peminjaman' => '002', 'buku_id_buku' => 'B002', 'siswa_id_siswa' => 'S002', 'tanggal_pinjaman' => '2024-04-11', 'tanggal_kembali' => '2024-04-21'  ],
            ['id_peminjaman' => '003', 'buku_id_buku' => 'B003', 'siswa_id_siswa' => 'S003', 'tanggal_pinjaman' => '2024-04-12', 'tanggal_kembali' => '2024-04-22'  ],
        ];

        return view('admin-page.content-dashboard-admin', ['peminjaman' => $peminjaman]);
    }
    
}
