<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru_m')->insert([
            [
                'id'=>1,
                'nama'=>'Siti Badriah S.P.D',
                'sekolah_id'=>1,
                'no_telp'=>'0812133313131',
                'kota'=>'Yogjakarta',
                'alamat_lengkap'=>'Desa Magelang RT 10 210',
                'kode_area'=>42132,
                                'jabatan'=>'Guru',
                                  'kabupaten_id'=>1

            ],
            [
                'id'=>2,
                'nama'=>'Prof Abdullah S.P.D',
                'sekolah_id'=>1,
                'no_telp'=>'087262626262',
                'kota'=>'Yogjakarta',
                'alamat_lengkap'=>'Desa Kulon RT 20 RW 10',
                'kode_area'=>35433,
                                'jabatan'=>'Kepala Sekolah',
                                  'kabupaten_id'=>1
            ],
          
        ]);
    }
}
