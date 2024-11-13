<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use App\GuruM;
use App\SekolahM;
use App\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\MasterTupoksi;
use App\TanggapanUmpanbalikT;
use App\Models\RencanaKerjaT;
use App\Models\UmpanbalikT;

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
                    'listPengawas' 
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
        $pengawas = $request->input('pengawas', 'all');
        $query = UmpanbalikT::with('pengawasnama')
        ->selectRaw('id_pengawas, COUNT(*) as total')
        ->groupBy('id_pengawas');

         // Apply the year filter
         if ($pengawas !== 'all') {
            $query->where('id_pengawas', $pengawas);
        }

         // Get the results
         $data = $query->get()
         ->map(function ($item) {
             return [
                'pengawas' => $item->pengawasnama ? $item->pengawasnama->name : 'Unknown',
                'total' => $item->total
             ];
         });
         return response()->json($data);
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
                ) as interaksi, 
                AVG(
                    CASE jawaban_6
                        WHEN "Sangat Baik" THEN 4
                        WHEN "Baik" THEN 3
                        WHEN "Cukup" THEN 2
                        WHEN "Kurang" THEN 1
                        WHEN "Sangat Kurang" THEN 0
                    END
                ) as suasana, 
                AVG(
                    CASE jawaban_7
                        WHEN "Sangat Baik" THEN 4
                        WHEN "Baik" THEN 3
                        WHEN "Cukup" THEN 2
                        WHEN "Kurang" THEN 1
                        WHEN "Sangat Kurang" THEN 0
                    END
                ) as materi, 
                AVG(
                    CASE jawaban_8
                        WHEN "Sangat Baik" THEN 4
                        WHEN "Baik" THEN 3
                        WHEN "Cukup" THEN 2
                        WHEN "Kurang" THEN 1
                        WHEN "Sangat Kurang" THEN 0
                    END
                ) as komunikasi, 
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