<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SekolahExport implements FromCollection, WithMapping, WithColumnWidths, WithHeadings, WithStyles {

    use Exportable;

    protected $query;
    public $rowNumber = 1;

    function __construct($query) {
        $this->query = $query;
    }

    public function collection() {
        return $this->query;
    }

    public function styles(Worksheet $sheet) {
        return [
            'A1' => ['font' => ['bold' => true]],
            'B1' => ['font' => ['bold' => true]],
            'C1' => ['font' => ['bold' => true]],
            'D1' => ['font' => ['bold' => true]],
            'E1' => ['font' => ['bold' => true]],
            'F1' => ['font' => ['bold' => true]],


                    ];
    }

    public function columnWidths(): array {
        return [
            'A' => 35,
            'B' => 35,
            'C' => 35,
            'D' => 35,
            'E' => 15,
            'F' => 15,


        ];
    }

    /**
     * Custom Header
     */
    public function headings(): array {
        return [
            'Nama Sekolah',  'NPSN', 'No Telpon/Wa', 'Alamat','Kota','Kode Area',



        ];
    }

    /**
     * Mapping data dalam excel
     */
    public function map($row): array {
        return [
            (!empty($row->nama_sekolah) ? $row->nama_sekolah : '-'),
              ('npsn set disini (data unik)'),
            (!empty($row->no_telp) ? $row->no_telp : '-'),
            (!empty($row->alamat_lengkap) ? $row->alamat_lengkap : '-'),
            (!empty($row->kota) ? $row->kota : '-'),
            (!empty($row->kode_area) ? $row->kode_area : '-')
          
        ];
    }
}
