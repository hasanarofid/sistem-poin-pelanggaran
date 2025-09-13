@extends('layouts.admin.home')
@section('title', 'Input Poin')
@section('titelcard', 'Input Poin')
@section('content')
<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
  <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

    <!-- Header Title & Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Input Poin</h1>
      <div class="d-flex gap-2">
        <!-- <span class="badge rounded-pill bg-dark" style="padding: 10px 15px; font-size: 14px;">
          <i class="ti ti-cloud" style="margin-right: 6px;"></i> Auto-sync ke Spreadsheet
        </span>
        <a href="#"
          class="btn btn-success d-flex align-items-center"
          style="padding: 10px 15px; font-size: 14px;"
          data-bs-toggle="modal" data-bs-target="#modalTambahPelanggaran">
          <i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Input Poin
        </a> -->
      </div>
    </div>

    <!-- Form Card -->
    <div class="card">
      <div class="card-body">
        <form action="{{ request()->routeIs('admin.*') ? route('admin.input-poin.store') : route('guru.input-poin.store') }}"
          method="POST"
          id="formTambahInputPelanggaran">
          @csrf
          <div class="modal-body">
            <!-- Pilih Siswa -->
            <div class="mb-3">
              <label for="siswa_id" class="form-label">Pilih Siswa</label>
              <select id="siswa_id" name="siswa_id" class="form-select">
                <option value="">Pilih siswa...</option>
                @foreach($siswa as $value)
                <option value="{{$value->id}}">{{$value->nama}}</option>
                @endforeach
              </select>
            </div>

            <!-- Jenis Poin -->
            <div class="mb-3">
              <label for="jenis_pelanggaran_id" class="form-label">Jenis Poin</label>
              <select id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" class="form-select">
                <option value="">Jenis Poin...</option>
                @foreach($jenisPelanggaran as $value)
                <option value="{{ $value->id }}">
                  {{ $value->nama_pelanggaran }} ({{ $value->poin }} point)
                </option>
                @endforeach
              </select>
            </div>

            <!-- keterangan -->
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan..."></textarea>
            </div>

          </div>

          <!-- Footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" style="">Simpan</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

@endsection
@section('script')
<script>
  $(document).ready(function() {
    // Submit form tambah pelanggaran
    $('#siswa_id').val('');
    $('#jenis_pelanggaran_id').val('');
    $('#keterangan').val('');
    $('#formTambahInputPelanggaran').on('submit', function(e) {
      e.preventDefault();

      let form = $(this);
      let formData = form.serialize();
      let actionUrl = form.attr('action'); // <- otomatis ambil action form

      $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Data pelanggaran berhasil disimpan',
              showConfirmButton: false,
              timer: 2000
            }).then(() => {
              $('#siswa_id').val('');
              $('#jenis_pelanggaran_id').val('');
              $('#keterangan').val('');
              location.reload();
            });
          }
        },
        error: function(xhr) {
          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;
            let pesan = '';
            $.each(errors, function(key, value) {
              pesan += value[0] + "\n";
            });
            Swal.fire({
              icon: 'error',
              title: 'Validasi gagal',
              text: pesan
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: 'Terjadi kesalahan server'
            });
          }
        }
      });
    });


  });
</script>

@endsection