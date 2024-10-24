<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SekolahMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sekolah_m')->insert([
            [
                'id'=>1,
                'npsn'=>59955821,
                 'nama_sekolah'=>'SMAN 1 Leuwidamar Lebak',
                'no_telp'=>'031244233',
                'kota'=>'Banten',
                'alamat_lengkap'=>'Lebak',
                'kode_area'=>42132,
                  'kabupaten_id'=>1
            ],
            [
                'id'=>2,
                'npsn'=>59955822,
                 'nama_sekolah'=>'SMAN 2 Leuwidamar Lebak',
                'no_telp'=>'031244233',
                'kota'=>'Banten',
                'alamat_lengkap'=>'Lebak',
                'kode_area'=>42132,
                  'kabupaten_id'=>1
            ],
            [
                'id'=>3,
                'npsn'=>59955823,
                 'nama_sekolah'=>'SMAN 1 Rangkasbitung Lebak',
                'no_telp'=>'031244233',
                'kota'=>'Banten',
                'alamat_lengkap'=>'Lebak',
                'kode_area'=>42132,
                  'kabupaten_id'=>1
            ],
        ]);
    }
}
