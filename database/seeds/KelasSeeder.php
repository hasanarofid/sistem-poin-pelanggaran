<?php

use Illuminate\Database\Seeder;
use App\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = [
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X DPIB 1',
                'deskripsi' => 'Kelas X Desain Pemodelan dan Informasi Bangunan 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X DPIB 2',
                'deskripsi' => 'Kelas X Desain Pemodelan dan Informasi Bangunan 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XI',
                'subkelas' => 'XI DPIB 1',
                'deskripsi' => 'Kelas XI Desain Pemodelan dan Informasi Bangunan 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XI',
                'subkelas' => 'XI DPIB 2',
                'deskripsi' => 'Kelas XI Desain Pemodelan dan Informasi Bangunan 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII DPIB 1',
                'deskripsi' => 'Kelas XII Desain Pemodelan dan Informasi Bangunan 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII DPIB 2',
                'deskripsi' => 'Kelas XII Desain Pemodelan dan Informasi Bangunan 2',
                'status' => true
            ]
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}
