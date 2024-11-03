@extends('layouts.admin.home')
@section('title', 'List Pengawas')
@section('titelcard', 'List Pengawas')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Tabel Pengawas</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('masterpengawas.add') }}">
                                        <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Add Pengawas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th >No</th>
                                        <th >Foto Profile</th>
                                        <th >Kabupten</th>

                                        <th >Nama Pengawas</th>
                                        <th >NIP</th>
                                        <th >Jenjang Jabatan</th>
                                        <th >Pangkat</th>
                                        <th >Gol. Ruang</th>
                                        <th >No Whatsapp</th>
                                        <th >Alamat</th>
                                        <th >Sekolah Binaan</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
   $(function () {
    
    
   //   alert(3);
    var table = $('#data-table').DataTable({
     
        processing: true,
        serverSide: true,
        ajax: "{{ route('masterpengawas.getdata') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'foto', name: 'foto'},
            {data: 'kabupaten', name: 'kabupaten'},

            {data: 'name', name: 'name'},
            {data: 'nip', name: 'nip'},
            {data: 'jenjang_jabatan', name: 'jenjang_jabatan'},
            {data: 'pangkat', name: 'pangkat'},
            {data: 'gol_ruang', name: 'gol_ruang'},
            {data: 'no_telp', name: 'no_telp'},
            {data: 'alamat', name: 'alamat'},
            {data: 'binaan', name: 'binaan'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });


    
</script>
@endsection