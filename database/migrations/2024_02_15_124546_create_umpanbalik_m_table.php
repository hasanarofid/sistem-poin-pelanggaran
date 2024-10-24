<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmpanbalikMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umpanbalik_m', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan')->nullable();
            $table->text('jawaban')->nullable();
            $table->string('type_input')->nullable();
            $table->string('aspek')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->integer('urutan');
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
        Schema::dropIfExists('umpanbalik_m');
    }
}
