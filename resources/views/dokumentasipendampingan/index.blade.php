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

      <div class="col-12 col-lg-12">
        <div class="card h-100">
          <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Tabel Dokumentasi Pendampingan</h5>
            </div>
          </div>
          <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
            <div class="app-card-body px-4 w-100">
              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="filter-pengawas">Filter by Pengawas:</label>
                  <select id="filter-pengawas" name="pengawas" class="select2 form-select" required>
                    <option value="all">All</option>
                    @foreach ($listPengawas as $item)
                      <option value="{{ $item->id }}">{{ $item->name.' - '.$item->nip }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal pendampingan</th>
                      <th>Foto Bukti Pendampingan</th>
                      <th>Foto Bukti Pendampingan</th>
                      <th>Sekolah</th>
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
      </div>
    </div>
    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function () {
    $('#filter-pengawas').select2();
    $('#filter-pengawas').change(function () {
        $('#dataTable').DataTable().ajax.reload();
    });

    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('dokumentasipendampingan.getdata') }}",
          data: function(d) {
            d.pengawas = $('#filter-pengawas').val();
          }
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'tanggal', name: 'tanggal'},
          // Kolom foto disembunyikan di DataTable, tapi tetap digunakan untuk ekspor PDF
          {data: 'foto', name: 'foto', visible: true}, 
          {data: 'foto2', name: 'foto2', visible: false}, 
          {data: 'nama_sekolah', name: 'nama_sekolah'},
          {data: 'program', name: 'program'},
          {data: 'pengawas', name: 'pengawas'},
        ],
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'pdfHtml5',
            text: '<i class="fas fa-file-pdf"></i> Export PDF',
            className: 'btn btn-danger',
            title: 'List Dokumentasi Pendampingan',
            orientation: 'landscape',
            pageSize: 'A4',
            exportOptions: {
              columns: [0, 1, 3, 4, 5,6] // Sertakan kolom foto2 meskipun tersembunyi
            },
            customize: function (doc) {
              // Customizing columns
              doc.content[1].table.widths = ['10%', '20%', '20%', '20%', '15%', '15%'];

              // Customizing the rows to include images in Base64
              const tableBody = doc.content[1].table.body;

              // Iterate through table rows (excluding the header row)
              for (let i = 1; i < tableBody.length; i++) {
                const fotoBase64 = tableBody[i][2].text;  // Foto disembunyikan di kolom foto3
                tableBody[i][2] = {
                  image: fotoBase64,
                  width: 50,    // Adjust width as needed
                  height: 50,   // Adjust height as needed
                };
              }
            }
          }
        ]
      });
  });
</script>
@endsection
