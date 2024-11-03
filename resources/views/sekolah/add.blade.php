@extends('layouts.admin.home')
@section('title', 'Add  Sekolah')
@section('titelcard', 'Add  Sekolah')

@section ('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
          <div class="col-12">
              <div class="card mb-4">
                  <div class="card-header pb-0 p-3">
                      <div class="row">
                          <div class="col-6 d-flex align-items-center">
                              <h6 class="mb-0">Add  Sekolah</h6>
                          </div>
                     
                      </div>
                  </div>
                  <div class="card-body">
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

                     <form action="{{ route('sekolah.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                              <label for="name">Nama Sekolah</label>
                              <input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah" required>
                     </div>
               
                     <div class="form-group">
                        <label for="kode_area">NPSN</label>
                        <input type="number" class="form-control" name="npsn" id="npsn" placeholder="NPSN" required>
               </div>
                     
                       <div class="form-group">
                              <label for="no_telp">No Telpon</label>
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
                     
                     <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-save"></i>   Save
                        </button>
                    
                  </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
       @section('script')


       @endsection



