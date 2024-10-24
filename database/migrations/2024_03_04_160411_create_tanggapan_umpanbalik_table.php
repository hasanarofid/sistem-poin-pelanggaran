<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggapanUmpanbalikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggapan_umpanbalik_t', function (Blueprint $table) {
            $table->id();
            $table->integer('id_umpanbalik');
            $table->string('jawaban_1')->nullable();
            $table->string('jawaban_2')->nullable();
            $table->string('jawaban_3')->nullable();
            $table->string('jawaban_4')->nullable();
            $table->string('jawaban_5')->nullable();
            $table->string('jawaban_6')->nullable();
            $table->string('jawaban_7')->nullable();
            $table->string('jawaban_8')->nullable();
            $table->string('jawaban_9')->nullable();
            $table->string('jawaban_10')->nullable();
            $table->string('jawaban_11')->nullable();
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
        Schema::dropIfExists('tanggapan_umpanbalik_t');
    }
}
