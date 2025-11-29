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
        Schema::create('buku', function (Blueprint $table) {
            $table->unsignedInteger('id_buku'); // primary key INT AUTO_INCREMENT
            $table->string('kode_buku', 225);
            $table->string('judul_buku', 225);
            $table->string('pengarang', 225);
            $table->string('penerbit', 45);
            $table->dateTime('tahun_terbit'); // DATETIME
            $table->string('kategori', 225);
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
};
