@extends('layouts.admin.home')
@section('title', 'Master Kategori')
@section('titelcard', 'Master Kategori')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y" style="padding-top: 10px !important;">
    <!-- Header Section -->
    <div class="row mb-1">
        <div class="col-12">
            <h4 class="fw-bold" style="color: #1f2937; font-size: 1.5rem; margin: 0;">
                Master Kategori
            </h4>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="btn btn-success" style="background: #059669; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                    <i class="ti ti-plus me-1"></i> <span class="btn-text">Tambah Master Kategori</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Search Bar and Table Row -->
    <div class="row">
        <!-- Search Bar - Responsive -->
        <div class="col-12">
            <div class="search-container mb-3">
                <form method="GET" action="{{ route('admin.kategori.index') }}" class="search-form">
                    <div class="search-input-group">
                        <div class="input-group search-group">
                            <span class="input-group-text" style="border-radius: 8px 0 0 8px; border: 1px solid #d1d5db; background: white;">
                                <i class="ti ti-search" style="color: #6b7280;"></i>
                            </span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari kategori..." style="border-radius: 0 8px 8px 0; border: 1px solid #d1d5db; border-left: none;">
                        </div>
                        <div class="search-buttons">
                            <button type="submit" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 8px 16px;">
                                <i class="ti ti-search me-1"></i> <span class="search-text">Cari</span>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 8px 16px;">
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
                    @if($kategori->hasPages())
                        <div class="pagination-info">
                            <div>
                                Menampilkan {{ $kategori->firstItem() ?? 0 }} - {{ $kategori->lastItem() ?? 0 }} dari {{ $kategori->total() }} data
                            </div>
                            <div>
                                Halaman {{ $kategori->currentPage() }} dari {{ $kategori->lastPage() }}
                            </div>
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" style="border: none;">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">NO</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">NAMA KATEGORI</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">STATUS</th>
                                    <th style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategori as $index => $value)
                                <tr>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $loop->iteration + ($kategori->currentPage() - 1) * $kategori->perPage() }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">{{ $value->nama_kategori ?? '-' }}</td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px; color: #374151;">
                                        @if($value->is_aktif == 1)
                                            <span class="badge" style="background-color: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">Aktif</span>
                                        @else
                                            <span class="badge" style="background-color: #fee2e2; color: #dc2626; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td style="border: 1px solid #e5e7eb; padding: 12px;">
                                        <div class="d-flex gap-1">
                                            <button type="button" class="btn btn-sm btnEditKategori" style="background: #059669; color: white; border: none; border-radius: 6px; padding: 6px 10px;">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.kategori.destroy', $value->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                                    <td colspan="4" class="text-center" style="border: 1px solid #e5e7eb; padding: 40px; color: #6b7280; font-style: italic;">
                                        Belum ada data kategori
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($kategori->hasPages())
                    <div class="pagination-wrapper">
                        {{ $kategori->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTambahKategoriLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <form action="{{ route('admin.kategori.store') }}" method="POST" id="formTambahKategori">
                @csrf
                <div class="modal-body">

                    <!-- Nama Kategori -->
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="is_aktif" class="form-label">Status</label>
                        <select id="is_aktif" name="is_aktif" class="form-select">
                            <option value="">Pilih Status...</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
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

<!-- MODAL EDIT -->
<!-- Modal Edit Kategori -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditKategoriLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form id="formEditKategori">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label for="edit_nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_is_aktif" class="form-label">Status</label>
                        <select class="form-select" id="edit_is_aktif" name="is_aktif" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

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
}

@media (max-width: 480px) {
    .search-group {
        width: 100%;
        min-width: 120px;
    }
    
    .search-buttons {
        gap: 8px;
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
    
    .d-flex.flex-wrap {
        gap: 6px !important;
    }
    
    .btn {
        padding: 6px 10px !important;
        font-size: 12px !important;
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

@section('script')
<script>
    $(document).ready(function() {
        // Submit form tambah pelanggaran
        $('#formTambahKategori').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.kategori.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data kategori berhasil disimpan',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            $('#modalTambahKategori').modal('hide');
                            $('#formTambahKategori')[0].reset();
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
                        alert(pesan); // bisa diganti pakai toast/alert Bootstrap
                    } else {
                        alert("Gagal menyimpan data!");
                    }
                }
            });
        });
    });

    $(document).on("click", ".btnEditKategori", function() {
        let row = $(this).closest("tr");
        let id = row.find("form").attr("action").split("/").pop(); // ambil ID dari action form delete
        let nama_kategori = row.find("td:eq(1)").text().trim();
        let status = row.find("td:eq(2)").text().trim() === "Aktif" ? 1 : 0;

        // Set nilai ke modal
        $("#edit_id").val(id);
        $("#edit_nama_kategori").val(nama_kategori);
        $("#edit_is_aktif").val(status);

        // Tampilkan modal
        $("#modalEditKategori").modal("show");
    });

    // Submit form Edit
    $("#formEditKategori").on("submit", function(e) {
        e.preventDefault();

        let id = $("#edit_id").val();
        let formData = $(this).serialize();

        $.ajax({
            url: "/admin/kategori/" + id + "/update", // ✅ sesuai route
            type: "POST", // tetap POST karena ada @method('PUT') di form
            data: formData,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data kategori berhasil disimpan',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        $("#modalEditKategori").modal("hide");
                        $('#formTambahKategori')[0].reset();
                        location.reload();
                    });

                } else {
                    alert(response.message || "Gagal update data");
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Terjadi kesalahan saat update!");
            }
        });
    });
</script>

@endsection