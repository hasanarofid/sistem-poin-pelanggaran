<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class KategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategory')->insert([
            [
                'id'=>1,
                'nama'=>'Program Reguler',
                'type'=>'perencanaan',
            ],
            [
                'id'=>2,
                'nama'=>'Program Tematik',
                'type'=>'perencanaan',
            ],
            [
                'id'=>3,
                'nama'=>'Program Dengan Kondisi Khusus',
                'type'=>'perencanaan',
            ],
            [
                'id'=>4,
                'nama'=>'Laporan Reguler',
                'type'=>'pelaporan',
            ],
            [
                'id'=>5,
                'nama'=>'Laporan Tematik',
                'type'=>'pelaporan',
            ],
            [
                'id'=>6,
                'nama'=>'Laporan Dengan Kondisi Khusus',
                'type'=>'pelaporan',
            ],
        ]);
    }
}
