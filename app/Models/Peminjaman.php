<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    public $incrementing = false;     // karena PK bukan auto increment
    protected $keyType = 'string';    // karena PK berbentuk VARCHAR

    protected $fillable = [
        'id_peminjaman',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'id_siswa',
        'id_buku',
    ];

    // Relasi: Peminjaman milik siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    // Relasi: Peminjaman milik buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }
}
