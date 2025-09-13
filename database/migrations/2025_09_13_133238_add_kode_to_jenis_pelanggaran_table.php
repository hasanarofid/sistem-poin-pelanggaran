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
        // Check if column already exists
        if (!Schema::hasColumn('jenis_pelanggaran', 'kode')) {
            Schema::table('jenis_pelanggaran', function (Blueprint $table) {
                $table->string('kode')->nullable()->after('id');
            });
        }
        
        // Update existing records with default kode
        DB::table('jenis_pelanggaran')->update(['kode' => DB::raw('CONCAT("P", id)')]);
        
        // Add unique constraint after updating data (only if not already unique)
        if (Schema::hasColumn('jenis_pelanggaran', 'kode')) {
            try {
                Schema::table('jenis_pelanggaran', function (Blueprint $table) {
                    $table->string('kode')->unique()->change();
                });
            } catch (\Exception $e) {
                // Column might already be unique, ignore error
            }
        }
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
