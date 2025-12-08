<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;
use App\Models\Pengembalian;
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
        $chartDataHilang = [];
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $jumlahPeminjam = Peminjaman::whereMonth('tanggal_pinjam', $bulan)
                                        ->whereYear('tanggal_pinjam', $tahunIni)
                                        ->distinct('id_siswa')
                                        ->count('id_siswa');
            $chartDataBulan[] = $jumlahPeminjam;
            

            $bukuHilangBulan = Pengembalian::join('peminjaman', 'pengembalian.id_peminjaman', '=', 'peminjaman.id_peminjaman')
                                          ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
                                          ->whereMonth('pengembalian.created_at', $bulan)
                                          ->whereYear('pengembalian.created_at', $tahunIni)
                                          ->whereRaw('(SELECT hilang FROM buku WHERE buku.id_buku = peminjaman.id_buku) > 0')
                                          ->count();
            
            $chartDataHilang[] = $bukuHilangBulan;
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
            'chartDataHilang',
            'bukuTersedia',
            'bukuDipinjam',
            'bukuHilang'
        ));
    }

    public function exportData(Request $request)
    {
        $bulanIni = $request->input('bulan', Carbon::now()->month);
        $tahunIni = Carbon::now()->year;
        
        $peminjaman = Peminjaman::with(['siswa', 'buku'])
                                ->whereMonth('tanggal_pinjam', $bulanIni)
                                ->whereYear('tanggal_pinjam', $tahunIni)
                                ->get()
                                ->map(function($item) {
                                    return [
                                        'id_peminjaman' => $item->id_peminjaman,
                                        'siswa' => $item->siswa->nama_siswa ?? '-',
                                        'buku' => $item->buku->judul_buku ?? '-',
                                        'tanggal_pinjam' => $item->tanggal_pinjam,
                                        'tanggal_kembali' => $item->tanggal_kembali,
                                        'status' => $item->status,
                                    ];
                                });
        
        $pengembalian = Pengembalian::with(['peminjaman.siswa', 'peminjaman.buku'])
                                    ->whereMonth('tanggal_pengembalian', $bulanIni)
                                    ->whereYear('tanggal_pengembalian', $tahunIni)
                                    ->get()
                                    ->map(function($item) {
                                        return [
                                            'id_pengembalian' => $item->id_pengembalian,
                                            'siswa' => $item->peminjaman->siswa->nama_siswa ?? '-',
                                            'buku' => $item->peminjaman->buku->judul_buku ?? '-',
                                            'tanggal_pengembalian' => $item->tanggal_pengembalian,
                                            'denda' => $item->denda,
                                        ];
                                    });
        
        $buku = Buku::all()->map(function($item) {
            return [
                'id_buku' => $item->id_buku,
                'judul_buku' => $item->judul_buku,
                'pengarang' => $item->pengarang,
                'penerbit' => $item->penerbit,
                'tahun_terbit' => $item->tahun_terbit,
                'kategori' => $item->kategori,
                'stok' => $item->stok,
                'hilang' => $item->hilang,
                'status' => $item->status,
            ];
        });
        
        $siswa = Siswa::all()->map(function($item) {
            return [
                'id_siswa' => $item->id_siswa,
                'nama_siswa' => $item->nama_siswa,
                'kelas' => $item->kelas,
                'alamat' => $item->alamat,
                'no_telp' => $item->no_telp,
            ];
        });
        
        $namaBulan = Carbon::create()->month($bulanIni)->locale('id')->translatedFormat('F Y');
        
        $data = [
            'exported_at' => Carbon::now()->toDateTimeString(),
            'bulan' => $namaBulan,
            'summary' => [
                'total_peminjaman' => $peminjaman->count(),
                'total_pengembalian' => $pengembalian->count(),
                'total_buku' => $buku->count(),
                'total_siswa' => $siswa->count(),
                'buku_hilang' => Buku::sum('hilang'),
                'buku_dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            ],
            'peminjaman' => $peminjaman,
            'pengembalian' => $pengembalian,
            'buku' => $buku,
            'siswa' => $siswa,
        ];
        
        $filename = 'laporan-perpustakaan-' . Carbon::create()->month($bulanIni)->format('F-Y') . '.json';
        
        return response()->json($data, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
