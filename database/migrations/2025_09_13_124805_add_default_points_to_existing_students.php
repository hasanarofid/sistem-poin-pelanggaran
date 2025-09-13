<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDefaultPointsToExistingStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert default poin 100 untuk semua siswa yang sudah ada
        DB::statement("
            INSERT INTO point_t (siswa_id, total_poin, created_at, updated_at)
            SELECT id, 100, NOW(), NOW()
            FROM siswa
            WHERE id NOT IN (SELECT siswa_id FROM point_t)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus semua poin yang dibuat dari migration ini
        DB::table('point_t')->where('total_poin', 100)->delete();
    }
}
