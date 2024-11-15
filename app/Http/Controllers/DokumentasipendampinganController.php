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
use Illuminate\Support\Facades\File;

class DokumentasipendampinganController extends Controller
{
    public function index(){
        $listPengawas = User::where('role','pengawas')->get();

        return view('dokumentasipendampingan.index',compact('listPengawas'));
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
                ->addColumn('tanggal', function($row){
                    return $row->created_at->format('d M Y');
                })
                ->addColumn('foto', function($row){
                   

                    if ($row->foto == 'userdefault.jpg') {
                        $fotoPath = public_path('userdefault.jpg'); // Adjust this path if necessary
                    } else {
                        $fotoPath = storage_path('app/public/umpanbalik/' . $row->foto);
                    }
            
                    if (File::exists($fotoPath)) {
                        $fotoData = base64_encode(File::get($fotoPath));
                        $fotoType = File::mimeType($fotoPath);
                        return '<img src="data:' . $fotoType . ';base64,' . $fotoData . '"  height="100px" alt="Image" class="card-img-top">';
                    } else {
                        return '<img src="' . asset('userdefault.jpg') . '" height="100px" alt="Default Image" class="card-img-top">';
                    }
                })
                ->addColumn('foto2', function($row){
                    if ($row->foto == 'userdefault.jpg') {
                        $fotoPath = public_path('userdefault.jpg');
                    } else {
                        $fotoPath = storage_path('app/public/umpanbalik/' . $row->foto);
                    }
                
                    if (File::exists($fotoPath)) {
                        $fotoData = base64_encode(File::get($fotoPath));
                        $fotoType = File::mimeType($fotoPath);
                        return 'data:' . $fotoType . ';base64,' . $fotoData;
                    } else {
                        return ''; // Kembalikan string kosong jika tidak ada foto
                    }
                })
                ->addColumn('program', function($row){
                    return !empty($row->umpanBalikT) ? $row->umpanBalikT->rencanakerja->nama_program_kerja : '-';
                })
                ->addColumn('pengawas', function($row){
                    return !empty($row->umpanBalikT) ? $row->umpanBalikT->pengawasnama->name : '-';
                })
                ->addColumn('nama_sekolah', function($row) {
                    $cariguru = GuruM::findOrFail($row->umpanBalikT->id_user);
                    $sekolahs = SekolahM::findOrFail($cariguru->sekolah_id);
                    return $sekolahs->nama_sekolah;
                })
                ->rawColumns(['tanggal', 'foto', 'program', 'pengawas', 'nama_sekolah','foto2'])
                ->make(true);
           }
    }
}
