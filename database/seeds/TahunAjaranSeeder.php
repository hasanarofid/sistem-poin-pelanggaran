<?php

use Illuminate\Database\Seeder;
use App\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahunAjaran = [
            [
                'tahun_ajaran' => '2024/2025',
                'tanggal_mulai' => '2024-07-01',
                'tanggal_selesai' => '2025-06-30',
                'status' => false
            ],
            [
                'tahun_ajaran' => '2025/2026',
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2026-06-30',
                'status' => true
            ]
        ];

        foreach ($tahunAjaran as $ta) {
            TahunAjaran::create($ta);
        }
    }
}
