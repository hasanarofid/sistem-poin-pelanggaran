<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GolPangkatRuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_gol_pangkat_ruang')->insert([
            [
                'id'=>1,
                'nama_golongan'=>'Golongan III',
                'pangkat'=>'Penata Muda',
                'ruang_kerja'=>'III A',
                'id_golongan'=>0
            ],
            [
                'id'=>2,
                'nama_golongan'=>'Golongan III',
                'pangkat'=>'Penata Muda Tingkat 1',
                'ruang_kerja'=>'III B',
                'id_golongan'=>0
            ],
            [
                'id'=>3,
                'nama_golongan'=>'Golongan III',
                'pangkat'=>'Penata',
                'ruang_kerja'=>'III C',
                'id_golongan'=>0
            ],
            [
                'id'=>4,
                'nama_golongan'=>'Golongan III',
                'pangkat'=>'Penata Tingkat 1',
                'ruang_kerja'=>'III D',
                'id_golongan'=>0
            ],

            [
                'id'=>5,
                'nama_golongan'=>'Golongan IV',
                'pangkat'=>'Pembina',
                'ruang_kerja'=>'IV A',
                'id_golongan'=>0
            ],
            [
                'id'=>6,
                'nama_golongan'=>'Golongan IV',
                'pangkat'=>'Pembina Tingkat 1',
                'ruang_kerja'=>'IV B',
                'id_golongan'=>0
            ],
            [
                'id'=>7,
                'nama_golongan'=>'Golongan IV',
                'pangkat'=>'Pembina Utama Muda',
                'ruang_kerja'=>'IV C',
                'id_golongan'=>0
            ],
            [
                'id'=>8,
                'nama_golongan'=>'Golongan IV',
                'pangkat'=>'Pembina Utama Madya',
                'ruang_kerja'=>'IV D',
                'id_golongan'=>0
            ],
            [
                'id'=>9,
                'nama_golongan'=>'Golongan IV',
                'pangkat'=>'Pembina Utama',
                'ruang_kerja'=>'IV E',
                'id_golongan'=>0
            ],

        ]);
    }
}
