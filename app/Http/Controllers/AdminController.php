<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin-page.admin-dashboard');
    }

    public function dashboard()
    {
        $today = Carbon::today();
        $peminjamHariIni = Peminjaman::whereDate('tanggal_pinjam', $today)
                                        ->distinct('id_siswa')
                                        ->count('id_siswa');
        
        $bukuDipinjamHariIni = Peminjaman::whereDate('tanggal_pinjam', $today)
                                        ->count();

        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;
        $peminjamBulanIni = Peminjaman::whereMonth('tanggal_pinjam', $bulanIni)
                                              ->whereYear('tanggal_pinjam', $tahunIni)
                                              ->distinct('id_siswa')
                                              ->count('id_siswa');
        $bukuDipinjamBulanIni = Peminjaman::whereMonth('tanggal_pinjam', $bulanIni)
                                              ->whereYear('tanggal_pinjam', $tahunIni)
                                              ->count();
        
        $peminjamTahunIni = Peminjaman::whereYear('tanggal_pinjam', $tahunIni)
                                        ->distinct('id_siswa')
                                        ->count('id_siswa');
        $bukuDipinjamTahunIni = Peminjaman::whereYear('tanggal_pinjam', $tahunIni)
                                        ->count();

        $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $chartDataBulan = [];
        
        return view('admin-page.content-dashboard-admin', compact(
            'peminjamHariIni',
            'bukuDipinjamHariIni',
            'peminjamBulanIni',
            'bukuDipinjamBulanIni',
            'peminjamTahunIni',
            'bukuDipinjamTahunIni',
            'chartLabels',
            'chartDataBulan'
        ));
    }

    public function buku()
    {
        return view('admin-page.content-buku');
    }

    public function siswa()
    {
        return view('admin-page.content-siswa');
    }

    public function transaksi()
    {
        return view('admin-page.content-transaksi');
    }

    public function aktivitas()
    {
        return view('admin-page.content-aktivitas');
    }
}
