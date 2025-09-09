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
                    <i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Jenis Pelanggaran
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <!-- Pilih Siswa -->
                        <div class="col-md-6">
                            <label for="siswa_id" class="form-label">Pilih Siswa</label>
                            <select id="siswa_id" name="siswa_id" class="form-select">
                                <option value="">Pilih siswa...</option>

                            </select>
                        </div>
                        <!-- Jenis Pelanggaran -->
                        <div class="col-md-6">
                            <label for="pelanggaran_id" class="form-label">Jenis Pelanggaran</label>
                            <select id="pelanggaran_id" name="pelanggaran_id" class="form-select">
                                <option value="">Pilih pelanggaran...</option>

                            </select>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" rows="4" placeholder="Deskripsi detail pelanggaran..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-danger d-flex align-items-center">
                            <i class="ti ti-device-floppy" style="margin-right: 6px;"></i> Simpan Pelanggaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTambahPelanggaran" tabindex="-1" aria-labelledby="modalTambahPelanggaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="modalTambahPelanggaranLabel">Tambah Jenis Pelanggaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <form action="" method="POST">
        @csrf
        <div class="modal-body">
          
          <!-- Nama Pelanggaran -->
          <div class="mb-3">
            <label for="nama_pelanggaran" class="form-label">Nama Pelanggaran</label>
            <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" placeholder="Contoh: Tidak memakai topi">
          </div>

          <!-- Kategori -->
          <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select id="kategori_id" name="kategori_id" class="form-select">
              <option value="">Pilih kategori...</option>
              
            </select>
          </div>

          <!-- Poin -->
          <div class="mb-3">
            <label for="poin" class="form-label">Poin Pelanggaran</label>
            <input type="number" class="form-control" id="poin" name="poin" min="1" max="50" placeholder="Masukkan poin (1-50)">
          </div>

          <!-- Deskripsi -->
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail pelanggaran..."></textarea>
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