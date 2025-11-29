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
        Schema::create('siswa', function (Blueprint $table) {
            $table->unsignedInteger('id_siswa');
            $table->integer('nis');
            $table->string('nama_siswa', 225);
            $table->string('kelas', 45);
            $table->string('alamat', 225);

            // foreign key wajib BIGINT karena users.id_user = bigIncrements
            $table->unsignedBigInteger('id_user');

            $table->timestamps();

            // relasi foreign key
            $table->foreign('id_user')
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
        Schema::dropIfExists('siswa');
    }
};
