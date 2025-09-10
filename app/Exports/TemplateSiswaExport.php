<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateSiswaExport implements WithHeadings
{
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
}
