<?php

namespace App\Http\Controllers;
use App\Models\SekolahbinaanT;
use App\User;
use App\Profile;
use App\GuruM;
use App\SekolahM;
use App\Kabupaten;
use App\GolPangkatRuang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Http;

class PegawasMController extends Controller
{
    //tesWa
    // public function tesWa(){
    //     $token = env('WABLAS_TOKEN');
    //     $phone = '62881026697527'; // Ganti dengan nomor telepon tujuan
    //     $message = 'test get'; // Ganti dengan pesan Anda

    //     $response = Http::get("https://jogja.wablas.com/api/send-message", [
    //         'phone' => $phone,
    //         'message' => $message,
    //         'token' => $token,
    //     ]);

    //     $result = $response->body();

    //     echo "<pre>";
    //     dd($result);

    // }

      public function getpangkat(Request $request)
    {
        $search = $request->term;
        $data = GolPangkatRuang::select('pangkat as text', 'id')
        ->where('pangkat', 'LIKE', "%$search%")
        // ->whereNull('id_master')
        ->get();
        
        return response()->json($data);
    }

         public function getRuang(Request $request)
    {
        $search = $request->term;
        $data = GolPangkatRuang::select('ruang_kerja as text', 'id')
        ->where('ruang_kerja', 'LIKE', "%$search%")
        // ->whereNull('id_master')
        ->get();
        
        return response()->json($data);
    }

    /**
     * menampilkan data pengawas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sekolah = SekolahM::where('kabupaten_id',Auth::user()->kabupaten_id)->get();
        // dd($sekolah);
        return view('pengawas.index',compact('sekolah'));
    }

    public function setSekolahBinaan($id){
        $models = User::where('id',$id)->first();
        $sekolah = SekolahM::get();
        $binaan = SekolahbinaanT::with('sekolah')->get();
                       
        // dd($binaan);
        return view('pengawas.add_sekolahbinaan',compact('models','sekolah','binaan'));
    }



    public function getdata(Request $request){
        if ($request->ajax()) {
            // if(Auth::user()->role == 'Super Admin'){
            //     $post = User::with('kabupaten')->where('role','Pengawas')->latest()->get(); 
            // }else if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Stakeholder' ){
            //     $kelompok_kabupaten = Kabupaten::find(Auth::user()->kabupaten_id)->kelompok_kabupaten;
            //     $kabupaten = Kabupaten::where('kelompok_kabupaten',$kelompok_kabupaten)->get();
            //     $id_filter = [];
            //     foreach($kabupaten as $kab){
            //         $id_filter[] = $kab->id;
            //     }
    
                $post = User::with('kabupaten')
                ->where('role','Pengawas')
                // ->whereIn('kabupaten_id',$id_filter)
                ->latest()->get();
    
            // }
            // dd($post);
            return Datatables::of($post)
                    ->addIndexColumn()
                     ->addColumn('foto', function($row){
                        if($row->foto_profile == 'userdefault.jpg'){
                            $foto = asset('userdefault.jpg');
                        }else{
                            $foto = route('fotopengawas', $row->foto_profile);
                            // $foto =  route('pengawas',$row->foto_profile );
                        }

                     return  ' <div class="card card-profile"><img src="'.$foto.'" height="100px" alt="Image placeholder" class="card-img-top"></div>';
                    })->addColumn('no_telp', function($row){
                        return !empty($row->no_telp) ? $row->no_telp: '-';
             })
                      ->addColumn('alamat', function($row){
                               return !empty($row->alamat_lengkap) ? $row->alamat_lengkap: '-';
                    })
                      ->addColumn('kabupaten', function($row){
                        return !empty($row->kabupaten->nama_kabupaten) ? $row->kabupaten->nama_kabupaten: '-';
                    })
                    ->addColumn('binaan', function($row){
                        $binaan = SekolahbinaanT::with('sekolah')->where('id_pengawas',$row->id)->get();
                        $bin = '';
                        foreach ($binaan as $key => $value) {
                            
                            $bin .= '<span class="badge badge-info">'.$value->sekolah->nama_sekolah.'</span>';
                        }
                        return $bin; 

                    })
                    


                    ->addColumn('action', function($row){
   
                           $btn = '<a href="'.route('masterpengawas.edit',$row->id).'" data-toggle="tooltip"  class="edit btn btn-primary btn-sm editPost">Edit</a>';
                           $btn = $btn.' <a href="'.route('masterpengawas.hapus',$row->id).'" data-toggle="tooltip" data-toggle="modal" data-target="#confirmDeleteModal"    data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';
                           $btn = $btn.' <a href="'.route('masterpengawas.setSekolahBinaan',$row->id).'"  class="btn btn-info btn-sm deletePost">Add Sekolah Binaan</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['no_telp','alamat','action','foto','kabupaten','binaan'])
                    ->make(true);
        }
        return view('pengawas.index');
    }

    public function importfile(Request $request){
        Excel::import(new ImportUser,
                      $request->file('file')->store('files'));
        return redirect()->back()->with('success', 'pengawas Import successfully');
       
    }

    public function excelcontoh(Request $request){
         $models = User::where('role','Pengawas')->limit(1)->get();
        $judul = 'Contoh Data pengawas';
        return Excel::download(new ExportUser($models), $judul.'.xlsx');
    }

    /** add data pengawas */
    public function add(){
        //  $wilayah = Kabupaten::get();
        $kelompok_kabupaten = Kabupaten::find(Auth::user()->kabupaten_id)->kelompok_kabupaten;
               
        $wilayah = Kabupaten::select('nama_kabupaten', DB::raw('MAX(id) as id'),
         DB::raw('COUNT(*) as total'))
        ->groupBy('nama_kabupaten')
        ->where('kelompok_kabupaten',$kelompok_kabupaten)
        ->get();
    
        // dd($wilayah);
         return view('pengawas.add',compact('wilayah'));
    }

