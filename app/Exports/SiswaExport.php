<?php

namespace App\Exports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::with(['kelas', 'tahunAjaran'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'NIS',
            'Nama',
            'Kelas',
            'Subkelas',
            'HP Orang Tua',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Tahun Ajaran',
            'RFID',
            'Finger'
        ];
    }

    /**
     * @param mixed $siswa
     * @return array
     */
    public function map($siswa): array
    {
        static $no_urut = 1; // Inisialisasi nomor urut
        return [
            $no_urut++, // Menggunakan nomor urut dari jumlah data
            $siswa->nis,
            $siswa->nama,
            $siswa->kelas->nama_kelas ?? '',
            $siswa->kelas->subkelas ?? '',
            $siswa->hp_orang_tua,
            $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $siswa->tempat_lahir,
            $siswa->tanggal_lahir->format('Y-m-d'),
            $siswa->alamat,
            $siswa->tahunAjaran->tahun_ajaran ?? '',
            $siswa->rfid,
            $siswa->finger
        ];
    }
}
