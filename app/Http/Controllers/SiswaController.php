<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa-page.siswa-main-page');
    }

    public function daftarBuku()
    {
        $books = Buku::all();
        return view('siswa-page.content-daftar-buku', ['books' => $books]);

    }
    
    public function riwayatPeminjaman()
    {
        $riwayat = Peminjaman::with(['buku', 'siswa'])
                            ->where('id_siswa', session('id_siswa'))
                            ->where('status', 'dikembalikan') 
                            ->orderBy('tanggal_kembali', 'desc') 
                            ->get();

        return view('siswa-page.content-riwayat-peminjaman', ['riwayat' => $riwayat]);
    }

    public function bukuDipinjam()
    {
        $pinjam = Peminjaman::with(['buku', 'siswa'])
                           ->where('id_siswa', session('id_siswa'))
                           ->where('status', 'dipinjam')
                           ->orderBy('tanggal_pinjam', 'desc')
                           ->get();

        return view('siswa-page.content-buku-dipinjam', ['pinjam' => $pinjam]);
    }

    public function searchBook(Request $request)
    {
        $query = $request->input('q');

        $buku = Buku::where('status', 'tersedia')
                    ->where(function($q) use ($query) {
                        $q->where('judul_buku', 'LIKE', "%{$query}%")
                          ->orWhere('pengarang', 'LIKE', "%{$query}%")
                          ->orWhere('penerbit', 'LIKE', "%{$query}%");
                    })
                    ->get();

        return view('siswa-page.content-search-book', compact('buku'));
    }

    public function pinjamBuku(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
            'durasi' => 'required|integer|min:1|max:14',
        ]);

        $buku = Buku::find($request->id_buku);
        if ($buku->status !== 'tersedia') {
            return redirect()->back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        $tanggal = date('Ymd');
        $lastPeminjaman = Peminjaman::where('id_peminjaman', 'LIKE', "PJM-{$tanggal}-%")
                                    ->orderBy('id_peminjaman', 'desc')
                                    ->first();

        if ($lastPeminjaman) {
            $lastNumber = (int) substr($lastPeminjaman->id_peminjaman, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $idPeminjaman ="PJM-{$tanggal}-{$newNumber}";
        $idSiswa = session('id_siswa');

        $tanggalKembali = now()->addDays($request->durasi);

        Peminjaman::create([
            'id_peminjaman' => $idPeminjaman,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => $tanggalKembali,
            'status' => 'dipinjam',
            'id_siswa' => $idSiswa,
            'id_buku' => $request->id_buku,
        ]);

        $buku->update(['status' => 'dipinjam']);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dipinjam.',
            'data' => [
                'id_peminjaman' => $idPeminjaman,
                'judul_buku' => $buku->judul_buku,
            ]
        ]);
    }
}