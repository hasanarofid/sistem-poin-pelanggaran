@extends('layouts.admin.home')
@section('title', 'List Dokumentasi Pendampingan')
@section('titelcard', 'List Dokumentasi Pendampingan')
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
              <h5 class="m-0 me-2">Tabel Dokumentasi Pendampingan</h5>
            </div>

          
          </div>
          <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
  
              
              <div class="app-card-body px-4 w-100">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped" id="dataTable">
                          <thead>
                              <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Foto Bukti Pendampingan</th> 
                                <th>Program Kerja</th>
                                <th>Pengawas</th>
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
@endsection


@section('script')


<script>
  $(document).ready(function () {

    var table = $('#dataTable').DataTable({
     
        processing: true,
        serverSide: true,
        ajax: "{{ route('dokumentasipendampingan.getdata') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'foto', name: 'foto'},
            {data: 'program', name: 'program'},
            {data: 'pengawas', name: 'pengawas'},
        ]
    });
  });


  
</script>

@endsection
