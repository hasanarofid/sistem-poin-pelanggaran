@extends('layouts.admin.home')
@section('title', 'Input Pelanggaran')
@section('titelcard', 'Input Pelanggaran')
@section('content')
<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
  <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

    <!-- Header Title & Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Input Pelanggaran</h1>
      <div class="d-flex gap-2">
        <span class="badge rounded-pill bg-dark" style="padding: 10px 15px; font-size: 14px;">
          <i class="ti ti-cloud" style="margin-right: 6px;"></i> Auto-sync ke Spreadsheet
        </span>
        <a href="#"
          class="btn btn-success d-flex align-items-center"
          style="padding: 10px 15px; font-size: 14px;"
          data-bs-toggle="modal" data-bs-target="#modalTambahPelanggaran">
          <i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Input Pelanggaran
        </a>
      </div>
    </div>

    <!-- Form Card -->
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Siswa</th>
                <th style="width: 20%;">Jenis Pelanggaran</th>
                <th style="width: 20%;">Keterangan</th>
                <th style="width: 10%;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($inputPelanggaranT as $index => $value)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->siswa->nama }}</td>
                <td>{{ $value->jenispelanggaran->nama_pelanggaran }}</td>
                <td>{{ $value->keterangan ?? '-' }}</td>
                <td>
                  <div class="d-flex gap-2">
                    <!-- <a href="#" class="btn btn-sm btn-warning">
                                            <i class="ti ti-edit"></i>
                                        </a> -->
                    <form action="{{ route('admin.input-pelanggaran.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">
                        <i class="ti ti-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">Belum ada data pelanggaran.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="modalTambahPelanggaran" tabindex="-1" aria-labelledby="modalTambahPelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTambahPelanggaranLabel">Tambah Input Pelanggaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form action="{{ route('admin.input-pelanggaran.store') }}" method="POST" id="formTambahInputPelanggaran">
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

                    <!-- Jenis Pelanggaran -->
                    <div class="mb-3">
                        <label for="jenis_pelanggaran_id" class="form-label">Jenis Pelanggaran</label>
                        <select id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" class="form-select">
                            <option value="">Jenis Pelanggaran...</option>
                            @foreach($jenisPelanggaran as $value)
                            <option value="{{$value->id}}">{{$value->nama_pelanggaran}}</option>
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
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Submit form tambah pelanggaran
        $('#formTambahInputPelanggaran').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.input-pelanggaran.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#modalTambahPelanggaran').modal('hide');
                        $('#formTambahPelanggaran')[0].reset();
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let pesan = '';
                        $.each(errors, function(key, value) {
                            pesan += value[0] + "\n";
                        });
                        alert(pesan); // bisa diganti pakai toast/alert Bootstrap
                    } else {
                        alert("Gagal menyimpan data!");
                    }
                }
            });
        });

    });
</script>

@endsection