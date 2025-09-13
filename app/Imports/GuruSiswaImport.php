<?php

namespace App\Imports;

use App\Siswa;
use App\User;
use App\Kelas;
use App\TahunAjaran;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuruSiswaImport implements ToCollection, WithHeadingRow, WithValidation
{
    protected $kelasId;
    public $successCount = 0;
    public $errorCount = 0;
    public $errors = [];

    public function __construct($kelasId)
    {
        $this->kelasId = $kelasId;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            try {
                // Validasi data
                if (empty($row['nama']) || empty($row['nis'])) {
                    $this->errorCount++;
                    $this->errors[] = "Baris " . ($collection->search($row) + 2) . ": Nama dan NIS harus diisi";
                    continue;
                }

                // Cek apakah NIS sudah ada
                if (Siswa::where('nis', $row['nis'])->exists()) {
                    $this->errorCount++;
                    $this->errors[] = "Baris " . ($collection->search($row) + 2) . ": NIS {$row['nis']} sudah ada";
                    continue;
                }

                // Cek apakah user dengan username NIS sudah ada
                if (User::where('username', $row['nis'])->exists()) {
                    $this->errorCount++;
                    $this->errors[] = "Baris " . ($collection->search($row) + 2) . ": Username {$row['nis']} sudah ada";
                    continue;
                }

                // Buat user untuk siswa
                $user = User::create([
                    'name' => $row['nama'],
                    'username' => $row['nis'],
                    'password' => Hash::make('siswa123'),
                    'role' => 'Siswa',
                    'alamat_lengkap' => $row['alamat'] ?? '',
                ]);

                // Buat data siswa
                Siswa::create([
                    'user_id' => $user->id,
                    'nama' => $row['nama'],
                    'nis' => $row['nis'],
                    'kelas_id' => $this->kelasId, // Selalu gunakan kelas guru
                    'tahun_ajaran_id' => $row['tahun_ajaran_id'] ?? 1,
                    'alamat' => $row['alamat'] ?? '',
                    'no_telp' => $row['no_telp'] ?? '',
                    'jenis_kelamin' => $row['jenis_kelamin'] ?? 'L',
                ]);

                $this->successCount++;

            } catch (\Exception $e) {
                $this->errorCount++;
                $this->errors[] = "Baris " . ($collection->search($row) + 2) . ": " . $e->getMessage();
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.nama' => 'required|string|max:255',
            '*.nis' => 'required|string|max:255',
            '*.alamat' => 'nullable|string',
            '*.no_telp' => 'nullable|string',
            '*.jenis_kelamin' => 'nullable|in:L,P',
        ];
    }
}
