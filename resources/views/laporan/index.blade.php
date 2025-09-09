@extends('layouts.admin.home')
@section('title', 'Laporan Pelanggaran')
@section('titelcard', 'Laporan Pelanggaran')
@section('content')
<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
    <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

        <!-- Header Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Laporan Pelanggaran</h1>
        </div>

        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="dariTanggal" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="dariTanggal" name="dari_tanggal">
                    </div>
                    <div class="col-md-4">
                        <label for="sampaiTanggal" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="sampaiTanggal" name="sampai_tanggal">
                    </div>
                    <div class="col-md-4">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select id="kelas" class="form-select" name="kelas">
                            <option selected>Semua Kelas</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="col-md-12 d-flex align-items-center justify-content-end gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary">
                            <i class="menu-icon tf-icons ti ti-search"></i> Filter
                        </button>
                        <button type="button" class="btn btn-purple" style="background:#8b5cf6; color:#fff;"
                            data-bs-toggle="modal" data-bs-target="#syncModal">
                            <i class="menu-icon tf-icons ti ti-upload"></i> Sync ke Sheets
                        </button>
                        <button type="button" class="btn btn-success">
                            <i class="menu-icon tf-icons ti ti-printer"></i> Print
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>TANGGAL</th>
                            <th>SISWA</th>
                            <th>KELAS</th>
                            <th>PELANGGARAN</th>
                            <th>POIN</th>
                            <th>PELAPOR</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15/11/2024</td>
                            <td>Ahmad Rizki</td>
                            <td>XII RPL 1</td>
                            <td>Terlambat masuk kelas</td>
                            <td class="text-danger fw-bold">5</td>
                            <td>Wali Kelas XII RPL 1</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="menu-icon tf-icons ti ti-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="menu-icon tf-icons ti ti-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>12/11/2024</td>
                            <td>Siti Nurhaliza</td>
                            <td>XI BD 2</td>
                            <td>Mengganggu teman</td>
                            <td class="text-danger fw-bold">15</td>
                            <td>Wali Kelas XI BD 2</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="menu-icon tf-icons ti ti-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="menu-icon tf-icons ti ti-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>10/11/2024</td>
                            <td>Ahmad Rizki</td>
                            <td>XII RPL 1</td>
                            <td>Tidak mengerjakan tugas</td>
                            <td class="text-danger fw-bold">10</td>
                            <td>Wali Kelas XII RPL 1</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="menu-icon tf-icons ti ti-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="menu-icon tf-icons ti ti-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="syncModal" tabindex="-1" aria-labelledby="syncModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-body text-center p-4">

                <div class="mb-3">
                    <i class="bx bx-cloud-upload" style="font-size: 50px; color: #8b5cf6;"></i>
                </div>

                <h4 class="fw-bold mb-3" id="syncModalLabel">Sinkronisasi Laporan</h4>
                <p class="mb-3">
                    Akan mengirim <b>3 data pelanggaran</b> ke spreadsheet laporan.
                </p>

                <div class="p-3 rounded" style="background-color: #f3e8ff; text-align: left;">
                    <p class="mb-1"><i class="bx bx-book-content" style="color:#8b5cf6;"></i> Data yang akan dikirim:</p>
                    <ul class="mb-0" style="color:#6b21a8;">
                        <li>Tanggal, Siswa, Kelas</li>
                        <li>Pelanggaran, Poin, Pelapor</li>
                    </ul>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-purple" style="background:#8b5cf6; color:#fff;">
                        <i class="bx bx-cloud-upload"></i> Kirim ke Sheets
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 12px;">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="editModalLabel">Edit Pelanggaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" value="2024-11-15">
          </div>

          <div class="mb-3">
            <label for="siswa" class="form-label">Siswa</label>
            <select id="siswa" class="form-select">
              <option selected>Pilih siswa...</option>
              <option>Ahmad Rizki</option>
              <option>Siti Nurhaliza</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="pelanggaran" class="form-label">Jenis Pelanggaran</label>
            <select id="pelanggaran" class="form-select">
              <option selected>Pilih pelanggaran...</option>
              <option>Terlambat masuk kelas</option>
              <option>Mengganggu teman</option>
              <option>Tidak mengerjakan tugas</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="pelapor" class="form-label">Pelapor</label>
            <input type="text" class="form-control" id="pelapor" value="Wali Kelas XII RPL 1" readonly>
          </div>

          <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" rows="3">Terlambat 15 menit</textarea>
          </div>
        </form>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
      </div>

    </div>
  </div>
</div>
@endsection