     /** add data pengawas */
    public function import(){
        return view('pengawas.import');
    }

    public function store_sekolah(Request $request){
        // dd($request);
        $sekolahIds = $request->input('sekolah_id');

        // Loop through each sekolah_id
        foreach ($sekolahIds as $sekolahId) {
            // Retrieve data based on the current sekolah_id
            // $sekolah = Sekolah::find($sekolahId);
            $skolahbinaan = new SekolahbinaanT();
            $skolahbinaan->id_pengawas = $request->input('id_pengawas');
            $skolahbinaan->id_sekolah = $sekolahId;
            $skolahbinaan->save();
        }


            return redirect()->route('masterpengawas.index')->with('success', 'add sekolah binaan pengawas created successfully');


    }

    /** save data pengawas */
    public function store(Request $request){
        // dd($request->post());die;belum
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

            $user->password = Hash::make($request->password);
            $user->role = 'Pengawas';
            
            $user->no_telp = $request->no_telp;
            $user->kota = $request->kota;
            $user->alamat_lengkap = $request->alamat_lengkap;
            $user->kode_area = $request->kode_area;
            $user->kabupaten_id = $request->kabupaten_id;
            $user->save();

            return redirect()->route('masterpengawas.index')->with('success', 'pengawas created successfully');
    }

    public function edit($id){
        $models = User::where('id',$id)->first();
        return view('pengawas.edit',compact('models'));
    }

     public function hapus($id){
         $user = User::where('id',$id)->delete();
        return redirect()->back()->with('success', 'pengawas Delete successfully');
    }

    public function update(Request $request){
         $user = User::where('id',$request->id)->first();
         $user->jenjang_jabatan = $request->jenjang_jabatan;
         $user->pangkat = $request->pangkat;
         $user->gol_ruang = $request->gol_ruang;
       
               $user->no_telp = $request->no_telp;
            $user->kota = $request->kota;
            $user->alamat_lengkap = $request->alamat_lengkap;
            $user->kode_area = $request->kode_area;
             $user->save();

        if(isset($request->password)){
            $user->password = Hash::make($request->password);
            $user->update();
        }

        return redirect()->route('masterpengawas.index',$request->id)->with('success', 'pengawas update successfully');
    }


    
}