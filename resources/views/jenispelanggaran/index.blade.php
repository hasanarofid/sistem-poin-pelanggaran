{{-- Start of Selection --}}
@extends('layouts.admin.home')
@section('title', 'Jenis Poin')
@section('titelcard', 'Jenis Poin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y" style="padding-top: 10px !important;">
    <!-- Header Section -->
    <div class="row mb-1">
        <div class="col-12">
            <h4 class="fw-bold" style="color: #1f2937; font-size: 1.5rem; margin: 0;">
                Jenis Poin
            </h4>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="btn btn-primary" style="background: #7c3aed; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggaran">
                    <i class="ti ti-plus me-1"></i> <span class="btn-text">Tambah Jenis Poin</span>
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
        <!-- Search Bar - Responsive -->
        <div class="col-12">
            <div class="search-container mb-3">
                <form method="GET" action="{{ route('admin.jenis-poin.index') }}" class="search-form">
                    <div class="search-input-group">
                        <div class="input-group search-group">
                            <span class="input-group-text" style="border-radius: 8px 0 0 8px; border: 1px solid #d1d5db; background: white;">
                                <i class="ti ti-search" style="color: #6b7280;"></i>
                            </span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari jenis poin..." style="border-radius: 0 8px 8px 0; border: 1px solid #d1d5db; border-left: none;">
                        </div>
                        <div class="search-buttons">
                            <button type="submit" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 8px 16px;">
                                <i class="ti ti-search me-1"></i> <span class="search-text">Cari</span>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.jenis-poin.index') }}" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 8px 16px;">
                                    <i class="ti ti-x me-1"></i> <span class="reset-text">Reset</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px;">
                <div class="card-body">
                    <!-- Pagination Info -->
                    @if($jenisPelanggaran->hasPages())
                        <div class="pagination-info">
                            <div>
                                Menampilkan {{ $jenisPelanggaran->firstItem() ?? 0 }} - {{ $jenisPelanggaran->lastItem() ?? 0 }} dari {{ $jenisPelanggaran->total() }} data
                            </div>
                            <div>
                                Halaman {{ $jenisPelanggaran->currentPage() }} dari {{ $jenisPelanggaran->lastPage() }}
                            </div>
                        </div>
                    @endif
                    
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
                    <div class="pagination-wrapper">
                        {{ $jenisPelanggaran->links() }}
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

<style>
/* Responsive Top Section */
.search-container {
    display: flex;
    justify-content: flex-end;
}

.search-form {
    display: flex;
    align-items: center;
}

.search-input-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-buttons {
    display: flex;
    gap: 8px;
}

.search-group {
    width: 300px;
    min-width: 200px;
}

/* Responsive Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    padding: 15px 0;
}

.pagination-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding: 10px 0;
    font-size: 14px;
    color: #6b7280;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 5px;
}

.page-item {
    margin: 0;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    background: white;
    color: #374151;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.page-link:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    color: #1f2937;
}

.page-item.active .page-link {
    background: #3b82f6;
    border-color: #3b82f6;
    color: white;
}

.page-item.disabled .page-link {
    background: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

/* Responsive Table */
.table-responsive {
    overflow-x: auto;
    border-radius: 8px;
}

.table th,
.table td {
    white-space: nowrap;
    vertical-align: middle;
}

/* Responsive Buttons */
.btn-sm {
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 6px;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .search-container {
        justify-content: stretch;
    }
    
    .search-form {
        width: 100%;
        flex-direction: column;
        gap: 10px;
    }
    
    .search-input-group {
        width: 100%;
        flex-direction: column;
        gap: 10px;
    }
    
    .search-group {
        width: 100%;
        min-width: 150px;
    }
    
    .search-buttons {
        width: 100%;
        justify-content: center;
        gap: 10px;
    }
    
    .search-text,
    .reset-text {
        display: none;
    }
    
    .btn-text {
        display: none;
    }
    
    .d-flex.flex-wrap {
        gap: 8px !important;
    }
    
    .btn {
        padding: 8px 12px !important;
        font-size: 13px !important;
        flex: 1;
    }
    
    .container-xxl {
        padding-top: 8px !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }
    
    .row.mb-1 {
        margin-bottom: 5px !important;
    }
    
    .row.mb-3 {
        margin-bottom: 12px !important;
    }
    
    .pagination-info {
        flex-direction: column;
        gap: 5px;
        text-align: center;
        font-size: 12px;
    }
    
    .pagination {
        gap: 3px;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .page-link {
        min-width: 35px;
        height: 35px;
        padding: 6px 8px;
        font-size: 12px;
    }
    
    .table th,
    .table td {
        padding: 8px 6px !important;
        font-size: 12px;
    }
    
    .btn-sm {
        padding: 4px 8px !important;
        font-size: 11px !important;
    }
    
    /* Hide less important columns on mobile */
    .table th:nth-child(4),
    .table td:nth-child(4),
    .table th:nth-child(6),
    .table td:nth-child(6) {
        display: none;
    }
}

@media (max-width: 480px) {
    .search-group {
        width: 100%;
        min-width: 120px;
    }
    
    .search-buttons {
        gap: 8px;
    }
    
    .btn {
        padding: 6px 10px !important;
        font-size: 12px !important;
        flex: 1;
    }
    
    .d-flex.flex-wrap {
        gap: 6px !important;
    }
    
    .pagination {
        gap: 2px;
    }
    
    .page-link {
        min-width: 30px;
        height: 30px;
        padding: 4px 6px;
        font-size: 11px;
    }
    
    .table th,
    .table td {
        padding: 6px 4px !important;
        font-size: 11px;
    }
    
    .btn-sm {
        padding: 3px 6px !important;
        font-size: 10px !important;
    }
}

/* Smart hiding for pagination on small screens */
@media (max-width: 576px) {
    .pagination .page-item:nth-child(n+4):nth-last-child(n+4) {
        display: none;
    }
    
    .pagination .page-item:nth-child(3)::after {
        content: '...';
        display: inline-block;
        padding: 0 5px;
        color: #6b7280;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling to pagination
    const paginationLinks = document.querySelectorAll('.pagination .page-link');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Add loading state
            const wrapper = document.querySelector('.pagination-wrapper');
            if (wrapper) {
                wrapper.style.opacity = '0.6';
                wrapper.style.pointerEvents = 'none';
            }
            
            // Scroll to top of table
            const table = document.querySelector('.table-responsive');
            if (table) {
                table.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Add touch support for pagination on mobile
    if ('ontouchstart' in window) {
        const paginationItems = document.querySelectorAll('.pagination .page-item');
        paginationItems.forEach(item => {
            const link = item.querySelector('.page-link');
            if (link && !item.classList.contains('disabled')) {
                link.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.95)';
                });
                
                link.addEventListener('touchend', function() {
                    this.style.transform = 'scale(1)';
                });
            }
        });
    }
    
    // Add keyboard navigation for pagination
    document.addEventListener('keydown', function(e) {
        const activePage = document.querySelector('.pagination .page-item.active');
        if (activePage) {
            const prevLink = document.querySelector('.pagination .page-item:first-child .page-link');
            const nextLink = document.querySelector('.pagination .page-item:last-child .page-link');
            
            if (e.key === 'ArrowLeft' && prevLink && !prevLink.closest('.page-item').classList.contains('disabled')) {
                e.preventDefault();
                prevLink.click();
            } else if (e.key === 'ArrowRight' && nextLink && !nextLink.closest('.page-item').classList.contains('disabled')) {
                e.preventDefault();
                nextLink.click();
            }
        }
    });
});
</script>
@endsection