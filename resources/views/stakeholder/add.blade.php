@extends('layouts.master')
@section('title','Stakeholder')
@section('subjudul','add Stakeholder')
@section('breadcrumbs')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">add Stakeholder</a></li>
<style>
#data-table_info{
   font-size: 12px;
}
#data-table_paginate{
   font-size: 12px;
}
#data-table tbody tr {
    font-size: 12px; /* Adjust the font size to your desired value */
}

</style>
@endsection
@section ('content')
 <div class="container-fluid py-2">
 

       <div class="row">
         <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                     <div class="row">
                     <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Form Add Stakeholder </h6>
                     </div>
                     
                     </div>
                  </div>
               <div class="card-body ">
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    {{ Session::forget('success') }}
@endif
              
               @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                     <form action="{{ route('stakeholder.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                              <label for="name">Nama Stakeholder</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Nama Stakeholder" required>
                     </div>

                     
                     <div class="form-group">
                        <label for="kabupaten_id">Wilayah Kabupaten </label>
                        <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                           <option value="">.: Pilih Wilayah :. </option>
                           @foreach ($wilayah as $item)
                              <option value="{{  $item->id }}">{{  $item->nama_kabupaten }}</option>
                           @endforeach
                            </select>
                     </div>
                     <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP">
                     </div>
                     <div class="form-group">
                        <label for="name">Jenjang Jabatan </label>
                        <select name="jenjang_jabatan" id="jenjang_jabatan" class="form-control" required>
                           <option value="">.: Pilih Jenjang Jabatan :. </option>
                           <option value="Pengawas Sekolah Utama"> Pengawas Sekolah Utama </option>
                           <option value="Pengawas Sekolah Ahli Madya"> Pengawas Sekolah Ahli Madya </option>
                           <option value="Pengawas Sekolah Ahli Muda"> Pengawas Sekolah Ahli Muda </option>
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="pangkat">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat" id="pangkat" placeholder="Pangkat">
                     </div>

                     <div class="form-group">
                        <label for="gol_ruang">Gol. Ruang</label>
                        <input type="text" class="form-control" name="gol_ruang" id="gol_ruang" placeholder="Gol. Ruang">
                     </div>
                     
                     <div class="form-group">
                              <label for="no_telp">No WA</label>
                              <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp/Wa" required> 
                     </div>



                         <div class="form-group">
                              <label for="alamat_lengkap">Alamat</label>
                              <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" cols="10" rows="5" required></textarea>
                     </div>
                      <div class="form-group">
                              <label for="kota">Kota</label>
                              <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota">
                     </div>
                     <div class="form-group">
                              <label for="kode_area">Kode Area</label>
                              <input type="number" class="form-control" name="kode_area" id="kode_area" placeholder="Kode Area">
                     </div>
                     <hr>
                     <p>Info Login</p>
                    <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                     </div>

                       <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" name="password"  id="password" placeholder="Password" required>
                           </div>

                                                  <div class="form-group">
                              <label for="repeatpassword">Ulangi Password</label>
                              <input type="password" class="form-control" name="repeatpassword"  id="repeatpassword" placeholder="Ulangi Password" required>
                           </div>



                     <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-save"></i>   Save
                        </button>
                    
                  </form>
               </div>
            </div>
         </div>
      </div>
 </div>
@endsection
       @section('js')

       @endsection

