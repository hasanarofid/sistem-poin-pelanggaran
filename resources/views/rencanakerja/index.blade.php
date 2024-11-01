@extends('layouts.admin.home')
@section('title', 'List Rencana Kerja')
@section('titelcard', 'List Rencana Kerja')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Tabel Rencana Kerja</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    {{-- <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.add') }}">
                                        <i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Rencana Kerja
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pengawas</th>
                                        <th>Bulan - Tahun</th>
                                        <th>Nama Program Kerja</th>
                                        <th>Kategori</th>
                                        <th>Jenis Program</th>
                                        <th>Aspek Raport Pendidikan</th>
                                        <th>Sekolah Sasaran</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
        var isExporting = false;
    
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('rencanatugas.getdata') }}",
                data: function (d) {
                    // Disable pagination when exporting
                    if (isExporting) {
                        d.length = -1; // Loads all data
                    }
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'pengawas', name: 'pengawas'},
                {data: 'bulan_tahun', name: 'bulan_tahun'},
                {data: 'nama_program_kerja', name: 'nama_program_kerja'},
                {data: 'nama_kategori', name: 'nama_kategori'},
                {data: 'nama_jenis', name: 'nama_jenis'},
                {data: 'nama_aspek', name: 'nama_aspek'},
                {data: 'nama_sekolah', name: 'nama_sekolah'}, // For display
                {data: 'tanggal', name: 'tanggal'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            dom: 'Bfrtip', // Enables the buttons at the top of the DataTable
            buttons: [
                {
                    extend: 'pdfHtml5',
                    title: 'List Rencana Kerja',
                    text: '<i class="fas fa-file-pdf"></i> Export PDF',
                    className: 'btn btn-danger',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':visible', // Export only visible columns
                        format: {
                            body: function (data, row, column, node) {
                                if (column === 7) { // Adjust index based on your columns
                                    // Collect all data-sekolah2 attributes
                                    let sekolahData = [];
                                    $(node).find('span').each(function() {
                                        // Push each data-sekolah2 into the array
                                        sekolahData.push($(this).data('sekolah2'));
                                    });
                                    // Join them into a single string
                                    return sekolahData.join(', ') || data; // Fallback to data if not found
                                }
                                return data; // Return data as is for other columns
                            }
                        }
                    },
                    customize: function (doc) {
                        doc.styles.tableHeader.alignment = 'left';
                    }
                }
            ]
        });
    });
    </script>
            
    
@endsection
