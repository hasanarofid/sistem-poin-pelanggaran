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

class ExportUser implements FromCollection, WithMapping, WithColumnWidths, WithHeadings, WithStyles {

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
            'G1' => ['font' => ['bold' => true]],
            'H1' => ['font' => ['bold' => true]],
            'I1' => ['font' => ['bold' => true]],
            'J1' => ['font' => ['bold' => true]],
            'K1' => ['font' => ['bold' => true]],


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
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 15,




        ];
    }

    /**
     * Custom Header
     */
    public function headings(): array {
        return [
            'Nama Pengawas', 'NIP','Jenjang Jabatan','Pangkat','Gol Ruang', 'Email', 'Password','No Telpon', 'Alamat','Kota','Kode Area',



        ];
    }

    /**
     * Mapping data dalam excel
     */
    public function map($row): array {
        return [
            (!empty($row->name) ? $row->name : '-'),
            ('set nip '),
            ('set jenjang jabatan'),
            ('set pangkat'),
            ('set gol ruang'),
            (!empty($row->email) ? $row->email : '-'),
              ('setpasswordsinini'),
            (!empty($row->profile->no_telp) ? $row->profile->no_telp : '-'),
            (!empty($row->profile->alamat_lengkap) ? $row->profile->alamat_lengkap : '-'),
            (!empty($row->profile->kota) ? $row->profile->kota : '-'),

            (!empty($row->profile->kode_area) ? $row->profile->kode_area : '-')
          



        ];
    }

   

}
