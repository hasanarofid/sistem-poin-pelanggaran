@extends('layouts.master')

@section('subjudul','Admin ')
@section('title','Pengawas')
@section('breadcrumbs')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">list Pengawas</a></li>
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


 <div class="container-fluid py-4">
       <div class="row">
        <div class="col-12">
          <div class="card mb-4">
          <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Tabel Pengawas </h6>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
     

                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a  class="btn btn-sm bg-primary text-white " href="{{  route('masterpengawas.add')  }}"><i class="fas fa-plus" aria-hidden="true"></i> Add </a>
                      <a  class="btn btn-sm bg-info text-white" href="{{  route('masterpengawas.import')  }}" >  <i class="fa fa-file-excel-o" aria-hidden="true"></i> Import</a>
                      <a class="btn btn-sm  bg-success text-white " target="_blank" href="{{  route('masterpengawas.excelcontoh')  }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Contoh</a>
                   </div>
                   


                    

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
              <div class="table-responsive p-0">
                <table class=" align-items-center mb-0 table-primary table-hover table-bordered" id="data-table">
                  <thead>
                    <tr>
                      <th class="text-sm font-weight mb-1 ">No</th>
                      <th class="text-sm font-weight mb-1 ">Foto Profile</th>
                      <th class="text-sm font-weight mb-1 ">Kabupten</th>

                      <th class="text-sm font-weight mb-1 ">Nama Pengawas</th>
                      <th class="text-sm font-weight mb-1 ">NIP</th>
                      <th class="text-sm font-weight mb-1 ">Jenjang Jabatan</th>
                      <th class="text-sm font-weight mb-1 ">Pangkat</th>
                      <th class="text-sm font-weight mb-1 ">Gol. Ruang</th>
                      <th class="text-sm font-weight mb-1">No Whatsapp</th>
                      <th class="text-sm font-weight mb-1">Alamat</th>
                      <th class="text-sm font-weight mb-1">Sekolah Binaan</th>
                      <th class="text-sm font-weight mb-1">Action</th>

                    </tr>
                  </thead>
                  <tbody>
           
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
 </div>
 @include('pengawas.modal')
@endsection
       @section('js')
       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

       <script >
 // resources/js/app.js
function setSekolahBinaan(id){
  // alert(id);
  jQuery('#exampleModal').modal('show');
}

   jQuery(function () {
    
    
       jQuery.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
    });
   //   alert(3);
    var table = jQuery('#data-table').DataTable({
     
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

  jQuery(document).ready(function() {
    jQuery('.select2').select2();
    let rowCount = 0;

    // Function to add a new row to the table
    function addRow() {
      rowCount++;
      // jQuery('#tableBody').append(`<tr><td>${rowCount}</td><td>New Row ${rowCount}</td><td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td></tr>`);
    }

    // Initial row
    addRow();

    // Add row button click event
    jQuery('#addRowBtn').click(function() {
      addRow();
    });

    // Delete row button click event (event delegation for dynamically added buttons)
    jQuery('#tableBody').on('click', '.delete-row', function() {
      jQuery(this).closest('tr').remove();
    });
  });
  </script>
       @endsection

