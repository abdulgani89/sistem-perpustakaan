<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            // Primary key (string)
            $table->string('id_peminjaman', 225)->primary();

            // Fields
            $table->dateTime('tanggal_pinjam');
            $table->dateTime('tanggal_kembali')->nullable();
            $table->string('status', 225);

            // Foreign keys
            $table->unsignedInteger('id_siswa'); // karena siswa.id_siswa = increments()
            $table->unsignedInteger('id_buku');  // karena buku.id_buku = increments()

            $table->timestamps();

            // Relasi ke tabel siswa
            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswa')
                  ->onDelete('cascade');

            // Relasi ke tabel buku
            $table->foreign('id_buku')
                  ->references('id_buku')
                  ->on('buku')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};
