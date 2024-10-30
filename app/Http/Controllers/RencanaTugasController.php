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
          
                $post = RencanaKerjaT::with('kategoriprogram','jenisprogram','aspekprogram','pengawasnama')->latest()->get();
            // dd($post);
            return Datatables::of($post)
            ->addIndexColumn()

            ->addColumn('pengawas', function($row){
                return $row->pengawasnama->nip.' - '.$row->pengawasnama->name;
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
                return $row->bulan .' - '. $row->tahun_ajaran;
            })

             ->addColumn('nama_sekolah', function($row){
                $sekolahIds = explode(',', $row->sekolah_id);
                $sekolahs = SekolahM::whereIn('id', $sekolahIds)->get();
                
                $nama_sekolah = '';
                foreach ($sekolahs as $sekolah) {
                    $nama_sekolah .= '<span class="badge bg-label-primary m-1">' . $sekolah->nama_sekolah . '</span> '; // Added a space for separation
                }
                // dd($nama_sekolah);
                
                return $nama_sekolah;
            })
            ->rawColumns(['pengawas',
            'nama_kategori',
            'nama_jenis',
            'nama_aspek',
            'nama_sekolah',
            'bulan_tahun'])
            ->make(true);
        }
        return view('rencanakerja.index');
    }

}
