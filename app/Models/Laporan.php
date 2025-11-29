<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'laporan';

    // Primary key custom
    protected $primaryKey = 'id_laporan';

    // Primary key bukan auto increment (karena VARCHAR)
    public $incrementing = false;

    // Gunakan string karena PK berupa VARCHAR
    protected $keyType = 'string';

    // Field yang boleh diisi mass-assignment
    protected $fillable = [
        'id_laporan',
        'tanggal_laporan',
        'jumlah_peminjaman',
        'jumlah_pengembalian',
        'buku_hilang',
        'keterlambatan',
        'id_admin',
    ];

    // Relasi ke tabel users
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}
