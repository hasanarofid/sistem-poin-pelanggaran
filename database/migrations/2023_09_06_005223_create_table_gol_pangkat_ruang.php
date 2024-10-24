<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGolPangkatRuang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_gol_pangkat_ruang', function (Blueprint $table) {
            $table->id();
             $table->string('nama_golongan')->nullable();
             $table->string('pangkat')->nullable();
             $table->string('ruang_kerja')->nullable();
            $table->integer('id_golongan')->nullable();
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
        Schema::dropIfExists('table_gol_pangkat_ruang');
    }
}
