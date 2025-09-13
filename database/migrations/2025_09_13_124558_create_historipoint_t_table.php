<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoripointTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historipoint_t', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('point_id');
            $table->enum('jenis_transaksi', ['pelanggaran', 'reward']);
            $table->unsignedBigInteger('jenis_pelanggaran_id')->nullable();
            $table->unsignedBigInteger('jenis_reward_id')->nullable();
            $table->integer('poin_sebelum');
            $table->integer('poin_perubahan');
            $table->integer('poin_sesudah');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('input_by'); // user yang input
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('point_id')->references('id')->on('point_t')->onDelete('cascade');
            $table->foreign('jenis_pelanggaran_id')->references('id')->on('jenis_pelanggaran')->onDelete('set null');
            $table->foreign('jenis_reward_id')->references('id')->on('jenis_reward')->onDelete('set null');
            $table->foreign('input_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historipoint_t');
    }
}
