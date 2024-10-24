<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TugaskerjaTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tugaskerja_t')->insert([
            [
                'id'=>1,
                'id_pengawas'=>3,
                'id_tugas'=>1
            ],
            [
                'id'=>2,
                'id_pengawas'=>3,
                'id_tugas'=>2
            ],
            [
                'id'=>3,
                'id_pengawas'=>3,
                'id_tugas'=>3
            ],
        ]);
    }
}
