<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AspekProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aspek_program')->insert([
            ['nama' => 'Literasi Numerasi dan Karakter', 'status' => 1],
            ['nama' => 'PTK', 'status' => 1],
            ['nama' => 'Manajerial Kepala Sekolah', 'status' => 1],
            ['nama' => 'Partisipasi Warga Satuan Pendidikan', 'status' => 1],
            ['nama' => 'Tematik Dinas Pendidikan', 'status' => 1],
            ['nama' => 'RB Tematik Stunting', 'status' => 1],
        ]);
    }
}
