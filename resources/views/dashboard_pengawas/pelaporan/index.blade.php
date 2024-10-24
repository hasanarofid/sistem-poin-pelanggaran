@extends('layouts.pengawas.home')
@section('title','Login')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      @if(Session::has('success'))
      <div class="alert alert-success">
          {{ Session::get('success') }}
      </div>
      {{ Session::forget('success') }}
  @endif
    <div class="col-12 col-lg-12 ">
      <!-- About User -->
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Tabel Pelaporan</h5>
              <small class="text-muted">Pengawas : {{ Auth::user()->name}}</small>
            </div>
            <a  class="btn btn-sm bg-primary text-white " data-bs-toggle="modal" data-bs-target="#editUser"><i class="fas fa-plus" aria-hidden="true"></i> Tambah </a>
          
          </div>
          <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
  
              
              <div class="app-card-body px-4 w-100">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped" id="dataTable">
                          <thead>
                              <tr>
                                <th>No</th>
                                <th>Sasaran</th>
                                <th>Judul Laporan</th>
                                <th>Kategori</th>
                                <th>Tanggal Dibuat</th>
                                <th>#</th>
                            </tr>
                          </thead>
                      </table>
                      <br>
                      
                  </div>
                  <br>
              </div>
          </div>
      </div>
      <!--/ About User -->

      <!--/ Profile Overview -->
  </div>
</div>



    

    <div class="content-backdrop fade"></div>
  </div>
  @include('dashboard_pengawas.pelaporan.modal')
@endsection
@include('dashboard_pengawas.pelaporan.js')
