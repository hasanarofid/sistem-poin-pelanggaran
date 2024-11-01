<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RencanaKerjaT;
use App\Kabupaten;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\SekolahM;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Auth;

class RencanaTugasController extends Controller
{
    //index
    public function index(){
        return view('rencanakerja.index');
    }

    public function getdata(Request $request){
        if ($request->ajax()) {
            $post = RencanaKerjaT::with('kategoriprogram', 'jenisprogram', 'aspekprogram', 'pengawasnama')->latest()->get();
            
            return Datatables::of($post)
                ->addIndexColumn()
                ->addColumn('pengawas', function($row){
                    return $row->pengawasnama->nip . ' - ' . $row->pengawasnama->name;
                })
                ->addColumn('tanggal', function($row){
                    return $row->created_at->format('d M Y h:i:s');
                })
                ->addColumn('nama_kategori', function($row){
                    return $row->kategoriprogram->nama;
                })
                ->addColumn('nama_jenis', function($row){
                    return !empty($row->jenisprogram->nama) ? $row->jenisprogram->nama : '-';
                })
                ->addColumn('nama_aspek', function($row){
                    return !empty($row->aspekprogram->nama) ? $row->aspekprogram->nama : '-';
                })
                ->addColumn('bulan_tahun', function($row){
                    return $row->bulan . ' - ' . $row->tahun_ajaran;
                })
                ->addColumn('nama_sekolah', function($row) {
                    $sekolahIds = explode(',', $row->sekolah_id);
                    $sekolahs = SekolahM::whereIn('id', $sekolahIds)->get();
    
                    $nama_sekolah = '';
                    foreach ($sekolahs as $sekolah) {
                        $nama_sekolah .= '<span class="badge bg-label-primary m-1" data-sekolah2="' . $sekolah->nama_sekolah . '">' . $sekolah->nama_sekolah . '</span> ';
                    }
    
                    return $nama_sekolah;
                })
                // This column will be used for PDF export
                ->addColumn('nama_sekolah2', function($row) {
                    $sekolahIds = explode(',', $row->sekolah_id);
                    $sekolahs = SekolahM::whereIn('id', $sekolahIds)->get();
    
                    // Use a simple string to join school names
                    $nama_sekolah = [];
                    foreach ($sekolahs as $sekolah) {
                        $nama_sekolah[] = $sekolah->nama_sekolah; // Collect names in an array
                    }
    
                    return implode(', ', $nama_sekolah); 
                })
                ->addColumn('status', function($row){
                    if($row->status == 1){
                        $status = '<span class="badge bg-label-success m-1" >Sudah Kirim WA Blast</span>';
                    }else{
                        $status = '<span class="badge bg-label-danger m-1" >Belum Kirim WA Blast</span>';
                    }
                        return $status;
                })
                ->addColumn('action', function($row){

                    $btn = '<a  onclick="KirimWaBlast('.$row->id.')" class="btn btn-sm bg-success text-white " > <i class="fa fa-envelope"></i> Kirim Wa</a>';
                 
                     return $btn;
             })

                ->rawColumns(['pengawas', 'nama_kategori', 'nama_jenis', 'nama_aspek', 'nama_sekolah','nama_sekolah2','status','action'])
                ->make(true);
        }
    
      
        return view('rencanakerja.index');
    }

}
