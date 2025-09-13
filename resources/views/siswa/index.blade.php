{{-- Start of Selection --}}
@extends('layouts.admin.home')
@section('title', 'Data Siswa')
@section('titelcard', 'Data Siswa')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y" style="padding-top: 10px !important;">
    <!-- Header Section -->
    <div class="row mb-1">
        <div class="col-12">
            <h4 class="fw-bold" style="color: #1f2937; font-size: 1.5rem; margin: 0;">
                Data Siswa
            </h4>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.create') : route('guru.siswa.create') }}" class="btn btn-primary" style="background: #7c3aed; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                    <i class="ti ti-plus me-1"></i> <span class="btn-text">Tambah Siswa</span>
                </a>
                <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.export') : route('guru.siswa.export') }}" class="btn btn-success" style="background: #059669; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                    <i class="ti ti-arrow-up me-1"></i> <span class="btn-text">Export Excel</span>
                </a>
                <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.import.form') : route('guru.siswa.import.form') }}" class="btn btn-info" style="background: #0891b2; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                    <i class="ti ti-arrow-down me-1"></i> <span class="btn-text">Import Excel</span>
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
                <form method="GET" action="{{ request()->routeIs('admin.*') ? route('admin.siswa.index') : route('guru.siswa.index') }}" class="search-form">
                    <div class="search-input-group">
                        <div class="input-group search-group">
                            <span class="input-group-text" style="border-radius: 8px 0 0 8px; border: 1px solid #d1d5db; background: white;">
                                <i class="ti ti-search" style="color: #6b7280;"></i>
                            </span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari siswa..." style="border-radius: 0 8px 8px 0; border: 1px solid #d1d5db; border-left: none;">
                        </div>
                        <div class="search-buttons">
                            <button type="submit" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 8px 16px;">
                                <i class="ti ti-search me-1"></i> <span class="search-text">Cari</span>
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.index') : route('guru.siswa.index') }}" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 8px 16px;">
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
                    @if($siswa->hasPages())
                        <div class="pagination-info">
                            <div>
                                Menampilkan {{ $siswa->firstItem() ?? 0 }} - {{ $siswa->lastItem() ?? 0 }} dari {{ $siswa->total() }} data
                            </div>
                            <div>
                                Halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }}
                            </div>
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" style="border: none;">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">NO</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">NIS</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">NAMA</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">KELAS</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">JENIS KELAMIN</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">TAHUN AJARAN</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">POIN</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">STATUS</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa as $item)
                                <tr>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $loop->iteration + ($siswa->currentPage() - 1) * $siswa->perPage() }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $item->nis }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $item->nama }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $item->nama_kelas_lengkap }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $item->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151; text-align: center;">
                                        @php
                                            $totalPoin = $item->point ? $item->point->total_poin : 100;
                                            $badgeColor = $totalPoin >= 80 ? '#dcfce7' : ($totalPoin >= 60 ? '#fef3c7' : '#fee2e2');
                                            $textColor = $totalPoin >= 80 ? '#166534' : ($totalPoin >= 60 ? '#92400e' : '#dc2626');
                                        @endphp
                                        <span class="badge" style="background-color: {{ $badgeColor }}; color: {{ $textColor }}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                            {{ $totalPoin }}
                                        </span>
                                    </td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px;">
                                        <span class="badge" style="background-color: {{ $item->status ? '#dcfce7' : '#fee2e2' }}; color: {{ $item->status ? '#166534' : '#dc2626' }}; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                            {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px;">
                                        <div class="d-flex gap-1">
                                            <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.show', $item->id) : route('guru.siswa.show', $item->id) }}" class="btn btn-sm" style="background: #3b82f6; color: white; border: none; border-radius: 6px; padding: 6px 10px;">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.edit', $item->id) : route('guru.siswa.edit', $item->id) }}" class="btn btn-sm" style="background: #059669; color: white; border: none; border-radius: 6px; padding: 6px 10px;">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm" style="background: #f0ec0d; color: white; border: none; border-radius: 6px; padding: 6px 10px;" data-bs-toggle="modal" data-bs-target="#updateKelasModal{{ $item->id }}">
                                                <i class="ti ti-refresh"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="updateKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="updateKelasModalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="updateKelasModalLabel{{ $item->id }}">Update Kelas</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php
                                                                $kelas = \App\Kelas::find($item->kelas_id);
                                                            @endphp
                                                            <form action="{{ request()->routeIs('admin.*') ? route('admin.siswa.updatekelas', $item->id) : route('guru.siswa.updatekelas', $item->id) }}" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="kelas" class="form-label">Dari Kelas</label>
                                                                    <input type="text" class="form-control" id="darikelas" name="darikelas" value="{{ $kelas->nama_kelas . ' - ' . $kelas->subkelas }}" readonly>
                                                                    <input type="text" class="form-control" id="id" name="id" value="{{ $item->id }}" hidden>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="kelas" class="form-label">Ke Kelas <span class="text-danger">*</span></label>
                                                                    <select id="kelas{{ $item->id }}" class="form-select @error('kelas') is-invalid @enderror" name="kelas">
                                                                        <option value="">Pilih Kelas</option>
                                                                        @foreach($listKelas as $k)
                                                                            <option value="{{ $k->id }}" {{ old('kelas') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas . ' - ' . $k->subkelas }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('kelas')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ request()->routeIs('admin.*') ? route('admin.siswa.destroy', $item->id) : route('guru.siswa.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="background: #dc2626; color: white; border: none; border-radius: 6px; padding: 6px 10px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center" style="border: 1px solid #e5e7eb; padding: 40px; color: #6b7280; font-style: italic;">
                                        Tidak ada data siswa
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($siswa->hasPages())
                        <div class="pagination-wrapper mt-4 pb-3">
                            {{ $siswa->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom pagination styling */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 4px;
}

.pagination {
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 4px;
}

.pagination .page-link {
    color: #374151;
    border: 1px solid #d1d5db;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
    color: #1f2937;
    transform: translateY(-1px);
}

.pagination .page-item.active .page-link {
    background-color: #3b82f6;
    border-color: #3b82f6;
    color: white;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
}

.pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background-color: #f9fafb;
    border-color: #e5e7eb;
    cursor: not-allowed;
}

.pagination .page-item.disabled .page-link:hover {
    transform: none;
    background-color: #f9fafb;
}

/* Mobile Responsive Pagination */
@media (max-width: 768px) {
    .pagination-wrapper {
        padding: 0 10px;
    }
    
    .pagination {
        gap: 2px;
    }
    
    .pagination .page-link {
        padding: 6px 8px;
        min-width: 36px;
        height: 36px;
        font-size: 13px;
    }
    
    /* Hide some page numbers on very small screens */
    .pagination .page-item:not(.active):not(.disabled):not(:first-child):not(:last-child):not(:nth-child(2)):not(:nth-last-child(2)) {
        display: none;
    }
    
    /* Show ellipsis for hidden pages */
    .pagination .page-item:nth-child(3):not(.active):not(.disabled)::after,
    .pagination .page-item:nth-last-child(3):not(.active):not(.disabled)::after {
        content: '...';
        display: inline-block;
        padding: 6px 4px;
        color: #9ca3af;
        font-weight: bold;
    }
}

@media (max-width: 480px) {
    .pagination .page-link {
        padding: 4px 6px;
        min-width: 32px;
        height: 32px;
        font-size: 12px;
    }
    
    /* Show only first, last, current, and adjacent pages */
    .pagination .page-item:not(.active):not(.disabled):not(:first-child):not(:last-child):not(:nth-child(2)):not(:nth-last-child(2)):not(:nth-child(3)):not(:nth-last-child(3)) {
        display: none;
    }
}

/* Pagination Info */
.pagination-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 14px;
    color: #6b7280;
    padding: 10px 0;
    border-bottom: 1px solid #e5e7eb;
}

@media (max-width: 768px) {
    .pagination-info {
        flex-direction: column;
        gap: 10px;
        text-align: center;
        font-size: 13px;
    }
}

/* Table Responsive Improvements */
.table-responsive {
    border-radius: 8px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 13px;
    }
    
    .table th,
    .table td {
        padding: 8px 6px !important;
        font-size: 12px;
    }
    
    /* Hide less important columns on mobile */
    .table th:nth-child(5),
    .table td:nth-child(5),
    .table th:nth-child(6),
    .table td:nth-child(6) {
        display: none;
    }
}

