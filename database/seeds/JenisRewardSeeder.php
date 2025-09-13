<?php

use Illuminate\Database\Seeder;
use App\Models\JenisReward;
use App\Models\Kategori;

class JenisRewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil kategori yang sudah ada atau buat default
        $kategoriPrestasi = Kategori::firstOrCreate(
            ['nama_kategori' => 'Prestasi Akademik'],
            [
                'nama_kategori' => 'Prestasi Akademik',
                'is_aktif' => true
            ]
        );

        $kategoriSikap = Kategori::firstOrCreate(
            ['nama_kategori' => 'Sikap Positif'],
            [
                'nama_kategori' => 'Sikap Positif',
                'is_aktif' => true
            ]
        );

        $kategoriKegiatan = Kategori::firstOrCreate(
            ['nama_kategori' => 'Kegiatan Sekolah'],
            [
                'nama_kategori' => 'Kegiatan Sekolah',
                'is_aktif' => true
            ]
        );

        // Data sample jenis reward
        $rewards = [
            [
                'nama_reward' => 'Nilai Tertinggi Ujian',
                'kategori_id' => $kategoriPrestasi->id,
                'poin' => 10,
                'deskripsi' => 'Mendapat nilai tertinggi dalam ujian',
                'is_aktif' => true
            ],
            [
                'nama_reward' => 'Juara Kelas',
                'kategori_id' => $kategoriPrestasi->id,
                'poin' => 15,
                'deskripsi' => 'Menjadi juara kelas',
                'is_aktif' => true
            ],
            [
                'nama_reward' => 'Membantu Teman',
                'kategori_id' => $kategoriSikap->id,
                'poin' => 5,
                'deskripsi' => 'Membantu teman yang kesulitan',
                'is_aktif' => true
            ],
            [
                'nama_reward' => 'Disiplin Waktu',
                'kategori_id' => $kategoriSikap->id,
                'poin' => 3,
                'deskripsi' => 'Selalu tepat waktu selama 1 bulan',
                'is_aktif' => true
            ],
            [
                'nama_reward' => 'Ketua Kelas',
                'kategori_id' => $kategoriKegiatan->id,
                'poin' => 8,
                'deskripsi' => 'Menjadi ketua kelas',
                'is_aktif' => true
            ],
            [
                'nama_reward' => 'Peserta Lomba',
                'kategori_id' => $kategoriKegiatan->id,
                'poin' => 5,
                'deskripsi' => 'Mengikuti lomba mewakili sekolah',
                'is_aktif' => true
            ],
            [
                'nama_reward' => 'Juara Lomba',
                'kategori_id' => $kategoriKegiatan->id,
                'poin' => 20,
                'deskripsi' => 'Menjadi juara dalam lomba',
                'is_aktif' => true
            ],
            [
                'nama_reward' => 'Kebersihan Kelas',
                'kategori_id' => $kategoriSikap->id,
                'poin' => 2,
                'deskripsi' => 'Menjaga kebersihan kelas',
                'is_aktif' => true
            ]
        ];

        foreach ($rewards as $reward) {
            JenisReward::firstOrCreate(
                ['nama_reward' => $reward['nama_reward']],
                $reward
            );
        }
    }
}
