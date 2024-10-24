<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencakakerjaTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencakakerja_t', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengawas');
            $table->string('tahun_ajaran');
            $table->string('nama_program_kerja')->nullable();
            $table->integer('kategoriprogram_id');
            $table->string('sekolah_id')->nullable();
            
            // $table->string('sub_kategori')->nullable();
            // $table->string('sasaran')->nullable();
            // $table->string('object_sasaran')->nullable();
            // $table->date('tgl_pendampingan')->nullable();
            // $table->string('judul')->nullable();

            $table->text('deskripsi_permasalahan')->nullable();
            $table->text('target_capaian')->nullable();
            
            // $table->text('catatan_evaluasi')->nullable();
            // $table->text('saran_rekomendasi')->nullable();
            // $table->string('lampiran')->nullable();

            $table->string('tenggat_waktu')->nullable();
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
        Schema::dropIfExists('rencakakerja_t');
    }
}
