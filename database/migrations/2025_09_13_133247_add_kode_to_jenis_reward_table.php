<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddKodeToJenisRewardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_reward', function (Blueprint $table) {
            $table->string('kode')->nullable()->after('id');
        });
        
        // Update existing records with default kode
        DB::table('jenis_reward')->update(['kode' => DB::raw('CONCAT("R", id)')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_reward', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
    }
}
