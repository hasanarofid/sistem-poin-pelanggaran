<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmpanbalikTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umpanbalik_t', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_pelaporan');
            $table->string('generate_url');
            $table->integer('id_pengawas');
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
        Schema::dropIfExists('umpanbalik_t');
    }
}
