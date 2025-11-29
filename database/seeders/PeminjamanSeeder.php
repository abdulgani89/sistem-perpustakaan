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

        // Generate 30 peminjaman dummy
        for ($i = 1; $i <= 30; $i++) {
            $tanggalPinjam = Carbon::now()->subDays(rand(1, 60));
            $status = rand(1, 10) > 3 ? 'dikembalikan' : 'dipinjam'; // 70% dikembalikan, 30% dipinjam
            $tanggalKembali = $status === 'dikembalikan' ? $tanggalPinjam->copy()->addDays(rand(1, 14)) : null;

            Peminjaman::create([
                'id_peminjaman' => 'PJM-' . date('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'status' => $status,
                'id_siswa' => $siswaIds[array_rand($siswaIds)],
                'id_buku' => $bukuIds[array_rand($bukuIds)],
            ]);
        }

        // Update status buku yang sedang dipinjam
        $dipinjam = Peminjaman::where('status', 'dipinjam')->get();
        foreach ($dipinjam as $pinjam) {
            Buku::where('id_buku', $pinjam->id_buku)->update(['status' => 'dipinjam']);
        }
    }
}
