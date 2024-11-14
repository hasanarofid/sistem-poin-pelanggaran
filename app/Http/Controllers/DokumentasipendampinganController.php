<?php

namespace App\Http\Controllers;

use App\GuruM;
use App\Models\RencanaKerjaT;
use App\Models\UmpanbalikT;
use App\SekolahM;
use App\TanggapanUmpanbalikT;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DataTables;

class DokumentasipendampinganController extends Controller
{
    public function index(){
        $listPengawas = User::where('role','pengawas')->get();

        return view('dokumentasipendampingan.index',compact('listPengawas'));
    }

    public function getdata(Request $request){
        if ($request->ajax()) {

    
            $post = TanggapanUmpanbalikT::latest()->get();
       
               return Datatables::of($post)
                       ->addIndexColumn()
                       ->addColumn('tanggal', function($row){
                        return $row->created_at->format('d M Y h:i:s');
                    })
                    ->addColumn('foto', function($row){
                        if($row->foto == 'userdefault.jpg'){
                            $foto = asset('userdefault.jpg');
                        }else{
                            $foto = route('umpanbalikfoto', $row->foto);
                        }
                     return  '<div class="card card-profile"><img src="'.$foto.'" height="100px" alt="Image placeholder" class="card-img-top"></div>';
                    })
                    ->addColumn('program', function($row){
                        return !empty($row->umpanBalikT) ? $row->umpanBalikT->rencanakerja->nama_program_kerja : '-';
                    })
                    ->addColumn('pengawas', function($row){
                        return !empty($row->umpanBalikT) ? $row->umpanBalikT->pengawasnama->name : '-';
                    })

                
   
        

                       ->rawColumns(['tanggal','foto','program','pengawas'])
                       ->make(true);
           }
    }
}
