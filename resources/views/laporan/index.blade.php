@extends('layouts.admin.home')
@section('title', 'Laporan Pelanggaran')
@section('titelcard', 'Laporan Pelanggaran')
@section('content')
    <div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
        <div class="container-xxl flex-grow-1 container-p-y"
            style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

            <!-- Header Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Laporan Pelanggaran</h1>
            </div>

            <!-- Filter Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="alert" style="border: 1px solid red; padding: 15px; border-radius: 5px;">
                        <h5 style="font-weight: bold;"><i class="icon fas fa-info-circle"></i> Petunjuk Penggunaan Filter</h5>
                        <ul>
                            <li>Filter tanggal maksimal 1 bulan saja untuk menghindari beban sistem yang berlebihan.</li>
                            <li>Untuk memfilter siswa perorangan, pilih kelas terlebih dahulu.</li>
                            <li>Setelah mengisi form, klik tombol "Filter" untuk menampilkan data pelanggaran.</li>
                            <li>Gunakan tombol "Reset" untuk menghapus semua isian form yang telah diisi.</li>
                        </ul>
                    </div>
                    <form method="GET" action="{{ request()->routeIs('admin.*') ? route('admin.laporan.index') : route('guru.laporan') }}" class="row g-3 align-items-end">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="dariTanggal" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="dariTanggal" name="dari_tanggal" value="{{ request('dari_tanggal', \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="sampaiTanggal" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="sampaiTanggal" name="sampai_tanggal" value="{{ request('sampai_tanggal', \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kelas" class="form-label">Kelas</label>
                                @if(auth()->user()->role === 'Guru')
                                    <select id="kelas" class="form-select select2" name="kelas" onchange="setSiswa(this.value)" readonly>
                                        <option value="{{ auth()->user()->kelas_id }}" selected>
                                            {{ auth()->user()->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }} 
                                            ({{ auth()->user()->kelas->subkelas ?? '' }})
                                        </option>
                                    </select>
                                @else
                                    <select id="kelas" class="form-select select2" name="kelas" onchange="setSiswa(this.value)">
                                        <option value="" {{ request('kelas') == '' ? 'selected' : '' }}>Semua Kelas</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="siswa" class="form-label">Siswa</label>
                                <select id="siswa" class="form-select select2" name="siswa">
                                    <option value="" {{ request('siswa') == '' ? 'selected' : '' }}>Semua Siswa</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center justify-content-end gap-2 flex-wrap" style="margin-top: 35px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="menu-icon tf-icons ti ti-search"></i> Filter
                            </button>
                            @if(request()->hasAny(['dari_tanggal', 'sampai_tanggal', 'kelas', 'siswa']))
                                <a href="{{ request()->routeIs('admin.*') ? route('admin.laporan.index') : route('guru.laporan') }}" class="btn btn-secondary">
                                    <i class="menu-icon tf-icons ti ti-refresh"></i> Reset
                                </a>
                            @endif
                            <a href="javascript:void(0);" class="btn btn-success" onclick="exportExcel('{{ request()->routeIs('admin.*') ? route('admin.laporan.export') : route('guru.laporan.export') }}')">
                                <i class="ti ti-printer me-1"></i> Cetak Excel
                            </a>
                            <a href="javascript:void(0);" class="btn btn-info" onclick="exportExcelPerKelas('{{ request()->routeIs('admin.*') ? route('admin.laporan.export-per-kelas') : route('guru.laporan.export-per-kelas') }}')">
                                <i class="ti ti-file-spreadsheet me-1"></i> Laporan Per Kelas
                            </a>
                            <a href="javascript:void(0);" class="btn" onclick="exportPDF('{{ request()->routeIs('admin.*') ? route('admin.laporan.exportPDF') : route('guru.laporan.exportPDF') }}')" style="background: #ee3f3f; color: #fff;" onmouseover="this.style.background='#cc3333';" onmouseout="this.style.background='#ee3f3f';">
                                <i class="ti ti-printer me-1"></i> Cetak PDF
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    @if($laporanPelanggaran->hasPages())
                        <div class="pagination-info">
                            <div>
                                Menampilkan {{ $laporanPelanggaran->firstItem() ?? 0 }} - {{ $laporanPelanggaran->lastItem() ?? 0 }} dari {{ $laporanPelanggaran->total() }} data
                            </div>
                            <div>
                                Halaman {{ $laporanPelanggaran->currentPage() }} dari {{ $laporanPelanggaran->lastPage() }}
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" style="border: none;">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        NO</th>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        TANGGAL</th>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        SISWA</th>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        KELAS</th>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        PELANGGARAN</th>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        KETERANGAN</th>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        POIN</th>
                                    <th
                                        style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                                        PELAPOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grouped = $laporanPelanggaran; // sudah dipagination di controller
                                @endphp

                                @forelse($grouped as $groupKey => $group)
                                    @php $rowspan = $group->count(); @endphp
                                    @foreach ($group as $i => $item)
                                        <tr>
                                            @if ($i == 0)
                                                <td rowspan="{{ $rowspan }}"
                                                    style="border:1px solid #e5e7eb; padding:12px; text-align: center; vertical-align: middle;">
                                                    {{ ($grouped->currentPage() - 1) * $grouped->perPage() + $loop->parent->iteration }}.
                                                </td>
                                                <td rowspan="{{ $rowspan }}"
                                                    style="border:1px solid #e5e7eb; padding:12px;">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                                <td rowspan="{{ $rowspan }}"
                                                    style="border:1px solid #e5e7eb; padding:12px;">{{ $item->nama }}</td>
                                                <td rowspan="{{ $rowspan }}"
                                                    style="border:1px solid #e5e7eb; padding:12px;">
                                                    {{ $item->nama_kelas . ' (' . $item->subkelas . ')' }}
                                                </td>
                                            @endif
                                            <td style="border:1px solid #e5e7eb; padding:12px;">
                                                {{ $item->nama_pelanggaran }}</td>
                                            <td style="border:1px solid #e5e7eb; padding:12px;">
                                                {{ $item->keterangan }}</td>
                                            <td
                                                style="border:1px solid #e5e7eb; padding:12px; text-align: center; vertical-align: middle;">
                                                {{ $item->poin }}</td>
                                            @if ($i == 0)
                                                <td rowspan="{{ $rowspan }}"
                                                    style="border:1px solid #e5e7eb; padding:12px;">{{ $item->pelapor }}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center"
                                            style="border:1px solid #e5e7eb; padding:12px; color:#6b7280; font-style:italic;">
                                            Tidak ada data 
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    @if ($laporanPelanggaran->hasPages())
                        <div class="d-flex justify-content-center mt-4 pb-3">
                            {{ $laporanPelanggaran->appends(request()->query())->links() }}
                        </div>
                    @endif
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
                        <p class="mb-1"><i class="bx bx-book-content" style="color:#8b5cf6;"></i> Data yang akan dikirim:
                        </p>
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
                            <label for="pelanggaran" class="form-label">Jenis Poin</label>
                            <select id="pelanggaran" class="form-select">
                                <option selected>Pilih pelanggaran...</option>
                                <option>Terlambat masuk kelas</option>
                                <option>Mengganggu teman</option>
                                <option>Tidak mengerjakan tugas</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pelapor" class="form-label">Pelapor</label>
                            <input type="text" class="form-control" id="pelapor" value="Wali Kelas XII RPL 1"
                                readonly>
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

@section('script')
    @include('laporan.jsFunction')
@endsection
