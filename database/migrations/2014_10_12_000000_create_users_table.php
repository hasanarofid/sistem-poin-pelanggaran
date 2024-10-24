<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('Admin');
            $table->string('nip',18)->nullable();
            $table->string('foto_profile')->nullable();
            $table->string('jenjang_jabatan')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('gol_ruang')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('kota')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->integer('kode_area')->nullable();
            $table->unsignedBigInteger('kabupaten_id');
            $table->index('kabupaten_id');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}