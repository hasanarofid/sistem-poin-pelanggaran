<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_m', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sekolah_id');
            $table->string('nama')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('kota')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->integer('kode_area')->nullable();
            $table->string('jabatan')->default('Guru');
            $table->boolean('is_aktif')->nullable()->default(true);
            $table->unsignedBigInteger('kabupaten_id');
            $table->index('kabupaten_id');
            $table->timestamps();
            $table->index('sekolah_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru_m');
    }
}
