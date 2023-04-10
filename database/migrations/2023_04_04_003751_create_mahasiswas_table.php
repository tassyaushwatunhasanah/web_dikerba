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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('univ_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->string('nim');
            $table->string('nama_mahasiswa');
            $table->string('jk');
            $table->string('tk_pendidikan');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('prodi');
            $table->string('semester');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('keterangan');
            $table->string('Kelulusan');
            $table->timestamps();

            $table->foreign('univ_id')->references('iduniv')->on('univs');
            $table->foreign('ruangan_id')->references('idruangan')->on('ruangans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};
