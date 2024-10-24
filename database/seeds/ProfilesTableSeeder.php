<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'id'=>1,
                'user_id'=>1,
                'no_telp'=>'0812133313131',
                'kota'=>'Yogjakarta',
                'alamat_lengkap'=>'Desa Magelang RT 10 210',
                'kode_area'=>42132
            ],
            [
                'id'=>2,
                'user_id'=>2,
                'no_telp'=>'087262626262',
                'kota'=>'Yogjakarta',
                'alamat_lengkap'=>'Desa Kulon RT 20 RW 10',
                'kode_area'=>35433
            ],
            [
                'id'=>3,
                'user_id'=>3,
                'no_telp'=>'085234423',
                'kota'=>'Yogjakarta',
                'alamat_lengkap'=>'Desa Wetan RT 20 RW 10',
                'kode_area'=>35433
            ],
            [
                'id'=>4,
                'user_id'=>4,
                'no_telp'=>'085234423',
                'kota'=>'Yogjakarta',
                'alamat_lengkap'=>'Desa Wetan RT 20 RW 10',
                'kode_area'=>35433
            ],

            [
                'id'=>5,
                'user_id'=>5,
                'no_telp'=>'085234423',
                'kota'=>'Banten',
                'alamat_lengkap'=>'Desa Banten',
                'kode_area'=>35433
            ],
       
        ]);
    }
}