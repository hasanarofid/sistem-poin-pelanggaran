<?php

namespace App\Imports;

use App\Siswa;
use App\Kelas;
use App\Point;
use App\TahunAjaran;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class GuruSiswaImport implements ToCollection, WithHeadingRow
{
    public $errors = [];
    public $successCount = 0;
    public $errorCount = 0;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $this->errors = [];
        $this->successCount = 0;
        $this->errorCount = 0;
        
        $hasError = false; // Flag untuk mengecek apakah ada error

        foreach ($collection as $index => $row) {
            // Validasi data
            $validator = Validator::make($row->toArray(), [
                'nis' => 'required|max:255',
                'nama' => 'required|string|max:255',
                'kelas' => 'required|string|max:255',
                'subkelas' => 'required|string|max:255',
                'hp_orang_tua' => 'nullable|max:20',
                'jenis_kelamin' => 'required|in:L,P',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
                'tahun_ajaran' => 'required|string|max:255',
                'rfid' => 'nullable|max:255',
                'finger' => 'nullable|string|max:255',
            ], [
                'nis.required' => 'NIS wajib diisi.',
                'nis.max' => 'NIS tidak boleh lebih dari 255 karakter.',
                'nama.required' => 'Nama wajib diisi.',
                'nama.string' => 'Nama harus berupa string.',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
                'kelas.required' => 'Kelas wajib diisi.',
                'kelas.string' => 'Kelas harus berupa string.',
                'kelas.max' => 'Kelas tidak boleh lebih dari 255 karakter.',
                'subkelas.required' => 'Subkelas wajib diisi.',
                'subkelas.string' => 'Subkelas harus berupa string.',
                'subkelas.max' => 'Subkelas tidak boleh lebih dari 255 karakter.',
                'hp_orang_tua.max' => 'HP Orang Tua tidak boleh lebih dari 20 karakter.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                'tempat_lahir.string' => 'Tempat lahir harus berupa string.',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 255 karakter.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
                'alamat.required' => 'Alamat wajib diisi.',
                'alamat.string' => 'Alamat harus berupa string.',
                'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
                'tahun_ajaran.string' => 'Tahun ajaran harus berupa string.',
                'tahun_ajaran.max' => 'Tahun ajaran tidak boleh lebih dari 255 karakter.',
                'rfid.max' => 'RFID tidak boleh lebih dari 255 karakter.',
                'finger.string' => 'Finger harus berupa string.',
                'finger.max' => 'Finger tidak boleh lebih dari 255 karakter.',
            ]);

            if ($validator->fails()) {
                $this->errorCount++;
                $this->errors[] = "Baris " . ($index + 2) . ": " . implode(', ', $validator->errors()->all());
                $hasError = true; // Set flag jika ada error
            }
        }

        // Jika tidak ada error, simpan data
        if (!$hasError) {
            foreach ($collection as $index => $row) {
                // Cari atau buat kelas
                $kelas = Kelas::firstOrCreate(
                    [
                        'nama_kelas' => $row['kelas'],
                        'subkelas' => $row['subkelas']
                    ],
                    [
                        'nama_kelas' => $row['kelas'],
                        'subkelas' => $row['subkelas'],
                        'status' => true
                    ]
                );

                // Cari atau buat tahun ajaran
                $tahunAjaran = TahunAjaran::firstOrCreate(
                    ['tahun_ajaran' => $row['tahun_ajaran']],
                    [
                        'tahun_ajaran' => $row['tahun_ajaran'],
                        'tanggal_mulai' => now()->startOfYear(),
                        'tanggal_selesai' => now()->endOfYear(),
                        'status' => false
                    ]
                );

                try {
                    // Cari atau buat user
                    $user = User::updateOrCreate(
                        ['username' => $row['nis']],
                        [
                            'name' => $row['nama'],
                            'username' => $row['nis'],
                            'password' => Hash::make('siswa123'),
                            'role' => 'siswa',
                            'alamat_lengkap' => $row['alamat'],
                        ]
                    );
                    
                    // Cari atau buat siswa
                    $siswa = Siswa::updateOrCreate(
                        ['nis' => $row['nis']],
                        [
                            'nis' => $row['nis'],
                            'nama' => $row['nama'],
                            'kelas_id' => $kelas->id,
                            'user_id' => $user->id,
                            'hp_orang_tua' => $row['hp_orang_tua'],
                            'jenis_kelamin' => $row['jenis_kelamin'],
                            'tempat_lahir' => $row['tempat_lahir'],
                            'tanggal_lahir' => $row['tanggal_lahir'],
                            'alamat' => $row['alamat'],
                            'tahun_ajaran_id' => $tahunAjaran->id,
                            'rfid' => $row['rfid'],
                            'finger' => $row['finger'],
                            'status' => true
                        ]
                    );

                    // Buat default poin 100 untuk siswa baru (jika belum ada)
                    Point::firstOrCreate(
                        ['siswa_id' => $siswa->id],
                        [
                            'siswa_id' => $siswa->id,
                            'total_poin' => 100
                        ]
                    );

                    $this->successCount++;
                } catch (\Exception $e) {
                    $this->errorCount++;
                    $this->errors[] = "Baris " . ($index + 2) . ": Error database - " . $e->getMessage();
                }
            }
        }
    }
}
