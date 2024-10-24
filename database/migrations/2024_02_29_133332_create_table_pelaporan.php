<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePelaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengawas');
            $table->string('kategori');
            $table->string('sub_kategori')->nullable();
            $table->text('judul');
            $table->string('sasaran');
            $table->string('object')->nullable();;
            $table->date('tgl_pendampingan');
            $table->text('deskripsi_permasalahan')->nullable();
            $table->text('uraian')->nullable();
            $table->text('catatan_evaluasi')->nullable();
            $table->text('saran_rekomendasi')->nullable();
            $table->text('akses')->nullable();
            $table->date('disposisi')->nullable();
            $table->string('lampiran')->nullable();
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
        Schema::dropIfExists('pelaporan');
    }
}
