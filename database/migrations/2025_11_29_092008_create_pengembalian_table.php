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
        Schema::create('pengembalian', function (Blueprint $table) {
            // Primary Key
            $table->string('id_pengembalian', 225)->primary();

            // Fields
            $table->dateTime('tanggal_pengembalian');
            $table->string('denda', 225)->nullable();

            // Foreign Key → id_peminjaman VARCHAR(225)
            $table->string('id_peminjaman', 225);

            $table->timestamps();

            // Buat relasi FK
            $table->foreign('id_peminjaman')
                ->references('id_peminjaman')
                ->on('peminjaman')
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
        Schema::dropIfExists('pengembalian');
    }
};
