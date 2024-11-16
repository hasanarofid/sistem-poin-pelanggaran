@extends('layouts.admin.home')
@section('title', 'List Aspek Report Pendidikan')
@section('titelcard', 'List Aspek Report Pendidikan')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Tabel Aspek Report Pendidikan</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                @if (Auth::user()->role == 'Super Admin')
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('aspekprogram.add') }}">
                                        <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Add Aspek Report Pendidikan
                                    </a>
                                </div>
                                @endif
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
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th class="text-sm font-weight mb-1">No</th>
                                        <th class="text-sm font-weight mb-1">Nama</th>
                                        <th class="text-sm font-weight mb-1">Status</th>
                                        <th class="text-sm font-weight mb-1">Action</th>
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
        $(document).ready(function () {
      
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('aspekprogram.getdata') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    
</script>
@endsection