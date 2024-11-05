<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisProgram;
use App\Kabupaten;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Auth;
class JenisprogramController extends Controller
{
    //index
    public function index(){
        return view('jenisprogram.index');
    }

    public function getdata(Request $request){
        if ($request->ajax()) {
          
                $post = JenisProgram::get();
    
            // dd($post);
            return Datatables::of($post)
            ->addIndexColumn()
                    ->addColumn('status', function($row){
                        if($row->status == 1){
                            $status = '<span class="badge bg-label-success m-1" >Active</span>';
                        }else{
                            $status = '<span class="badge bg-label-warning m-1" >InActive</span>';
                        }
                            return $status;
                    })
                    ->addColumn('action', function($row){
   
                        $btn = '<a href="'.route('jenisprogram.edit',$row->id).'" data-toggle="tooltip"  class="edit btn btn-primary btn-sm editPost">Edit</a>';
                        $btn = $btn.' <a href="'.route('jenisprogram.hapus',$row->id).'" data-toggle="tooltip" data-toggle="modal" data-target="#confirmDeleteModal"    data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';
 
                         return $btn;
                 })
                    
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        return view('jenisprogram.index');
    }

    
    /** add data pengawas */
    public function add(){
       
         return view('jenisprogram.add');
    }

    

    /** save data pengawas */
    public function store(Request $request){
        // dd($request->post());die;
  
            $model = new JenisProgram();
            $model->tahun_ajaran = $request->tahun_ajaran;
            $model->semester = $request->semester;
            $model->kegiatan = $request->kegiatan;
            $model->urutan = $request->urutan;

            if($request->is_sub == 'sub'){
                $model->id_kegiatan = $request->id_kegiatan;
            }

            $model->save();

        
            return redirect()->route('jenisprogram.index')->with('success', 'JenisProgram created successfully');
    }

    public function edit($id){
        $models = JenisProgram::where('id',$id)->first();
        return view('pengawas.edit',compact('models'));
    }

     public function hapus($id){
         $user = JenisProgram::where('id',$id)->delete();
        return redirect()->back()->with('success', 'pengawas Delete successfully');
    }

    public function update(Request $request){
         $user = JenisProgram::where('id',$request->id)->first();
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
        $data = JenisProgram::select('kegiatan as text', 'id')
        ->whereNull('id_kegiatan')
        ->where('kegiatan', 'LIKE', "%$search%")
        ->get();
        
        return response()->json($data);
    }
}
