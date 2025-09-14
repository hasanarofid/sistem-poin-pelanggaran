<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use App\GuruM;
use App\SekolahM;
use App\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\MasterTupoksi;
use App\Models\InputPelanggaranT;
use App\TanggapanUmpanbalikT;
use App\Models\RencanaKerjaT;
use App\Models\UmpanbalikT;
use App\Siswa;
use App\Models\JenisPelanggaran;
use App\Models\Kategori;
use App\Point;
use App\HistoriPoint;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Periksa apakah pengguna adalah pengawas
            if (Auth::user()->role == "Pengawas") {
                // Pengguna sudah login dan adalah pengawas, lanjutkan ke halaman pengawas
                Auth::logout(); // Logout pengguna yang bukan pengawas
                return redirect('/pengawas/login');
            } else {
                // if(Auth::user()->role == 'Super Admin'){
                    $total_guru = GuruM::where('is_aktif',true)->get()->count();
                    $total_sekolah = SekolahM::where('is_aktif',true)->get()->count();
                    $total_pengawas = User::where('role','Pengawas')->get()->count();
                    $total_stockholder = User::where('role','Stakeholder')->get()->count();
                    $total_rencankerja = RencanaKerjaT::get()->count();
                    $total_umpanbalik = UmpanbalikT::get()->count();
                    $total_siswa = Siswa::get()->count();
                    
                    // Data untuk dashboard sistem poin pelanggaran
                    $today = Carbon::today();
                    $thisMonth = Carbon::now()->month;
                    $thisYear = Carbon::now()->year;
                    
                    // Pelanggaran bulan ini
                    $pelanggaran_bulan_ini = InputPelanggaranT::whereHas('jenispelanggaran', function($q) {
                        $q->where('poin', '<', 0);
                    })
                    ->whereMonth('created_at', $thisMonth)
                    ->whereYear('created_at', $thisYear)
                    ->count();
                    
                    // Siswa bermasalah (poin <= 80, karena default 100)
                    $siswa_bermasalah = Point::where('total_poin', '<=', 20)->count();
                    
                    // Sanksi aktif (poin <= 70, karena default 100)
                    $sanksi_aktif = Point::where('total_poin', '<=', 30)->count();
                    
                    // Pelanggaran hari ini
                    $pelanggaran_hari_ini = InputPelanggaranT::with(['siswa', 'jenispelanggaran'])
                        ->whereHas('jenispelanggaran', function($q) {
                            $q->where('poin', '<', 0);
                        })
                        ->whereDate('created_at', $today)
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                    
                    // Reward hari ini
                    $reward_hari_ini = InputPelanggaranT::with(['siswa', 'jenispelanggaran'])
                        ->whereHas('jenispelanggaran', function($q) {
                            $q->where('poin', '>', 0);
                        })
                        ->whereDate('created_at', $today)
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                    
                    // Kelas dengan pelanggar terbanyak
                    $kelas_pelanggar_terbanyak = DB::table('input_pelanggaran_t')
                        ->join('siswa', 'input_pelanggaran_t.siswa_id', '=', 'siswa.id')
                        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                        ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
                        ->where('jenis_pelanggaran.poin', '<', 0)
                        ->select('kelas.subkelas as kelas', DB::raw('COUNT(DISTINCT siswa.id) as jumlah_siswa'))
                        ->groupBy('kelas.id', 'kelas.subkelas')
                        ->orderBy('jumlah_siswa', 'desc')
                        ->limit(5)
                        ->get();
                    
                    // Kelas dengan reward terbanyak
                    $kelas_reward_terbanyak = DB::table('input_pelanggaran_t')
                        ->join('siswa', 'input_pelanggaran_t.siswa_id', '=', 'siswa.id')
                        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                        ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
                        ->where('jenis_pelanggaran.poin', '>', 0)
                        ->select('kelas.subkelas as kelas', DB::raw('COUNT(DISTINCT siswa.id) as jumlah_siswa'))
                        ->groupBy('kelas.id', 'kelas.subkelas')
                        ->orderBy('jumlah_siswa', 'desc')
                        ->limit(5)
                        ->get();
                    
                    // Siswa dengan pelanggaran terbanyak
                    $siswa_pelanggaran_terbanyak = DB::table('input_pelanggaran_t')
                        ->join('siswa', 'input_pelanggaran_t.siswa_id', '=', 'siswa.id')
                        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                        ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
                        ->where('jenis_pelanggaran.poin', '<', 0)
                        ->select('siswa.nama', 'kelas.subkelas as kelas', DB::raw('COUNT(*) as jumlah_pelanggaran'))
                        ->groupBy('siswa.id', 'siswa.nama', 'kelas.subkelas')
                        ->orderBy('jumlah_pelanggaran', 'desc')
                        ->limit(5)
                        ->get();
                    
                    // Siswa dengan reward terbanyak
                    $siswa_reward_terbanyak = DB::table('input_pelanggaran_t')
                        ->join('siswa', 'input_pelanggaran_t.siswa_id', '=', 'siswa.id')
                        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                        ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
                        ->where('jenis_pelanggaran.poin', '>', 0)
                        ->select('siswa.nama', 'kelas.subkelas as kelas', DB::raw('COUNT(*) as jumlah_reward'))
                        ->groupBy('siswa.id', 'siswa.nama', 'kelas.subkelas')
                        ->orderBy('jumlah_reward', 'desc')
                        ->limit(5)
                        ->get();
                    
                    // Top pelanggaran
                    $top_pelanggaran = DB::table('input_pelanggaran_t')
                        ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
                        ->join('kategori_m', 'jenis_pelanggaran.kategori_id', '=', 'kategori_m.id')
                        ->where('kategori_m.nama_kategori', 'pelanggaran')
                        ->select('jenis_pelanggaran.nama_pelanggaran', DB::raw('COUNT(*) as jumlah'))
                        ->groupBy('jenis_pelanggaran.id', 'jenis_pelanggaran.nama_pelanggaran')
                        ->orderBy('jumlah', 'desc')
                        ->limit(5)
                        ->get();

                    // Top penghargaan
                    $top_penghargaan = DB::table('input_pelanggaran_t')
                        ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
                        ->join('kategori_m', 'jenis_pelanggaran.kategori_id', '=', 'kategori_m.id')
                        ->where('kategori_m.nama_kategori', 'penghargaan')
                        ->select('jenis_pelanggaran.nama_pelanggaran', DB::raw('COUNT(*) as jumlah'))
                        ->groupBy('jenis_pelanggaran.id', 'jenis_pelanggaran.nama_pelanggaran')
                        ->orderBy('jumlah', 'desc')
                        ->limit(5)
                        ->get();
                    
                    // Trend pelanggaran mingguan (7 hari terakhir)
                  // Ganti bagian trend_pelanggaran (baris 143-158) dengan:
                    $trend_combined = [];
                    for ($i = 6; $i >= 0; $i--) {
                        $date = Carbon::now()->subDays($i);
                        
                        // Data pelanggaran (poin negatif)
                        $pelanggaran_count = InputPelanggaranT::whereHas('jenispelanggaran', function($q) {
                            $q->where('poin', '<', 0);
                        })
                        ->whereDate('created_at', $date)
                        ->count();
                        
                        // Data penghargaan (poin positif)
                        $penghargaan_count = InputPelanggaranT::whereHas('jenispelanggaran', function($q) {
                            $q->where('poin', '>', 0);
                        })
                        ->whereDate('created_at', $date)
                        ->count();
                        
                        $dayNames = ['Sun' => 'Min', 'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'];
                        $trend_combined[] = [
                            'day' => $dayNames[$date->format('D')] ?? $date->format('D'),
                            'pelanggaran' => $pelanggaran_count,
                            'penghargaan' => $penghargaan_count
                        ];
                    }
                    
                    // Trend reward mingguan (7 hari terakhir)
                    $trend_reward = [];
                    for ($i = 6; $i >= 0; $i--) {
                        $date = Carbon::now()->subDays($i);
                        $count = InputPelanggaranT::whereHas('jenispelanggaran', function($q) {
                            $q->where('poin', '>', 0);
                        })
                        ->whereDate('created_at', $date)
                        ->count();
                        
                        $dayNames = ['Sun' => 'Min', 'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'];
                        $trend_reward[] = [
                            'day' => $dayNames[$date->format('D')] ?? $date->format('D'),
                            'count' => $count
                        ];
                    }
// Top 10 Pelanggaran Minggu Ini
$top_pelanggaran_minggu = DB::table('input_pelanggaran_t')
    ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
    ->where('jenis_pelanggaran.poin', '<', 0)
    ->whereBetween('input_pelanggaran_t.created_at', [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek()
    ])
    ->select('jenis_pelanggaran.nama_pelanggaran', 'jenis_pelanggaran.kode', DB::raw('COUNT(*) as jumlah'))
    ->groupBy('jenis_pelanggaran.id', 'jenis_pelanggaran.nama_pelanggaran', 'jenis_pelanggaran.kode')
    ->orderBy('jumlah', 'desc')
    ->limit(10)
    ->get();

// Top 10 Reward Minggu Ini
$top_reward_minggu = DB::table('input_pelanggaran_t')
    ->join('jenis_pelanggaran', 'input_pelanggaran_t.jenis_pelanggaran_id', '=', 'jenis_pelanggaran.id')
    ->where('jenis_pelanggaran.poin', '>', 0)
    ->whereBetween('input_pelanggaran_t.created_at', [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek()
    ])
    ->select('jenis_pelanggaran.nama_pelanggaran', 'jenis_pelanggaran.kode', DB::raw('COUNT(*) as jumlah'))
    ->groupBy('jenis_pelanggaran.id', 'jenis_pelanggaran.nama_pelanggaran', 'jenis_pelanggaran.kode')
    ->orderBy('jumlah', 'desc')
    ->limit(10)
    ->get();

                    // }else if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Stakeholder' ){
                //     $kelompok_kabupaten = Kabupaten::find(Auth::user()->kabupaten_id)->kelompok_kabupaten;
                //     $kabupaten = Kabupaten::where('kelompok_kabupaten',$kelompok_kabupaten)->get();
                //     $id_filter = [];
                //     foreach($kabupaten as $kab){
                //         $id_filter[] = $kab->id;
                //     }

                //     $total_guru = GuruM::where('is_aktif',true)->whereIn('kabupaten_id',$id_filter)->get()->count();
                //     $total_sekolah = SekolahM::where('is_aktif',true)->whereIn('kabupaten_id',$id_filter)->get()->count();
                //     $total_pengawas = User::where('role','Pengawas')->whereIn('kabupaten_id',$id_filter)->get()->count();
                //     $total_stockholder = User::where('role','Stakeholder')->whereIn('kabupaten_id',$id_filter)->get()->count();
                //      // dd($total_guru);

                // }
            $master = MasterTupoksi::orderBy('urutan')->get();
            $currentMonth = date('n'); // Numeric representation of the current month (1-12)
        $currentYear = date('Y');  // Current year
        $years = range($currentYear - 5, $currentYear + 5);
         $months = [];

        // Array of month names in Indonesian
        $monthNamesIndo = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Generate the current and next 11 months in Indonesian
        for ($i = 0; $i < 12; $i++) {
            $timestamp = strtotime("+$i month");
            $monthNumber = date('n', $timestamp);
            $months[] = [
                'value' => $monthNumber,                // Month number (1-12)
                'name' => $monthNamesIndo[$monthNumber] // Full month name in Indonesian
            ];
        }


        $listPengawas = User::where('role','pengawas')->get();
                return view('adminNew.index',
                compact(
                    'total_guru',
                    'total_sekolah',
                    'total_pengawas',
                    'total_stockholder',
                    'total_rencankerja',
                    'total_umpanbalik',
                    'months',
                    'currentYear',
                    'years',
                    'listPengawas',
                    'total_siswa',
                    'pelanggaran_bulan_ini',
                    'siswa_bermasalah',
                    'sanksi_aktif',
                    'pelanggaran_hari_ini',
                    'reward_hari_ini',
                    'kelas_pelanggar_terbanyak',
                    'kelas_reward_terbanyak',
                    'siswa_pelanggaran_terbanyak',
                    'siswa_reward_terbanyak',
                    'top_pelanggaran',
                    'top_penghargaan',
                    'trend_combined',
                    'trend_reward',
                    'top_pelanggaran_minggu',
                    'top_reward_minggu'
                    ) );
            }
        }

    }

    public function chartData(Request $request)
    {
        $month = $request->input('bln', 'all');
        $year = $request->input('tahun', 'all');

        $query = RencanaKerjaT::with('pengawasnama')
        ->selectRaw('id_pengawas, COUNT(*) as total')
        ->groupBy('id_pengawas');

        // Apply the month filter
        if ($month !== 'all') {
            $query->where('bulan', $month);
        }

        // Apply the year filter
        if ($year !== 'all') {
            $query->where('tahun_ajaran', $year);
        }

        // Get the results
        $data = $query->get()
            ->map(function ($item) {
                return [
                    'pengawas' => $item->pengawasnama ? $item->pengawasnama->name : 'Unknown',
                    'total' => $item->total
                ];
            });

        // Return the data as JSON
        return response()->json($data); // Return JSON data for use in the view
    }
    public function chartData2(Request $request)
    {
        $month = $request->input('bln', 'all');
        $year = $request->input('tahun', 'all');
        $pengawas = $request->input('pengawas', 'all');

        $query = UmpanbalikT::with('pengawasnama', 'rencanakerja')
            ->selectRaw('id_pelaporan, 
                        COUNT(DISTINCT CONCAT(umpanbalik_t.id_user, "-", umpanbalik_t.id_pelaporan)) as total_umpan_balik,
                        COUNT(DISTINCT CONCAT(tanggapan_umpanbalik_t.id)) as total_respon

                ')
            ->join('rencakakerja_t', 'umpanbalik_t.id_pelaporan', '=', 'rencakakerja_t.id')
            ->leftJoin('tanggapan_umpanbalik_t', 'tanggapan_umpanbalik_t.id_umpanbalik', '=', 'umpanbalik_t.id')
            // ->whereNotNull('tanggapan_umpanbalik_t.id')  // Abaikan nilai NULL
               ->groupBy('id_pelaporan');

        // Apply the filters    COUNT(DISTINCT CONCAT(tanggapan_umpanbalik_t.id_user, "-", tanggapan_umpanbalik_t.id)) as total_respon
        if ($pengawas !== 'all') {
            $query->where('umpanbalik_t.id_pengawas', $pengawas);
        }
        $query->whereHas('rencanakerja', function ($q) use ($month, $year) {
            if ($month !== 'all') $q->where('bulan', $month);
            if ($year !== 'all') $q->where('tahun_ajaran', $year);
        });
        // dd($query->get());
        // $result = $query->get();
        // dd($result);
        $data = $query->get()->map(function ($item) {
            return [
                'rencana_kerja' => $item->rencanakerja ? $item->rencanakerja->nama_program_kerja : 'Unknown',
                'total_respon' => $item->total_respon,
                'total_umpan_balik' => $item->total_umpan_balik,
            ];
        });

        return response()->json($data);
    }


    public function chartData2lama(Request $request)
    {
        $month = $request->input('bln', 'all');
        $year = $request->input('tahun', 'all');
        $pengawas = $request->input('pengawas', 'all');

        $query = UmpanbalikT::with('pengawasnama','rencanakerja')
        ->selectRaw('id_pelaporan, COUNT(*) as total')
        ->whereHas('tanggapanUmpanBalik')
        ->groupBy('id_pelaporan');

         // Apply the year filter
         if ($pengawas !== 'all') {
            $query->where('id_pengawas', $pengawas);
        }


         // Apply the month and year filters on the related rencanakerja table
    $query->whereHas('rencanakerja', function ($q) use ($month, $year) {
        if ($month !== 'all') {
            $q->where('bulan', $month);
        }
        if ($year !== 'all') {
            $q->where('tahun_ajaran', $year);
        }
    });

         // Get the results
         $data = $query->get()
         ->map(function ($item) {
             return [
                'pengawas' => $item->rencanakerja ? $item->rencanakerja->nama_program_kerja : 'Unknown',
                'total' => $item->total
             ];
         });
         return response()->json($data);
    }

    // chartDataRaportPendidikan
    public function chartDataRaportPendidikan(Request $request)
    {
        $month = $request->input('bln', 'all');
        $year = $request->input('tahun', 'all');

        $query = RencanaKerjaT::with('aspekprogram')
        ->selectRaw('aspekprogram_id, COUNT(*) as total')
        ->groupBy('aspekprogram_id');

        // Apply the month filter
        if ($month !== 'all') {
            $query->where('bulan', $month);
        }

        // Apply the year filter
        if ($year !== 'all') {
            $query->where('tahun_ajaran', $year);
        }

        // Get the results
        $data = $query->get()
            ->map(function ($item) {
                return [
                    'aspekprogram' => $item->aspekprogram ? $item->aspekprogram->nama : 'Unknown',
                    'total' => $item->total
                ];
            });

        // Return the data as JSON
        return response()->json($data); // Return JSON data for use in the view
    }

    // spider web
    public function getSpiderWebData(Request $request)
    {
        $pengawasId = $request->input('pengawas', 'all');

        // Define the query to calculate averages
        $query = TanggapanUmpanbalikT::selectRaw(
            'AVG(
                CASE jawaban_5
                    WHEN "Sangat Baik" THEN 4
                    WHEN "Baik" THEN 3
                    WHEN "Cukup" THEN 2
                    WHEN "Kurang" THEN 1
                    WHEN "Sangat Kurang" THEN 0
                END
            ) as kemampuan_berinteraksi,
            AVG(
                CASE jawaban_6
                    WHEN "Sangat Baik" THEN 4
                    WHEN "Baik" THEN 3
                    WHEN "Cukup" THEN 2
                    WHEN "Kurang" THEN 1
                    WHEN "Sangat Kurang" THEN 0
                END
            ) as menciptakan_suasana,
            AVG(
                CASE jawaban_7
                    WHEN "Sangat Baik" THEN 4
                    WHEN "Baik" THEN 3
                    WHEN "Cukup" THEN 2
                    WHEN "Kurang" THEN 1
                    WHEN "Sangat Kurang" THEN 0
                END
            ) as penguasaan_materi,
            AVG(
                CASE jawaban_8
                    WHEN "Sangat Baik" THEN 4
                    WHEN "Baik" THEN 3
                    WHEN "Cukup" THEN 2
                    WHEN "Kurang" THEN 1
                    WHEN "Sangat Kurang" THEN 0
                END
            ) as kemampuan_komunikasi,
              AVG(
                CASE jawaban_9
                    WHEN "Sangat Baik" THEN 4
                    WHEN "Baik" THEN 3
                    WHEN "Cukup" THEN 2
                    WHEN "Kurang" THEN 1
                    WHEN "Sangat Kurang" THEN 0
                END
            ) as ketepatan_waktu'
        )
        ->join('umpanbalik_t as ut', 'ut.id', '=', 'tanggapan_umpanbalik_t.id_umpanbalik')
        ->join('rencakakerja_t as rt', 'rt.id', '=', 'ut.id_pelaporan');

        // Apply filter based on pengawasId, if specified
        if ($pengawasId !== 'all') {
            $query->where('rt.id_pengawas', $pengawasId);
        }

        // Execute the query to retrieve the averages
        $data = $query->first();

        return response()->json($data);
    }





    public function data()
    {
        return view('adminNew.data');
    }

    // chart terkonfirmasi
    public function chartTerkonfirmasi(Request $request)
    {
        $month = $request->input('bln', 'all');
        $year = $request->input('tahun', 'all');

        $query = UmpanbalikT::with('pengawasnama','tanggapanUmpanBalik','rencanakerja')
        ->whereHas('tanggapanUmpanBalik') // hanya ambil yang sudah ada tanggapan
        ->selectRaw('id_pengawas, COUNT(*) as total')
        ->groupBy('id_pengawas');

        // Apply the month filter
        // if ($month !== 'all') {
        //     $query->where('bulan', $month);
        // }

        // // Apply the year filter
        // if ($year !== 'all') {
        //     $query->where('tahun_ajaran', $year);
        // }
                // Apply the month and year filters on the related rencanakerja table
    $query->whereHas('rencanakerja', function ($q) use ($month, $year) {
        if ($month !== 'all') {
            $q->where('bulan', $month);
        }
        if ($year !== 'all') {
            $q->where('tahun_ajaran', $year);
        }
    });

        // Get the results
        $data = $query->get()
            ->map(function ($item) {
                return [
                    'pengawas' => $item->pengawasnama ? $item->pengawasnama->name : 'Unknown',
                    'total' => $item->total
                ];
            });

        // Return the data as JSON
        return response()->json($data); // Return JSON data for use in the view
    }

    // chart pie
    public function chartpie(Request $request)
    {
        $pengawas = $request->input('pengawas', 'all');

        // Buat query untuk menghitung jumlah masing-masing jenis jawaban di jawaban_4
        $query = TanggapanUmpanbalikT::selectRaw("
                COUNT(CASE WHEN jawaban_4 = 'Ya, melakukan pendampingan di Sekolah' THEN 1 END) as sekolah,
                COUNT(CASE WHEN jawaban_4 = 'Ya, melakukan pendampingan secara virtual' THEN 1 END) as by_virtual,
                COUNT(CASE WHEN jawaban_4 = 'Ya, pendampingan digabungkan dengan sekolah lain' THEN 1 END) as gabungan,
                COUNT(CASE WHEN jawaban_4 = 'Tidak melakukan pendampingan' THEN 1 END) as tidak
            ")
            ->join('umpanbalik_t as ut', 'ut.id', '=', 'tanggapan_umpanbalik_t.id_umpanbalik')
            ->join('rencakakerja_t as rt', 'rt.id', '=', 'ut.id_pelaporan');

        // Tambahkan filter untuk pengawas jika ada
        if ($pengawas !== 'all') {
            $query->where('rt.id_pengawas', $pengawas);
        }

        // Ambil hasil dan bentuk ulang data untuk output JSON
        $data = $query->first(); // Mengambil hasil sebagai satu baris karena kita hanya menghitung jumlah

        $result = [
            [
                'jawaban' => 'Hadir',
                'total' => $data->sekolah,
            ],
            [
                'jawaban' => 'Hadir Virtual',
                'total' => $data->by_virtual,
            ],
            [
                'jawaban' => 'Hadir Dikumpulkan',
                'total' => $data->gabungan,
            ],
            [
                'jawaban' => 'Tidak Hadir',
                'total' => $data->tidak,
            ],
        ];

        return response()->json($result);
    }

    /** get data */
    public function getdata(Request $request){
        if ($request->ajax()) {
            $post = User::with('kabupaten')->where('role','Admin')->latest()->get();
            // dd($post);
            return Datatables::of($post)
                    ->addIndexColumn()
                     ->addColumn('foto', function($row){
                        if($row->foto_profile == 'userdefault.jpg'){
                            $foto = asset('userdefault.jpg');
                        }else{
                            $foto =  route('admin',$row->foto_profile );
                        }

                     return  '<div class="card card-profile"><img src="'.$foto.'" height="100px" alt="Image placeholder" class="card-img-top"></div>';
                    })->addColumn('no_telp', function($row){
                        return !empty($row->no_telp) ? $row->no_telp: '-';
             })
                      ->addColumn('alamat', function($row){
                               return !empty($row->alamat_lengkap) ? $row->alamat_lengkap: '-';
                    })
                      ->addColumn('kabupaten', function($row){
                        return !empty($row->kabupaten->kelompok_kabupaten) ? $row->kabupaten->kelompok_kabupaten : '-';
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="'.route('admin.edit', $row->id).'" data-toggle="tooltip" class="edit btn btn-primary btn-sm waves-effect waves-light editPost" style="margin-right: 5px;">
                           Edit
                        </a>';
                        $btn .= '<br/><br/>';
                        $btn .= ' <a href="'.route('admin.hapus', $row->id).'" data-toggle="tooltip" data-target="#confirmDeleteModal" data-original-title="Delete" class="btn btn-danger btn-sm waves-effect waves-light deletePost">
                            Delete
                        </a>';
                        return $btn;

                    })
                    ->rawColumns(['no_telp','alamat','action','foto','kabupaten'])
                    ->make(true);
        }
        return view('admin.data');
    }


    public function add(){
        $wilayah = Kabupaten::select('kelompok_kabupaten', DB::raw('MAX(id) as id'), DB::raw('COUNT(*) as total'))
             ->groupBy('kelompok_kabupaten')
             ->get();

        // dd($wilayah);
         return view('adminNew.add',compact('wilayah'));
    }

    public function edit($id){
        $model = User::find($id);
        $wilayah = Kabupaten::select('kelompok_kabupaten', DB::raw('MAX(id) as id'), DB::raw('COUNT(*) as total'))
             ->groupBy('kelompok_kabupaten')
             ->get();

        // dd($wilayah);
         return view('adminNew.edit',compact('model','wilayah'));
    }

     /** save data admin */
    public function store(Request $request){
        // dd($request->post());die;
             $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->nip = $request->nip;
            $user->jenjang_jabatan = $request->jenjang_jabatan;
            $user->pangkat = $request->pangkat;
            $user->gol_ruang = $request->gol_ruang;
            $user->foto_profile = 'userdefault.jpg';
            $user->role = 'Admin';
            $user->kabupaten_id =  $request->kabupaten_id;
            $user->password = Hash::make($request->password);
            $user->no_telp = $request->no_telp;
            $user->kota = $request->kota;
            $user->alamat_lengkap = $request->alamat_lengkap;
            $user->kode_area = $request->kode_area;
            $user->save();

            return redirect()->route('admin.data')->with('success', 'admin created successfully');
    }

    /** save data admin */
    public function update($id,Request $request){
        // dd($request->post());die;
            //  $request->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|email|unique:users',
            //     'password' => 'required|string|min:6',
            // ]);
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->kabupaten_id =  $request->kabupaten_id;

            $user->no_telp = $request->no_telp;
            $user->kota = $request->kota;
            $user->alamat_lengkap = $request->alamat_lengkap;
            $user->kode_area = $request->kode_area;
            $user->save();

             if(isset($request->password)){
            $user->password = Hash::make($request->password);
            $user->update();
        }

            return redirect()->route('admin.data')->with('success', 'admin updated successfully');
    }

    public function hapus($id){
         $user = User::where('id',$id)->delete();
        return redirect()->back()->with('success', 'admin Delete successfully');
    }

}
