<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AspekProgram;
use App\Kabupaten;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Auth;

class AspekprogramController extends Controller
{
      //index
    public function index(){
        return view('aspekprogram.index');
    }

    public function getdata(Request $request){
        if ($request->ajax()) {
          
                $post = AspekProgram::get();
    
            // dd($post);
            return Datatables::of($post)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if($row->status == 1){
                    $status = '<span class="badge bg-label-success m-1" >Active</span>';
                }else{
                    $status = '<span class="badge bg-label-danger m-1" >InActive</span>';
                }
                    return $status;
            })
                    ->addColumn('action', function($row){
                        $user = Auth::user();
                        if ($user && $user->role == 'Super Admin') {
                            $btn = '<a href="'.route('aspekprogram.edit',$row->id).'" data-toggle="tooltip"  class="edit btn btn-primary btn-sm editPost">Edit</a>';
                           $btn = $btn.' <a href="'.route('aspekprogram.hapus',$row->id).'" data-toggle="tooltip" data-toggle="modal" data-target="#confirmDeleteModal"    data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';
    
                            return $btn;
                        } else {
                            return ''; // Tidak menampilkan tombol aksi jika bukan Super Admin
                        }
                          
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        return view('aspekprogram.index');
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
       
         return view('aspekprogram.add');
    }

     /** add data pengawas */
    public function import(){
        return view('pengawas.import');
    }

    /** save data pengawas */
    public function store(Request $request){
        // dd($request->post());die;
  
            $model = new AspekProgram();
            $model->nama = $request->nama;
            $model->status = $request->status;

            $model->save();

        
            return redirect()->route('aspekprogram.index')->with('success', 'Aspek Program created successfully');
    }

    public function edit($id){
        $models = AspekProgram::where('id',$id)->first();
        return view('aspekprogram.edit',compact('models'));
    }

     public function hapus($id){
         $user = AspekProgram::where('id',$id)->delete();
        return redirect()->back()->with('success', 'pengawas Delete successfully');
    }

    public function update(Request $request){
         $model = AspekProgram::where('id',$request->id)->first();
         $model->nama = $request->nama;
         $model->status = $request->status;
             $model->save();

        return redirect()->route('aspekprogram.index',$request->id)->with('success', 'pengawas update successfully');
    }

    public function getkegiatan(Request $request)
    {
        $search = $request->term;
        $data = AspekProgram::select('kegiatan as text', 'id')
        ->whereNull('id_kegiatan')
        ->where('kegiatan', 'LIKE', "%$search%")
        ->get();
        
        return response()->json($data);
    }

}
