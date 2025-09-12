<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class LaporanExport implements FromView, WithColumnWidths
{
    protected $grouped;
    protected $dari_tanggal;
    protected $sampai_tanggal;
    protected $modKelas;

    function __construct($grouped, $dari_tanggal, $sampai_tanggal, $modKelas) {
        $this->grouped = $grouped;
        $this->dari_tanggal = $dari_tanggal;
        $this->sampai_tanggal = $sampai_tanggal;
        $this->modKelas = $modKelas;
    }

    public function view(): View
    {
       return view('laporan.printExcel', [
          'laporanPelanggaran' => $this->grouped,
          'dari_tanggal' => $this->dari_tanggal,
          'sampai_tanggal' => $this->sampai_tanggal,
          'modKelas' => $this->modKelas,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 40,
            'D' => 20,
            'E' => 40,
            'F' => 10,
            'G' => 40,
        ];
    }
}
