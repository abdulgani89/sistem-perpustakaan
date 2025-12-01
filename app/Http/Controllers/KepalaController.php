<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Peminjaman;
use App\Models\Buku;
use Carbon\Carbon;

class KepalaController extends Controller
{
    public function index()
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

        $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $chartDataBulan = [];
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $jumlahPeminjam = Peminjaman::whereMonth('tanggal_pinjam', $bulan)
                                        ->whereYear('tanggal_pinjam', $tahunIni)
                                        ->distinct('id_siswa')
                                        ->count('id_siswa');
            $chartDataBulan[] = $jumlahPeminjam;
        }
        
        $totalBuku = Buku::sum('stok');
        $bukuHilang = Buku::sum('hilang');
        $bukuDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $bukuTersedia = $totalBuku - $bukuHilang - $bukuDipinjam;
        
        return view('kepala-perpus-page.kepala-perpus-main-page', compact(
            'peminjamHariIni',
            'bukuDipinjamHariIni',
            'peminjamBulanIni',
            'bukuDipinjamBulanIni',
            'peminjamTahunIni',
            'bukuDipinjamTahunIni',
            'chartLabels',
            'chartDataBulan',
            'bukuTersedia',
            'bukuDipinjam',
            'bukuHilang'
        ));
    }
}
