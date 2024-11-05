@extends('layouts.admin.home')
@section('title', 'List Kategori Program')
@section('titelcard', 'List Kategori Program')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Tabel Kategori Program</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.add') }}">
                                        <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Kategori Program
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
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th class="text-sm font-weight mb-1">No</th>
                                        <th class="text-sm font-weight mb-1">Nama</th>
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
    jQuery(document).ready(function() {
        // Setup CSRF Token for AJAX
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize DataTable
        var table = jQuery('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('mastertupoksi.getdata') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Modal event (optional)
        jQuery('#myModal').on('show.bs.modal', function(event) {
            alert(1); // This can be customized as needed
        });
    });
</script>
@endsection