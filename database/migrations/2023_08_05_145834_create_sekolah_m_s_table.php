<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah_m', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah')->nullable();
            $table->string('npsn')->unique();
            $table->string('no_telp')->nullable();
            $table->string('kota')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->integer('kode_area')->nullable();
            $table->boolean('is_aktif')->nullable()->default(true);
            $table->unsignedBigInteger('kabupaten_id');
            $table->index('kabupaten_id');
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
        Schema::dropIfExists('sekolah_m');
    }
}
