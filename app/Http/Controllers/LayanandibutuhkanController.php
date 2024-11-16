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

class LayanandibutuhkanController extends Controller
{
    public function index(){
        $listPengawas = User::where('role','pengawas')->get();

        return view('layanandibutuhkan.index',compact('listPengawas'));
    }

    public function indexpengawas(){
        $listPengawas = User::where('role','pengawas')->get();

        return view('dashboard_pengawas.umpanbalik.layanan',compact('listPengawas'));
    }

    public function getdata(Request $request){
        if ($request->ajax()) {

    
            $pengawas = $request->input('pengawas', 'all');

            $post = TanggapanUmpanbalikT::with('umpanBalikT')->latest();
          
            $post->whereHas('umpanBalikT', function ($q) use ($pengawas) {
                if ($pengawas !== 'all') {
                    $q->where('id_pengawas', $pengawas);
                }
            });
       
               return Datatables::of($post->get())
                       ->addIndexColumn()
               
                    ->addColumn('nama_sekolah', function($row) {
                        $cariguru = GuruM::findorFail($row->umpanBalikT->id_user);
                        $sekolahs = SekolahM::findorFail($cariguru->sekolah_id);
                        return $sekolahs->nama_sekolah;
                    })
   
                    ->addColumn('layanan', function($row){
                        return !empty($row->jawaban_11) ? $row->jawaban_11 : '-';
                    })

                
   
        

                       ->rawColumns(['nama_sekolah','layanan'])
                       ->make(true);
           }
    }

    public function getdatapengawas(Request $request){
        if ($request->ajax()) {

    
            $pengawas = $request->input('pengawas', 'all');

            $post = TanggapanUmpanbalikT::with('umpanBalikT')
            ->whereHas('umpanBalikT', function ($query) {
                $query->where('id_pengawas', Auth::user()->id);
            })
            ->latest();
          
            $post->whereHas('umpanBalikT', function ($q) use ($pengawas) {
                if ($pengawas !== 'all') {
                    $q->where('id_pengawas', $pengawas);
                }
            });
       
               return Datatables::of($post->get())
                       ->addIndexColumn()
               
                    ->addColumn('nama_sekolah', function($row) {
                        $cariguru = GuruM::findorFail($row->umpanBalikT->id_user);
                        $sekolahs = SekolahM::findorFail($cariguru->sekolah_id);
                        return $sekolahs->nama_sekolah;
                    })
   
                    ->addColumn('layanan', function($row){
                        return !empty($row->jawaban_11) ? $row->jawaban_11 : '-';
                    })

                
   
        

                       ->rawColumns(['nama_sekolah','layanan'])
                       ->make(true);
           }
    }
}
