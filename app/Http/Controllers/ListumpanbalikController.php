<?php

namespace App\Http\Controllers;

use App\Models\RencanaKerjaT;
use App\Models\UmpanbalikT;
use App\SekolahM;
use App\TanggapanUmpanbalikT;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DataTables;
class ListumpanbalikController extends Controller
{
    public function index(){
        $listPengawas = User::where('role','pengawas')->get();

        return view('listumpanbalik.index',compact('listPengawas'));
    }

    public function getdata(Request $request){
        if ($request->ajax()) {

    
            $post = UmpanbalikT::latest()->get();
       
               return Datatables::of($post)
                       ->addIndexColumn()
                       ->addColumn('tanggal', function($row){
                        return $row->created_at->format('d M Y h:i:s');
                    })
                    ->addColumn('pengawas', function($row){
                        $user = User::where('id',$row->id_pengawas)->first();
                        // dd($row->id_user);
                        return $user->nip.' - '.$user->name;
                    })
                    ->addColumn('sasaran', function($row){
                        $rencana = RencanaKerjaT::find($row->id_pelaporan);
                        return $rencana->aspekprogram->nama;
                    })
                    ->addColumn('tanggapan', function($row){
                        $tanggapan = TanggapanUmpanbalikT::where('id_umpanbalik',$row->id)->first();
                        if($tanggapan){
                            $btn = '<span class="badge bg-label-success m-1" > Sudah diberi tanggapan </span>';
                        }else{
                            $btn = '<span class="badge bg-label-danger m-1" > Belum diberi tanggapan </span>';
                        }
                        return $btn;

                    })
                    ->addColumn('nama_sekolah', function($row) {
                        $rencana = RencanaKerjaT::find($row->id_pelaporan);
                        $sekolahIds = explode(',', $rencana->sekolah_id);
                        $sekolahs = SekolahM::whereIn('id', $sekolahIds)->get();
            
                        $nama_sekolah = '';
                        foreach ($sekolahs as $sekolah) {
                            $nama_sekolah .= '<span class="badge bg-label-primary m-1" data-sekolah2="' . $sekolah->nama_sekolah . '">' . $sekolah->nama_sekolah . '</span> ';
                        }
                        return $nama_sekolah;
                    })
   
               ->addColumn('action', function($row){
                $fullUrl = url('umpan-balik-view/' . $row->generate_url);
      
                              $btn = '<a target="_blanck" href="'.$fullUrl.'"   class="btn btn-sm bg-warning text-white " > <i class="fa fa-view"></i> view</a>';
                           
                               return $btn;
                       })
                       ->rawColumns(['action','sasaran','tanggal','pengawas','nama_sekolah','tanggapan'])
                       ->make(true);
           }
    }

}
