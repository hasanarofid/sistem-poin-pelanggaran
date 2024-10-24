<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MasterTupoksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_tupoksi')->insert([
            [
                'id'=>1,
                'tahun_ajaran'=>'2024',
                'semester'=>'I',
                'kegiatan'=>'Menusun Program Pengawasan Tahunan',
                'id_kegiatan'=>null,
                'sub_kegiatan'=>null,
                'urutan'=>1,
            ],
            [
                'id'=>2,
                'tahun_ajaran'=>'2024',
                'semester'=>'I',
                'kegiatan'=>'Melaksanakan Pembinaan guru dan/atau Kepala Sekolah',
                'id_kegiatan'=>null,
                'sub_kegiatan'=>null,
                'urutan'=>2,
            ],
            [
                'id'=>3,
                'tahun_ajaran'=>'2024',
                'semester'=>'I',
                'kegiatan'=>'Melaksanakan Pemantauan pelaksanaan 8 SNP',
                'id_kegiatan'=>null,
                'sub_kegiatan'=>null,
                'urutan'=>3,
            ],
        ]);
    }
}
