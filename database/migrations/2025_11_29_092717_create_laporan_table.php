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
        Schema::create('laporan', function (Blueprint $table) {
            $table->string('id_laporan', 225)->primary();
            $table->dateTime('tanggal_laporan');
            $table->integer('jumlah_peminjaman');
            $table->integer('jumlah_pengembalian');
            $table->integer('buku_hilang');
            $table->integer('keterlambatan');

            // foreign key ke users.id_user (admin)
            $table->unsignedBigInteger('id_admin');

            $table->timestamps();

            $table->foreign('id_admin')
                    ->references('id_user')
                    ->on('users')
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
        Schema::dropIfExists('laporan');
    }
};
