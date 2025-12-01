<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Buku;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
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
        $students = Siswa::with('user')->orderBy('nama_siswa', 'asc')->get();
        $totalSiswa = Siswa::count();
        $siswaAktif = Peminjaman::whereNull('tanggal_kembali')->distinct('id_siswa')->count('id_siswa');
        $totalKelas = Siswa::distinct('kelas')->count('kelas');
        
        return view('admin-page.content-siswa-admin', compact('students', 'totalSiswa', 'siswaAktif', 'totalKelas'));
    }
    
    public function storeSiswa(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|integer|unique:siswa,nis',
            'nama_siswa' => 'required|string|max:225',
            'kelas' => 'required|string|max:45',
            'alamat' => 'required|string|max:225',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);
        
        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'siswa'
        ]);
        
        Siswa::create([
            'nis' => $validated['nis'],
            'nama_siswa' => $validated['nama_siswa'],
            'kelas' => $validated['kelas'],
            'alamat' => $validated['alamat'],
            'id_user' => $user->id_user
        ]);
        
        return response()->json(['message' => 'Siswa berhasil ditambahkan!'], 201);
    }
    
    public function getSiswa($id)
    {
        $siswa = Siswa::with('user')->find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan.'], 404);
        }
        
        return response()->json($siswa, 200);
    }
    
    public function updateSiswa(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan.'], 404);
        }
        
        $validated = $request->validate([
            'nis' => 'required|integer|unique:siswa,nis,' . $id . ',id_siswa',
            'nama_siswa' => 'required|string|max:225',
            'kelas' => 'required|string|max:45',
            'alamat' => 'required|string|max:225',
            'password' => 'nullable|string|min:6',
        ]);
        
        $siswa->update([
            'nis' => $validated['nis'],
            'nama_siswa' => $validated['nama_siswa'],
            'kelas' => $validated['kelas'],
            'alamat' => $validated['alamat'],
        ]);
        
        if (!empty($validated['password'])) {
            $siswa->user->update([
                'password' => Hash::make($validated['password'])
            ]);
        }
        
        return response()->json(['message' => 'Siswa berhasil diupdate!'], 200);
    }
    
    public function deleteSiswa($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan.'], 404);
        }
        
        $siswa->user->delete();
        
        return response()->json(['message' => 'Siswa berhasil dihapus!'], 200);
    }

    public function transaksi()
    {
        $peminjaman = Peminjaman::with(['siswa', 'buku'])
                                ->where('status', 'dipinjam')
                                ->orderBy('tanggal_pinjam', 'desc')
                                ->get();
        
        $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $pengembalianHariIni = Pengembalian::whereDate('tanggal_pengembalian', Carbon::today())->count();
        
        $totalTerlambat = Peminjaman::where('status', 'dipinjam')
                                    ->where('tanggal_kembali', '<', Carbon::now())
                                    ->count();
        
        return view('admin-page.content-transaksi-admin', compact('peminjaman', 'totalDipinjam', 'pengembalianHariIni', 'totalTerlambat'));
    }
    
    public function prosesPengembalian(Request $request)
    {
        $validated = $request->validate([
            'id_peminjaman' => 'required|string|exists:peminjaman,id_peminjaman',
            'tanggal_pengembalian' => 'required|date',
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);
        
        $peminjaman = Peminjaman::find($validated['id_peminjaman']);
        
        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman tidak ditemukan'], 404);
        }
        
        if ($peminjaman->status === 'dikembalikan') {
            return response()->json(['message' => 'Buku sudah dikembalikan'], 400);
        }
        
        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);
        
        $idPengembalian = 'PGB-' . time() . '-' . rand(1000, 9999);
        Pengembalian::create([
            'id_pengembalian' => $idPengembalian,
            'id_peminjaman' => $validated['id_peminjaman'],
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'denda' => $validated['denda'] ?? '0',
        ]);
        
        $peminjaman->buku->update([
            'status' => 'tersedia'
        ]);
        
        return response()->json(['message' => 'Pengembalian berhasil diproses!'], 200);
    }

    public function prosesBukuHilang(Request $request)
    {
        $validated = $request->validate([
            'id_peminjaman' => 'required|string|exists:peminjaman,id_peminjaman',
            'tanggal_pengembalian' => 'required|date',
            'catatan' => 'nullable|string',
        ]);
        
        $peminjaman = Peminjaman::find($validated['id_peminjaman']);
        
        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman tidak ditemukan'], 404);
        }
        
        if ($peminjaman->status === 'dikembalikan') {
            return response()->json(['message' => 'Buku sudah dikembalikan'], 400);
        }
        
        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);
        
        $idPengembalian = 'PGB-' . time() . '-' . rand(1000, 9999);
        Pengembalian::create([
            'id_pengembalian' => $idPengembalian,
            'id_peminjaman' => $validated['id_peminjaman'],
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'denda' => 0,
        ]);
        

        $buku = $peminjaman->buku;
        $buku->increment('hilang', 1); 
        $buku->decrement('stok', 1);   
        
        // Update status buku
        if ($buku->stok > $buku->hilang) {
            $buku->update(['status' => 'tersedia']);
        } else {
            $buku->update(['status' => 'dipinjam']); 
        }
        
        return response()->json(['message' => 'Buku hilang berhasil diproses! Stok berkurang dan kolom hilang bertambah.'], 200);
    }

    public function aktivitas()
    {
        $pengembalian = Pengembalian::with(['peminjaman.siswa', 'peminjaman.buku'])
                                    ->orderBy('tanggal_pengembalian', 'desc')
                                    ->get();
        
        $totalPengembalian = Pengembalian::count();
        $pengembalianHariIni = Pengembalian::whereDate('tanggal_pengembalian', Carbon::today())->count();
        $totalDenda = Pengembalian::sum('denda');
        
        return view('admin-page.content-aktivitas-admin', compact('pengembalian', 'totalPengembalian', 'pengembalianHariIni', 'totalDenda'));
    }
}
