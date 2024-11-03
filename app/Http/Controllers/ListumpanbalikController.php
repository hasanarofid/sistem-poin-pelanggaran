<?php

namespace App\Http\Controllers;

use App\Models\RencanaKerjaT;
use App\Models\UmpanbalikT;
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
   
               ->addColumn('action', function($row){
                $fullUrl = url('umpan-balik-view/' . $row->generate_url);
      
                              $btn = '<a target="_blanck" href="'.$fullUrl.'"   class="btn btn-sm bg-warning text-white " > <i class="fa fa-view"></i> view</a>';
                           
                               return $btn;
                       })
                       ->rawColumns(['action','sasaran','tanggal','pengawas'])
                       ->make(true);
           }
    }

}
