<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use Illuminate\Http\Request;
use App\MasterTupoksi;
use App\Kabupaten;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Auth;

class MastertupoksiController extends Controller
{
    //index
    public function index(){
        return view('mastertupoksi.index');
    }

    public function getdata(Request $request){
        if ($request->ajax()) {
          
                $post = Kategory::where('type', 'pelaporan')->get();
    
            // dd($post);
            return Datatables::of($post)
            ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="'.route('mastertupoksi.edit',$row->id).'" data-toggle="tooltip"  class="edit btn btn-primary btn-sm editPost">Edit</a>';
                           $btn = $btn.' <a href="'.route('mastertupoksi.hapus',$row->id).'" data-toggle="tooltip" data-toggle="modal" data-target="#confirmDeleteModal"    data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('mastertupoksi.index');
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
       
         return view('mastertupoksi.add');
    }

     /** add data pengawas */
    public function import(){
        return view('pengawas.import');
    }

    /** save data pengawas */
    public function store(Request $request){
        // dd($request->post());die;
  
            $model = new mastertupoksi();
            $model->tahun_ajaran = $request->tahun_ajaran;
            $model->semester = $request->semester;
            $model->kegiatan = $request->kegiatan;
            $model->urutan = $request->urutan;

            if($request->is_sub == 'sub'){
                $model->id_kegiatan = $request->id_kegiatan;
            }

            $model->save();

        
            return redirect()->route('mastertupoksi.index')->with('success', 'mastertupoksi created successfully');
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

        return redirect()->route('pengawas.index',$request->id)->with('success', 'pengawas update successfully');
    }

    public function getkegiatan(Request $request)
    {
        $search = $request->term;
        $data = MasterTupoksi::select('kegiatan as text', 'id')
        ->whereNull('id_kegiatan')
        ->where('kegiatan', 'LIKE', "%$search%")
        ->get();
        
        return response()->json($data);
    }

}
