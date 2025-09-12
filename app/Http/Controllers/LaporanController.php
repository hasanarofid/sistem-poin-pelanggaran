<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    //index
    public function index()
    {
        $dari_tanggal = request('dari_tanggal');
        $sampai_tanggal = request('sampai_tanggal');
        $kelas = request('kelas');

        $allData = DB::table('input_pelanggaran_t as t')
            ->select(
                't.id as pelanggaran_id',
                't.created_at as tanggal',
                's.nama',
                'k.nama_kelas',
                'k.subkelas',
                'k.id as kelas_id',
                'j.nama_pelanggaran',
                'j.poin',
                'u.name as pelapor'
            )
            ->leftJoin('siswa as s', 't.siswa_id', '=', 's.id')
            ->leftJoin('jenis_pelanggaran as j', 't.jenis_pelanggaran_id', '=', 'j.id')
            ->leftJoin('kelas as k', 's.kelas_id', '=', 'k.id')
            ->leftJoin('users as u', 't.pelapor_id', '=', 'u.id')
            ->when($dari_tanggal, function ($query, $dari_tanggal) {
                return $query->where('t.created_at', '>=', $dari_tanggal);
            })
            ->when($sampai_tanggal, function ($query, $sampai_tanggal) {
                return $query->where('t.created_at', '<=', $sampai_tanggal);
            })
            ->when($kelas, function ($query, $kelas) {
                return $query->where('k.id', $kelas);
            })
            ->get();

        // group dulu
        $grouped = $allData->groupBy(function ($item) {
            return $item->nama . ' - ' . \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') . ' - ' . $item->nama_kelas . ' - ' . $item->pelapor;
        });

        // ambil current page
        $page = request('page', 1);
        $perPage = 10;

        // slice data sesuai halaman
        $paginated = new LengthAwarePaginator(
            $grouped->forPage($page, $perPage),
            $grouped->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('laporan.index', [
            'laporanPelanggaran' => $paginated
        ]);
    }

    public function setkelas(Request $request)
    {
        // Jika ada parameter id, cari kelas berdasarkan id
        if (!empty($request->id)) {
            $data = DB::table('kelas')
                ->select(
                    'kelas.nama_kelas',
                    'kelas.subkelas',
                    'kelas.id',
                )
                ->where('kelas.status', true)
                ->where('kelas.id', $request->id)
                ->get();
        } elseif (!empty($request->term)) {
            $cari = $request->term;
            $data = DB::table('kelas')
                ->select(
                    'kelas.nama_kelas',
                    'kelas.subkelas',
                    'kelas.id',
                )
                ->where('kelas.status', true)
                ->where(function ($query) use ($cari) {
                    $query->where('kelas.nama_kelas', 'LIKE', '%' . $cari . '%')
                        ->orWhere('kelas.subkelas', 'LIKE', '%' . $cari . '%');
                })
                ->limit(10)
                ->get();
        } else {
            $data = DB::table('kelas')
                ->select(
                    'kelas.nama_kelas',
                    'kelas.subkelas',
                    'kelas.id',
                )
                ->where('kelas.status', true)
                ->limit(10)
                ->get();
        }
        return response()->json($data);
    }

    public function export(Request $request)
    {
        
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal =  $request->sampai_tanggal;
        $kelas =  $request->kelas;
        $modKelas = Kelas::find($kelas);

        $allData = DB::table('input_pelanggaran_t as t')
            ->select(
                't.id as pelanggaran_id',
                't.created_at as tanggal',
                's.nama',
                'k.nama_kelas',
                'k.subkelas',
                'k.id as kelas_id',
                'j.nama_pelanggaran',
                'j.poin',
                'u.name as pelapor'
            )
            ->leftJoin('siswa as s', 't.siswa_id', '=', 's.id')
            ->leftJoin('jenis_pelanggaran as j', 't.jenis_pelanggaran_id', '=', 'j.id')
            ->leftJoin('kelas as k', 's.kelas_id', '=', 'k.id')
            ->leftJoin('users as u', 't.pelapor_id', '=', 'u.id')
            ->when($dari_tanggal, function ($query, $dari_tanggal) {
                return $query->where('t.created_at', '>=', $dari_tanggal);
            })
            ->when($sampai_tanggal, function ($query, $sampai_tanggal) {
                return $query->where('t.created_at', '<=', $sampai_tanggal);
            })
            ->when($kelas, function ($query, $kelas) {
                return $query->where('k.id', $kelas);
            })
            ->get();

        // group dulu
        $grouped = $allData->groupBy(function ($item) {
            return $item->nama . ' - ' . \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') . ' - ' . $item->nama_kelas . ' - ' . $item->pelapor;
        });

        return Excel::download(new LaporanExport($grouped, $dari_tanggal, $sampai_tanggal, $modKelas), 'Laporan Pelanggaran.xlsx');
    }
}
