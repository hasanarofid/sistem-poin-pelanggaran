<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddKodeToJenisPelanggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->string('kode')->nullable()->after('id');
        });
        
        // Update existing records with default kode
        DB::table('jenis_pelanggaran')->update(['kode' => DB::raw('CONCAT("P", id)')]);
        
        // Add unique constraint after updating data
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->string('kode')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_pelanggaran', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
    }
}
