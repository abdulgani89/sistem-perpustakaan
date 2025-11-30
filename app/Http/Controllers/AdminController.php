<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
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
        $books = Buku::orderBy('tahun_terbit', 'desc')->get();
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('status', 'tersedia')->count();
        $bukuDipinjam = Buku::where('status', 'dipinjam')->count();
        
        return view('admin-page.content-buku-admin', compact('books', 'totalBuku', 'bukuTersedia', 'bukuDipinjam'));
    }

    public function storeBuku(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'nullable|string|max:225',
            'judul_buku' => 'required|string|max:225',
            'pengarang' => 'required|string|max:225',
            'penerbit' => 'required|string|max:45',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|string|max:225',
            'stok' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,dipinjam',
        ]);

        Buku::create($validated);
        return response()->json(['message' => 'Buku berhasil ditambahkan!'], 201);
    }

    public function deleteBuku($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan.'], 404);
        }

        $buku->delete();
        return response()->json(['message' => 'Buku berhasil dihapus.'], 200);
    }

    public function getBuku($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan.'], 404);
        }

        return response()->json($buku, 200);
    }
    
    public function updateBuku(Request $request, $id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json(['message' => 'Buku tidak ditemukan.'], 404);
        }
        
        $validated = $request->validate([
            'kode_buku' => 'nullable|string|max:225',
            'judul_buku' => 'required|string|max:225',
            'pengarang' => 'required|string|max:225',
            'penerbit' => 'required|string|max:45',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|string|max:225',
            'stok' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,dipinjam',
        ]);
        
        $buku->update($validated);
        return response()->json(['message' => 'Buku berhasil diupdate!'], 200);
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
