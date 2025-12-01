<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;
use Carbon\Carbon;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswaIds = Siswa::pluck('id_siswa')->toArray();
        $bukuIds = Buku::pluck('id_buku')->toArray();

        if (empty($siswaIds) || empty($bukuIds)) {
            $this->command->warn('Jalankan SiswaSeeder dan BukuSeeder terlebih dahulu!');
            return;
        }

        $counter = 1;
        $tahunIni = Carbon::now()->year;

        // Generate peminjaman dari Januari sampai Desember tahun ini
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            // Jumlah peminjaman per bulan bervariasi (5-15 peminjaman)
            $jumlahPeminjamanPerBulan = rand(5, 15);

            for ($j = 0; $j < $jumlahPeminjamanPerBulan; $j++) {
                // Random tanggal dalam bulan tersebut
                $tanggalPinjam = Carbon::create($tahunIni, $bulan, rand(1, 28));
                
                // Jika bulan sudah lewat atau bulan ini, status bisa dikembalikan
                // Jika bulan depan, status masih dipinjam
                $bulanSekarang = Carbon::now()->month;
                if ($bulan < $bulanSekarang) {
                    $status = 'dikembalikan';
                } elseif ($bulan == $bulanSekarang) {
                    $status = rand(1, 10) > 3 ? 'dikembalikan' : 'dipinjam';
                } else {
                    $status = 'dipinjam';
                }

                $tanggalKembali = $status === 'dikembalikan' ? $tanggalPinjam->copy()->addDays(rand(1, 14)) : null;

                Peminjaman::create([
                    'id_peminjaman' => 'PJM-' . $tanggalPinjam->format('Ymd') . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
                    'tanggal_pinjam' => $tanggalPinjam,
                    'tanggal_kembali' => $tanggalKembali,
                    'status' => $status,
                    'id_siswa' => $siswaIds[array_rand($siswaIds)],
                    'id_buku' => $bukuIds[array_rand($bukuIds)],
                ]);

                $counter++;
            }
        }

        // Update status buku yang sedang dipinjam
        $dipinjam = Peminjaman::where('status', 'dipinjam')->get();
        foreach ($dipinjam as $pinjam) {
            Buku::where('id_buku', $pinjam->id_buku)->update(['status' => 'dipinjam']);
        }
    }
}
