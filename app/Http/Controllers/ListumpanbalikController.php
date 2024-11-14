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
                        return $user->nip.' - '.$user->name;
                    })
                    ->addColumn('kepala_sekolah', function($row){
                        $cariguru = GuruM::findorFail($row->id_user);
                        return $cariguru->nama;
                    })
                    ->addColumn('sasaran', function($row){
                        $rencana = RencanaKerjaT::find($row->id_pelaporan);
                        return !empty($rencana) ? $rencana->nama_program_kerja : '-';
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
                        $cariguru = GuruM::findorFail($row->id_user);
                        $sekolahs = SekolahM::findorFail($cariguru->sekolah_id);
                        return $sekolahs->nama_sekolah;
                    })
   
               ->addColumn('action', function($row){

                // Check if the response has been given
    $tanggapan = TanggapanUmpanbalikT::where('id_umpanbalik', $row->id)->first();
    $fullUrl = url('umpan-balik-view/' . $row->generate_url);

    // If 'Belum diberi tanggapan', disable the button
    if (!$tanggapan) {
        $btn = '<a href="#" class="btn btn-sm bg-warning text-white disabled" style="pointer-events: none;" > <i class="fa fa-eye"></i> Belum diberi tanggapan</a>';
    } else {
        $btn = '<a target="_blank" href="'.$fullUrl.'" class="btn btn-sm bg-primary text-white" > <i class="fa fa-eye"></i> View</a>';
    }
    return $btn;
                       })

                       ->rawColumns(['action','sasaran','kepala_sekolah','nama_sekolah','tanggal','pengawas','tanggapan'])
                       ->make(true);
           }
    }

}
