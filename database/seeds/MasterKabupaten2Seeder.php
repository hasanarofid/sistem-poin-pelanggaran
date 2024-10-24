<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MasterKabupaten2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_kabupaten')->insert([
            [
                'id'=>1,
                'nama_kabupaten'=>'Kota Serang',
                'kelompok_kabupaten'=>'Wilayah Seragon'
            ],
            [
                'id'=>2,
                'nama_kabupaten'=>'Kota Cilegon',
                'kelompok_kabupaten'=>'Wilayah Seragon'
            ],
            [
                'id'=>3,
                'nama_kabupaten'=>'Kab Serang',
                'kelompok_kabupaten'=>'Wilayah Seragon'
            ],
            [
                'id'=>4,
                'nama_kabupaten'=>'Kab Pandeglang',
                'kelompok_kabupaten'=>'Wilayah Pandeglang'
            ],
            [
                'id'=>5,
                'nama_kabupaten'=>'Kab Lebak',
                'kelompok_kabupaten'=>'Wilayah Lebak'
            ],
            [
                'id'=>6,
                'nama_kabupaten'=>'Kab Tangerang',
                'kelompok_kabupaten'=>'Wilayah Kab Tangerang'
            ],
            [
                'id'=>7,
                'nama_kabupaten'=>'Kota Tangerang',
                'kelompok_kabupaten'=>'Wilayah Tangerang'
            ],
            [
                'id'=>8,
                'nama_kabupaten'=>'Kota Tangerang Selatan',
                'kelompok_kabupaten'=>'Wilayah Tangerang'
            ],
        ]);
    }
}
