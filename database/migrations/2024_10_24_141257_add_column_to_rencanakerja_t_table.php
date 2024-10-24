<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToRencanakerjaTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencakakerja_t', function (Blueprint $table) {
            $table->string('bulan')->nullable();
            $table->integer('jenisprogram_id')->nullable();
            $table->integer('aspekprogram_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencakakerja_t', function (Blueprint $table) {
            $table->dropColumn('bulan'); // Drop the column if the migration is rolled back
            $table->dropColumn('jenisprogram_id'); // Drop the column if the migration is rolled back
            $table->dropColumn('aspekprogram_id'); // Drop the column if the migration is rolled back
        });
    }
}
