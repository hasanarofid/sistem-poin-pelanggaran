{{-- Start of Selection --}}
@extends('layouts.admin.home')
@section('title', 'Jenis Poin')
@section('titelcard', 'Jenis Poin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="fw-bold" style="color: #1f2937; font-size: 1.5rem; margin: 0;">
                Jenis Poin
            </h4>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-primary" style="background: #7c3aed; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggaran">
                    <i class="ti ti-plus me-1"></i> Tambah Jenis Poin
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {!! session('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {!! session('error') !!}
        </div>
    @endif

    <!-- Search Bar and Table Row -->
    <div class="row">
        <!-- Search Bar - Right Side -->
        <div class="col-12">
            <div class="d-flex justify-content-end mb-3">
                <form method="GET" action="{{ route('admin.jenis-poin.index') }}" class="d-flex align-items-center">
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text" style="border-radius: 8px 0 0 8px; border: 1px solid #d1d5db; background: white;">
                            <i class="ti ti-search" style="color: #6b7280;"></i>
                        </span>
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                               placeholder="Cari jenis poin..." style="border-radius: 0 8px 8px 0; border: 1px solid #d1d5db; border-left: none;">
                    </div>
                    <button type="submit" class="btn btn-outline-secondary ms-2" style="border-radius: 8px; padding: 8px 16px;">
                        <i class="ti ti-search me-1"></i> Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.jenis-poin.index') }}" class="btn btn-outline-secondary ms-2" style="border-radius: 8px; padding: 8px 16px;">
                            <i class="ti ti-x me-1"></i> Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" style="border: none;">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">NO</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">KODE</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">NAMA</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">KATEGORI</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">POIN</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">DESKRIPSI</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jenisPelanggaran as $index => $pelanggaran)
                                <tr>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $loop->iteration + ($jenisPelanggaran->currentPage() - 1) * $jenisPelanggaran->perPage() }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151; font-weight: 600;">{{ $pelanggaran->kode ?? '-' }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $pelanggaran->nama_pelanggaran }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">
                                        @php
                                            $kategoriColor = $pelanggaran->kategori->nama_kategori == 'Pelanggaran' ? '#fee2e2' : '#dcfce7';
                                            $kategoriTextColor = $pelanggaran->kategori->nama_kategori == 'Pelanggaran' ? '#dc2626' : '#166534';
                                        @endphp
                                        <span class="badge" style="background-color: {{ $kategoriColor }}; color: {{ $kategoriTextColor }}; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                            {{ $pelanggaran->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151; text-align: center;">
                                        @php
                                            $poinColor = $pelanggaran->poin < 0 ? '#fee2e2' : '#dcfce7';
                                            $poinTextColor = $pelanggaran->poin < 0 ? '#dc2626' : '#166534';
                                        @endphp
                                        <span class="badge" style="background-color: {{ $poinColor }}; color: {{ $poinTextColor }}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                            {{ $pelanggaran->poin > 0 ? '+' : '' }}{{ $pelanggaran->poin }}
                                        </span>
                                    </td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $pelanggaran->deskripsi ?? '-' }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px;">
                                        <div class="d-flex gap-1">
                                            <button type="button" class="btn btn-sm btnEditJenisPelanggaran" style="background: #059669; color: white; border: none; border-radius: 6px; padding: 6px 10px;" data-id="{{ $pelanggaran->id }}" data-kode="{{ $pelanggaran->kode }}" data-nama="{{ $pelanggaran->nama_pelanggaran }}" data-kategori="{{ $pelanggaran->kategori_id }}" data-poin="{{ $pelanggaran->poin }}" data-deskripsi="{{ $pelanggaran->deskripsi }}">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.jenis-poin.destroy', $pelanggaran->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="background: #dc2626; color: white; border: none; border-radius: 6px; padding: 6px 10px;">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="border: 1px solid #e5e7eb; padding: 40px; color: #6b7280; font-style: italic;">
                                        Tidak ada data jenis poin
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($jenisPelanggaran->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $jenisPelanggaran->firstItem() }} sampai {{ $jenisPelanggaran->lastItem() }} dari {{ $jenisPelanggaran->total() }} data
                        </div>
                        <div>
                            {{ $jenisPelanggaran->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Jenis Poin -->
<div class="modal fade" id="modalTambahPelanggaran" tabindex="-1" aria-labelledby="modalTambahPelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTambahPelanggaranLabel">Tambah Jenis Poin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form action="{{ route('admin.jenis-poin.store') }}" method="POST" id="formTambahPelanggaran">
                @csrf
                <div class="modal-body">

                    <!-- Kode -->
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Contoh: P1.1a, R.1" required>
                    </div>

                    <!-- Nama Pelanggaran -->
                    <div class="mb-3">
                        <label for="nama_pelanggaran" class="form-label">Nama Pelanggaran / Reward</label>
                        <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" placeholder="">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="form-select select2">
                            <option value="">Pilih kategori...</option>
                            @foreach($kategori as $value)
                            <option value="{{$value->id}}">{{$value->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Poin -->
                    <div class="mb-3">
                        <label for="poin" class="form-label">Poin Pelanggaran / Reward</label>
                        <input type="number" class="form-control" id="poin" name="poin" min="-100" max="100" placeholder="Masukkan poin (negatif untuk pelanggaran, positif untuk reward)">
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

<!-- Modal Edit Jenis Poin -->
<div class="modal fade" id="modalEditPelanggaran" tabindex="-1" aria-labelledby="modalEditPelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditPelanggaranLabel">Edit Jenis Poin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form method="POST" id="formEditPelanggaran">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-body">

                    <!-- Kode -->
                    <div class="mb-3">
                        <label for="edit_kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="edit_kode" name="kode" placeholder="Contoh: P1.1a, R.1" required>
                    </div>

                    <!-- Nama Pelanggaran -->
                    <div class="mb-3">
                        <label for="edit_nama_pelanggaran" class="form-label">Nama Pelanggaran / Reward</label>
                        <input type="text" class="form-control" id="edit_nama_pelanggaran" name="nama_pelanggaran" placeholder="">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="edit_kategori_id" class="form-label">Kategori</label>
                        <select id="edit_kategori_id" name="kategori_id" class="form-select select2">
                            <option value="">Pilih kategori...</option>
                            @foreach($kategori as $value)
                            <option value="{{$value->id}}">{{$value->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Poin -->
                    <div class="mb-3">
                        <label for="edit_poin" class="form-label">Poin Pelanggaran / Reward</label>
                        <input type="number" class="form-control" id="edit_poin" name="poin" min="-100" max="100" placeholder="Masukkan poin (negatif untuk pelanggaran, positif untuk reward)">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail pelanggaran..."></textarea>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Edit button click handler
    $('.btnEditJenisPelanggaran').click(function() {
        var id = $(this).data('id');
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var kategori = $(this).data('kategori');
        var poin = $(this).data('poin');
        var deskripsi = $(this).data('deskripsi');

        $('#edit_id').val(id);
        $('#edit_kode').val(kode);
        $('#edit_nama_pelanggaran').val(nama);
        $('#edit_kategori_id').val(kategori);
        $('#edit_poin').val(poin);
        $('#edit_deskripsi').val(deskripsi);

        // Set form action
        $('#formEditPelanggaran').attr('action', '{{ route("admin.jenis-poin.update", ":id") }}'.replace(':id', id));

        // Show modal
        $('#modalEditPelanggaran').modal('show');
    });
});
</script>
@endsection