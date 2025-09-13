<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropJenisRewardAndInputRewardTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the tables (foreign keys will be dropped automatically)
        Schema::dropIfExists('input_reward_t');
        Schema::dropIfExists('jenis_reward');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recreate jenis_reward table
        Schema::create('jenis_reward', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('nama_reward');
            $table->unsignedBigInteger('kategori_id');
            $table->integer('poin');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
            
            $table->foreign('kategori_id')->references('id')->on('kategori_m')->onDelete('cascade');
        });
        
        // Recreate input_reward_t table
        Schema::create('input_reward_t', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('jenis_reward_id');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('pelapor_id');
            $table->timestamps();
            
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('jenis_reward_id')->references('id')->on('jenis_reward')->onDelete('cascade');
            $table->foreign('pelapor_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        // Recreate foreign key constraint
        Schema::table('historipoint_t', function (Blueprint $table) {
            $table->foreign('jenis_reward_id')->references('id')->on('jenis_reward')->onDelete('set null');
        });
    }
}