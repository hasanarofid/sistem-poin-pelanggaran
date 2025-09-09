<?php

namespace App\Imports;

use App\Siswa;
use App\Kelas;
use App\TahunAjaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class SiswaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Validasi data
            $validator = Validator::make($row->toArray(), [
                'nis' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'kelas' => 'required|string|max:255',
                'subkelas' => 'required|string|max:255',
                'hp_orang_tua' => 'nullable|string|max:20',
                'jenis_kelamin' => 'required|in:L,P',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
                'tahun_ajaran' => 'required|string|max:255',
                'rfid' => 'nullable|string|max:255',
                'finger' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                continue; // Skip row jika validasi gagal
            }

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

            // Cari atau buat siswa
            Siswa::updateOrCreate(
                ['nis' => $row['nis']],
                [
                    'nis' => $row['nis'],
                    'nama' => $row['nama'],
                    'kelas_id' => $kelas->id,
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
        }
    }
}