@media (max-width: 480px) {
    .table th,
    .table td {
        padding: 6px 4px !important;
        font-size: 11px;
    }
    
    /* Hide more columns on very small screens */
    .table th:nth-child(4),
    .table td:nth-child(4),
    .table th:nth-child(7),
    .table td:nth-child(7) {
        display: none;
    }
}

/* Action buttons responsive */
@media (max-width: 768px) {
    .btn-sm {
        padding: 4px 6px !important;
        font-size: 11px !important;
    }
    
    .btn-group .btn {
        margin: 0 1px !important;
    }
}

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
}

/* Header spacing improvements */
.container-xxl {
    padding-top: 10px !important;
}

@media (max-width: 768px) {
    .container-xxl {
        padding-top: 8px !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }
    
    .row.mb-1 {
        margin-bottom: 5px !important;
    }
    
    .row.mb-2 {
        margin-bottom: 8px !important;
    }
    
    .row.mb-3 {
        margin-bottom: 12px !important;
    }
}

/* Error styling untuk modal */
.modal .is-invalid {
    border-color: #dc3545 !important;
}

.modal .invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.modal .form-label .text-danger {
    color: #dc3545 !important;
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
@section('script')
    @include('siswa.jsFunction')
@endsection
{{-- End of Selection --}}
