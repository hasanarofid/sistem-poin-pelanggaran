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
            // Kelas X
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X BD 1',
                'deskripsi' => 'Kelas X Bisnis Daring dan Pemasaran 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X BD 2',
                'deskripsi' => 'Kelas X Bisnis Daring dan Pemasaran 2',
                'status' => true
            ],
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
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X TSM 1',
                'deskripsi' => 'Kelas X Teknik Sepeda Motor 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X TSM 2',
                'deskripsi' => 'Kelas X Teknik Sepeda Motor 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X RPL 1',
                'deskripsi' => 'Kelas X Rekayasa Perangkat Lunak 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X RPL 2',
                'deskripsi' => 'Kelas X Rekayasa Perangkat Lunak 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X TITL 1',
                'deskripsi' => 'Kelas X Teknik Instalasi Tenaga Listrik 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas X',
                'subkelas' => 'X TITL 2',
                'deskripsi' => 'Kelas X Teknik Instalasi Tenaga Listrik 2',
                'status' => true
            ],
            
            // Kelas XI
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 BD 1',
                'deskripsi' => 'Kelas XI Bisnis Daring dan Pemasaran 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 BD 2',
                'deskripsi' => 'Kelas XI Bisnis Daring dan Pemasaran 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 BD 3',
                'deskripsi' => 'Kelas XI Bisnis Daring dan Pemasaran 3',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 DPIB 1',
                'deskripsi' => 'Kelas XI Desain Pemodelan dan Informasi Bangunan 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 DPIB 2',
                'deskripsi' => 'Kelas XI Desain Pemodelan dan Informasi Bangunan 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 TSM 1',
                'deskripsi' => 'Kelas XI Teknik Sepeda Motor 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 TSM 2',
                'deskripsi' => 'Kelas XI Teknik Sepeda Motor 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 RPL 1',
                'deskripsi' => 'Kelas XI Rekayasa Perangkat Lunak 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 RPL 2',
                'deskripsi' => 'Kelas XI Rekayasa Perangkat Lunak 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 RPL 3',
                'deskripsi' => 'Kelas XI Rekayasa Perangkat Lunak 3',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 TITL 1',
                'deskripsi' => 'Kelas XI Teknik Instalasi Tenaga Listrik 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas 11',
                'subkelas' => '11 TITL 2',
                'deskripsi' => 'Kelas XI Teknik Instalasi Tenaga Listrik 2',
                'status' => true
            ],
            
            // Kelas XII
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII BD 1',
                'deskripsi' => 'Kelas XII Bisnis Daring dan Pemasaran 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII BD 2',
                'deskripsi' => 'Kelas XII Bisnis Daring dan Pemasaran 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII BD 3',
                'deskripsi' => 'Kelas XII Bisnis Daring dan Pemasaran 3',
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
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII TSM 1',
                'deskripsi' => 'Kelas XII Teknik Sepeda Motor 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII TSM 2',
                'deskripsi' => 'Kelas XII Teknik Sepeda Motor 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII RPL 1',
                'deskripsi' => 'Kelas XII Rekayasa Perangkat Lunak 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII RPL 2',
                'deskripsi' => 'Kelas XII Rekayasa Perangkat Lunak 2',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII RPL 3',
                'deskripsi' => 'Kelas XII Rekayasa Perangkat Lunak 3',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII TITL 1',
                'deskripsi' => 'Kelas XII Teknik Instalasi Tenaga Listrik 1',
                'status' => true
            ],
            [
                'nama_kelas' => 'Kelas XII',
                'subkelas' => 'XII TITL 2',
                'deskripsi' => 'Kelas XII Teknik Instalasi Tenaga Listrik 2',
                'status' => true
            ]
        ];

        foreach ($kelas as $k) {
            Kelas::updateOrCreate(
                ['subkelas' => $k['subkelas']],
                $k
            );
        }
        
        $this->command->info('Seeder Kelas selesai dijalankan!');
    }
}
