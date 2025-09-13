<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class LaporanPerSiswaExport implements FromView, WithColumnWidths
{
    protected $grouped;
    protected $dari_tanggal;
    protected $sampai_tanggal;
    protected $modKelas;
    protected $modSiswa;

    function __construct($grouped, $dari_tanggal, $sampai_tanggal, $modKelas, $modSiswa) {
        $this->grouped = $grouped;
        $this->dari_tanggal = $dari_tanggal;
        $this->sampai_tanggal = $sampai_tanggal;
        $this->modKelas = $modKelas;
        $this->modSiswa = $modSiswa;
    }

    public function view(): View
    {
       return view('laporan.printPerSiswaExcel', [
          'laporanPelanggaran' => $this->grouped,
          'dari_tanggal' => $this->dari_tanggal,
          'sampai_tanggal' => $this->sampai_tanggal,
          'modKelas' => $this->modKelas,
          'modSiswa' => $this->modSiswa,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 10,
            'C' => 40,
            'D' => 20,
        ];
    }
}
