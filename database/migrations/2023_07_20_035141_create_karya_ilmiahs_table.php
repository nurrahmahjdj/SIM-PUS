<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryaIlmiahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karya_ilmiahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('rumpun_id')->nullable();
            $table->foreignId('prodi_id')->nullable();
            $table->string('tipe');
            $table->string('judul')->nullable();
            $table->string('slug')->unique();
            $table->string('kata_kunci')->nullable();
            $table->string('penulis')->nullable();
            $table->string('no_hki')->nullable();
            $table->date('tanggal_permohonan')->nullable();
            $table->string('nama_pemegang')->nullable();
            $table->string('jenis_ciptaan')->nullable();
            $table->string('nama_jurnal')->nullable();
            $table->string('tautan_laman')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->string('volume')->nullable();
            $table->string('nomor')->nullable();
            $table->string('halaman')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('doi')->nullable();
            $table->string('issn')->nullable();
            $table->string('referensi')->nullable();
            $table->text('abstrak')->nullable();
            $table->string('cover')->nullable();
            $table->string('file_abstrak')->nullable();
            $table->string('daftar_isi')->nullable();
            $table->string('bab_i')->nullable();
            $table->string('bab_ii')->nullable();
            $table->string('bab_iii')->nullable();
            $table->string('bab_iv')->nullable();
            $table->string('bab_v')->nullable();
            $table->string('daftar_pustaka')->nullable();
            $table->string('file_jurnal')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('status')->default('Belum Terverifikasi');
            $table->string('catatan')->nullable();
            $table->string('feedback')->nullable();
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
        Schema::dropIfExists('karya_ilmiahs');
    }
}
