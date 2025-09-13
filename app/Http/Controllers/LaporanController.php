<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Exports\LaporanPerSiswaExport;
use App\Kelas;
use App\Siswa;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    //index
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $dari_tanggal = request('dari_tanggal');
        $sampai_tanggal = request('sampai_tanggal');
        $kelas = request('kelas');
        $siswa = request('siswa');

        $query = DB::table('input_pelanggaran_t as t')
            ->select(
                't.id as pelanggaran_id',
                't.created_at as tanggal',
                's.nama',
                's.id as siswa_id',
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
            ->leftJoin('users as u', 't.pelapor_id', '=', 'u.id');

        // Filter berdasarkan role guru
        if ($user->role === 'Guru') {
            $query->where('k.id', $user->kelas_id);
        }

        $query->when($dari_tanggal, function ($query, $dari_tanggal) {
                return $query->where('t.created_at', '>=', $dari_tanggal . ' 00:00:00');
            })
            ->when($sampai_tanggal, function ($query, $sampai_tanggal) {
                return $query->where('t.created_at', '<=', $sampai_tanggal . ' 23:59:59');
            })
            ->when($kelas, function ($query, $kelas) {
                return $query->where('k.id', $kelas);
            })
            ->when($siswa, function ($query, $siswa) {
                return $query->where('s.id', $siswa);
            });

        $allData = $query->get();

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
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $query = DB::table('kelas')
            ->select(
                'kelas.nama_kelas',
                'kelas.subkelas',
                'kelas.id',
            )
            ->where('kelas.status', true);

        // Filter berdasarkan role guru
        if ($user->role === 'Guru') {
            $query->where('kelas.id', $user->kelas_id);
        }

        // Jika ada parameter id, cari kelas berdasarkan id
        if (!empty($request->id)) {
            $data = $query->where('kelas.id', $request->id)->get();
        } elseif (!empty($request->term)) {
            $cari = $request->term;
            $data = $query->where(function ($query) use ($cari) {
                    $query->where('kelas.nama_kelas', 'LIKE', '%' . $cari . '%')
                        ->orWhere('kelas.subkelas', 'LIKE', '%' . $cari . '%');
                })
                ->limit(10)
                ->get();
        } else {
            $data = $query->limit(10)->get();
        }
        return response()->json($data);
    }

    public function setsiswa(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $query = DB::table('siswa')
            ->select(
                'siswa.nama',
                'siswa.id',
            )
            ->leftJoin('kelas as k', 'siswa.kelas_id', '=', 'k.id')
            ->where('siswa.status', true);

        // Filter berdasarkan role guru
        if ($user->role === 'Guru') {
            $query->where('k.id', $user->kelas_id);
        } else {
            // Untuk admin, gunakan kelas_id dari request jika ada
            if ($request->kelas_id) {
                $query->where('k.id', $request->kelas_id);
            }
        }

        // Jika ada parameter id, cari siswa berdasarkan id
        if (!empty($request->id)) {
            $data = $query->where('siswa.id', $request->id)->get();
        } elseif (!empty($request->term)) {
            $cari = $request->term;
            $data = $query->where('siswa.nama', 'LIKE', '%' . $cari . '%')
                ->limit(10)
                ->get();
        } else {
            $data = $query->limit(10)->get();
        }
        return response()->json($data);
    }

    public function export(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal =  $request->sampai_tanggal;
        $kelas =  $request->kelas;
        $siswa = $request->siswa;
        $modKelas = Kelas::find($kelas);
        $modSiswa = Siswa::find($siswa);

        if ($siswa) {
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
                ->when($kelas, function ($query, $kelas) {
                    return $query->where('k.id', $kelas);
                })
                ->when($siswa, function ($query, $siswa) {
                    return $query->where('s.id', $siswa);
                })
                ->get();

            $grouped = $allData->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');
            });

            return Excel::download(new LaporanPerSiswaExport($grouped, $dari_tanggal, $sampai_tanggal, $modKelas, $modSiswa), 'Laporan Pelanggaran.xlsx');
        } else {
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
                    return $query->where('t.created_at', '>=', $dari_tanggal . ' 00:00:00');
                })
                ->when($sampai_tanggal, function ($query, $sampai_tanggal) {
                    return $query->where('t.created_at', '<=', $sampai_tanggal . ' 23:59:59');
                })
                ->when($kelas, function ($query, $kelas) {
                    return $query->where('k.id', $kelas);
                })
                ->when($siswa, function ($query, $siswa) {
                    return $query->where('s.id', $siswa);
                })
                ->get();

            // group dulu
            $grouped = $allData->groupBy(function ($item) {
                return $item->nama . ' - ' . \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') . ' - ' . $item->nama_kelas . ' - ' . $item->pelapor;
            });

            return Excel::download(new LaporanExport($grouped, $dari_tanggal, $sampai_tanggal, $modKelas), 'Laporan Pelanggaran.xlsx');
        }
    }

    public function exportPDF(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal =  $request->sampai_tanggal;
        $kelas =  $request->kelas;
        $siswa = $request->siswa;
        $modKelas = Kelas::find($kelas);
        $modSiswa = Siswa::find($siswa);

        if ($siswa) {
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
                ->when($kelas, function ($query, $kelas) {
                    return $query->where('k.id', $kelas);
                })
                ->when($siswa, function ($query, $siswa) {
                    return $query->where('s.id', $siswa);
                })
                ->get();

            $grouped = $allData->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');
            });

            $param = [
                'laporanPelanggaran' => $grouped,
                'modKelas' => $modKelas,
                'modSiswa' => $modSiswa,
            ];

            $pdf = app('dompdf.wrapper');
            $pdf->loadView('laporan.printPerSiswaPDF', $param)
                ->setPaper('A4', 'portrait');
            return $pdf->stream('Laporan Pelanggaran.pdf');
        } else {
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
                    return $query->where('t.created_at', '>=', $dari_tanggal . ' 00:00:00');
                })
                ->when($sampai_tanggal, function ($query, $sampai_tanggal) {
                    return $query->where('t.created_at', '<=', $sampai_tanggal . ' 23:59:59');
                })
                ->when($kelas, function ($query, $kelas) {
                    return $query->where('k.id', $kelas);
                })
                ->when($siswa, function ($query, $siswa) {
                    return $query->where('s.id', $siswa);
                })
                ->get();

            // group dulu
            $grouped = $allData->groupBy(function ($item) {
                return $item->nama . ' - ' . \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') . ' - ' . $item->nama_kelas . ' - ' . $item->pelapor;
            });

            $param = [
                'laporanPelanggaran' => $grouped,
                'dari_tanggal' => $dari_tanggal,
                'sampai_tanggal' => $sampai_tanggal,
                'modKelas' => $modKelas,
            ];

            $pdf = app('dompdf.wrapper');
            $pdf->loadView('laporan.printPDF', $param)
                ->setPaper('A4', 'landscape');
            return $pdf->stream('Laporan Pelanggaran.pdf');
        }
        // return $pdf->download('Laporan Pelanggaran.pdf');
    }

    public function exportPerKelas(Request $request)
    {
        $dari_tanggal = $request->get('dari_tanggal');
        $sampai_tanggal = $request->get('sampai_tanggal');
        $kelas_id = $request->get('kelas');

        // Validasi: kelas harus dipilih
        if (!$kelas_id) {
            return redirect()->back()->with('error', 'Silakan pilih kelas terlebih dahulu.');
        }

        // Ambil data kelas
        $kelas = Kelas::find($kelas_id);
        if (!$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
        }

        // Ambil semua siswa di kelas tersebut
        $siswa = Siswa::with(['kelas', 'point'])
            ->where('kelas_id', $kelas_id)
            ->orderBy('nama', 'asc')
            ->get();

        // Ambil semua jenis pelanggaran untuk header
        $jenisPelanggaran = \App\Models\JenisPelanggaran::with('kategori')
            ->orderBy('kode', 'asc')
            ->get();

        // Ambil data histori poin untuk setiap siswa dalam rentang tanggal
        $historiData = [];
        foreach ($siswa as $s) {
            $histori = DB::table('historipoint_t as h')
                ->select(
                    'h.poin_perubahan',
                    'h.created_at',
                    'j.kode',
                    'j.nama_pelanggaran',
                    'j.poin'
                )
                ->leftJoin('input_pelanggaran_t as i', 'h.input_pelanggaran_id', '=', 'i.id')
                ->leftJoin('jenis_pelanggaran as j', 'i.jenis_pelanggaran_id', '=', 'j.id')
                ->where('h.siswa_id', $s->id)
                ->when($dari_tanggal, function ($query, $dari_tanggal) {
                    return $query->where('h.created_at', '>=', $dari_tanggal . ' 00:00:00');
                })
                ->when($sampai_tanggal, function ($query, $sampai_tanggal) {
                    return $query->where('h.created_at', '<=', $sampai_tanggal . ' 23:59:59');
                })
                ->get();

            $historiData[$s->id] = $histori;
        }

        // Buat data untuk Excel
        $data = [
            'kelas' => $kelas,
            'siswa' => $siswa,
            'jenisPelanggaran' => $jenisPelanggaran,
            'historiData' => $historiData,
            'dari_tanggal' => $dari_tanggal,
            'sampai_tanggal' => $sampai_tanggal
        ];

        return Excel::download(new \App\Exports\LaporanPerKelasExport($data), 'Laporan_Poin_Per_Kelas_' . $kelas->nama_kelas . '_' . $kelas->subkelas . '.xlsx');
    }
}
