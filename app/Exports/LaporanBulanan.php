<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanBulanIniExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Peminjaman::with(['siswa', 'buku'])
            ->whereMonth('tanggal_pinjam', now()->month)
            ->get();
    }
    
    public function headings(): array
    {
        return ['ID', 'Siswa', 'Buku', 'Tanggal Pinjam', 'Status'];
    }
}