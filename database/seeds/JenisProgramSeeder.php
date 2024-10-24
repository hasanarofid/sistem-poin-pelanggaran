<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_program')->insert([
            ['nama' => 'Pendampingan', 'status' => 1],
            ['nama' => 'Monev', 'status' => 1],
            ['nama' => 'Bimtek / Seminar / Sosialisasi', 'status' => 1], // Example of inactive program
        ]);
    }
}
