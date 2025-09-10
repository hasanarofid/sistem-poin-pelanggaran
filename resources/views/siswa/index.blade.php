@extends('layouts.admin.home')
@section('title', 'Data Siswa')
@section('titelcard', 'Data Siswa')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="fw-bold" style="color: #1f2937; font-size: 1.5rem; margin: 0;">
                Data Siswa
            </h4>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.create') : route('guru.siswa.create') }}" class="btn btn-primary" style="background: #7c3aed; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                    <i class="ti ti-plus me-1"></i> Tambah Siswa
                </a>
                <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.export') : route('guru.siswa.export') }}" class="btn btn-success" style="background: #059669; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                    <i class="ti ti-arrow-up me-1"></i> Export Excel
                </a>
                <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.import.form') : route('guru.siswa.import.form') }}" class="btn btn-info" style="background: #0891b2; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;">
                    <i class="ti ti-arrow-down me-1"></i> Import Excel
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
                <form method="GET" action="{{ request()->routeIs('admin.*') ? route('admin.siswa.index') : route('guru.siswa.index') }}" class="d-flex align-items-center">
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text" style="border-radius: 8px 0 0 8px; border: 1px solid #d1d5db; background: white;">
                            <i class="ti ti-search" style="color: #6b7280;"></i>
                        </span>
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                               placeholder="Cari siswa..." style="border-radius: 0 8px 8px 0; border: 1px solid #d1d5db; border-left: none;">
                    </div>
                    <button type="submit" class="btn btn-outline-secondary ms-2" style="border-radius: 8px; padding: 8px 16px;">
                        <i class="ti ti-search me-1"></i> Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ request()->routeIs('admin.*') ? route('admin.siswa.index') : route('guru.siswa.index') }}" class="btn btn-outline-secondary ms-2" style="border-radius: 8px; padding: 8px 16px;">
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
                <div class="card-body" style="padding: 0;">
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
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">STATUS</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">AKSI</th>
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
                                    <td colspan="8" class="text-center" style="border: 1px solid #e5e7eb; padding: 40px; color: #6b7280; font-style: italic;">
                                        Tidak ada data siswa
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($siswa->hasPages())
                        <div class="d-flex justify-content-center mt-4 pb-3">
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
.pagination {
    margin: 0;
}

.pagination .page-link {
    color: #374151;
    border: 1px solid #d1d5db;
    padding: 8px 12px;
    margin: 0 2px;
    border-radius: 6px;
}

.pagination .page-link:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
}

.pagination .page-item.active .page-link {
    background-color: #3b82f6;
    border-color: #3b82f6;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background-color: #f9fafb;
    border-color: #e5e7eb;
}
</style>
@endsection
