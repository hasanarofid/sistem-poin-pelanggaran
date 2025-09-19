@extends('layouts.admin.home')
@section('title', 'List Input Poin')
@section('titelcard', 'List Input Poin')
@section('content')
<style>
/* Responsive Table Styles */
.table-responsive {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  overflow-x: auto;
}

.table th {
  background-color: #f8f9fa;
  border-bottom: 2px solid #dee2e6;
  font-weight: 600;
  color: #495057;
  white-space: nowrap;
  min-width: 120px;
}

.table td {
  vertical-align: middle;
  border-bottom: 1px solid #dee2e6;
  word-wrap: break-word;
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
  .table-responsive {
    font-size: 0.875rem;
  }
  
  .table th,
  .table td {
    padding: 0.5rem 0.25rem;
    font-size: 0.8rem;
  }
  
  .table th:nth-child(n+6),
  .table td:nth-child(n+6) {
    display: none;
  }
  
  .mobile-card {
    display: block;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    margin-bottom: 1rem;
    padding: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }
  
  .mobile-card .card-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #e5e7eb;
  }
  
  .mobile-card .card-body {
    padding: 0;
  }
  
  .mobile-card .info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
  }
  
  .mobile-card .info-label {
    font-weight: 600;
    color: #6b7280;
    font-size: 0.8rem;
  }
  
  .mobile-card .info-value {
    color: #374151;
    font-size: 0.8rem;
  }
  
  .mobile-card .actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid #e5e7eb;
  }
  
  .mobile-card .actions .btn {
    flex: 1;
    font-size: 0.75rem;
    padding: 0.375rem 0.5rem;
  }
}

@media (max-width: 576px) {
  .container-xxl {
    padding: 15px !important;
  }
  
  .d-flex.justify-content-between {
    flex-direction: column;
    gap: 1rem;
  }
  
  .d-flex.gap-2 {
    flex-direction: column;
    width: 100%;
  }
  
  .d-flex.gap-2 .btn {
    width: 100%;
    justify-content: center;
  }
  
  .filter-card .row {
    margin: 0;
  }
  
  .filter-card .col-md-6,
  .filter-card .col-md-3 {
    padding: 0.5rem 0;
  }
  
  .stats-card .row {
    margin: 0;
  }
  
  .stats-card .col-md-3 {
    padding: 0.5rem;
  }
  
  .stat-number {
    font-size: 1.5rem !important;
  }
  
  .stat-label {
    font-size: 0.75rem !important;
  }
}

/* Desktop Table Styles */
@media (min-width: 769px) {
  .mobile-card {
    display: none;
  }
}

.badge {
  font-size: 0.75rem;
  padding: 0.375rem 0.75rem;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
}

.pagination {
  margin-bottom: 0;
}

.page-link {
  color: #7c3aed;
  border-color: #dee2e6;
}

.page-link:hover {
  color: #5a2d91;
  background-color: #f8f9fa;
  border-color: #dee2e6;
}

.page-item.active .page-link {
  background-color: #7c3aed;
  border-color: #7c3aed;
}

.search-box {
  border-radius: 8px;
  border: 1px solid #d1d5db;
  transition: all 0.3s ease;
}

.search-box:focus {
  border-color: #7c3aed;
  box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
}

.filter-card {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-radius: 12px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

.filter-card .form-label {
  color: white;
  font-weight: 600;
}

.filter-card .form-select,
.filter-card .form-control {
  border: 1px solid rgba(255, 255, 255, 0.3);
  background-color: rgba(255, 255, 255, 0.9);
}

.filter-card .form-select:focus,
.filter-card .form-control:focus {
  border-color: rgba(255, 255, 255, 0.5);
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
}

.stats-card {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-radius: 12px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

.stats-card .stat-item {
  text-align: center;
}

.stats-card .stat-number {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.stats-card .stat-label {
  font-size: 0.875rem;
  opacity: 0.9;
}

.point-positive {
  color: #10b981;
  font-weight: 600;
}

.point-negative {
  color: #ef4444;
  font-weight: 600;
}

.action-buttons {
  display: flex;
  gap: 0.25rem;
}

.action-buttons .btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
}

.empty-state {
  text-align: center;
  padding: 3rem 1rem;
  color: #6b7280;
}

.empty-state i {
  font-size: 4rem;
  margin-bottom: 1rem;
  opacity: 0.5;
}

.loading-spinner {
  display: inline-block;
  width: 1rem;
  height: 1rem;
  border: 2px solid #f3f3f3;
  border-top: 2px solid #7c3aed;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Select2 Styling */
.select2-container--default .select2-selection--single {
  height: 38px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  background-color: rgba(255, 255, 255, 0.9);
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 36px;
  padding-left: 12px;
  color: #374151;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 36px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #667eea;
}

.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: #e5e7eb;
}

.select2-container--default .select2-results__option {
  padding: 8px 12px;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
  border: 1px solid #d1d5db;
  border-radius: 6px;
  padding: 6px 12px;
}

.select2-dropdown {
  border: 1px solid #d1d5db;
  border-radius: 8px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.select2-container--default .select2-selection--single:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Select2 Loading State */
.select2-container--default .select2-selection--single .select2-selection__rendered {
  position: relative;
}

.select2-container--default .select2-selection--single .select2-selection__rendered::after {
  content: '';
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  width: 16px;
  height: 16px;
  border: 2px solid #f3f3f3;
  border-top: 2px solid #667eea;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  display: none;
}

.select2-container--default.select2-container--loading .select2-selection--single .select2-selection__rendered::after {
  display: block;
}
</style>

<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
  <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="ti ti-check-circle me-2"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="ti ti-alert-circle me-2"></i>
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <i class="ti ti-alert-triangle me-2"></i>
      {{ session('warning') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Header Title & Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">List Input Poin</h1>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.input-poin.index') }}" class="btn btn-primary d-flex align-items-center">
          <i class="ti ti-plus me-2"></i> Input Poin Baru
        </a>
        <a href="{{ route('admin.penambahan-poin-kelas.index') }}" class="btn btn-success d-flex align-items-center">
          <i class="ti ti-users me-2"></i> Penambahan Poin Kelas
        </a>
      </div>
    </div>

    <!-- Stats Card -->
    <div class="stats-card">
      <div class="row">
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number">{{ $inputPelanggaranT->total() }}</div>
            <div class="stat-label">Total Input Poin</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number">{{ $inputPelanggaranT->where('created_at', '>=', now()->startOfDay())->count() }}</div>
            <div class="stat-label">Hari Ini</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number">{{ $inputPelanggaranT->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
            <div class="stat-label">Minggu Ini</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <div class="stat-number">{{ $inputPelanggaranT->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
            <div class="stat-label">Bulan Ini</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter Card -->
    <div class="filter-card">
      <div class="row">
        <div class="col-md-6">
          <label for="search" class="form-label">Cari Siswa</label>
          <input type="text" class="form-control search-box" id="search" placeholder="NIS, Nama, atau Kelas...">
        </div>
        <div class="col-md-3">
          <label for="filter_kelas" class="form-label">Filter Kelas</label>
          <select class="form-select select2" id="filter_kelas">
            <option value="">Semua Kelas</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="filter_jenis" class="form-label">Filter Jenis Poin</label>
          <select class="form-select select2" id="filter_jenis">
            <option value="">Semua Jenis</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div class="card">
      <div class="card-body">
        @if($inputPelanggaranT->count() > 0)
        
        <!-- Desktop Table View -->
        <div class="table-responsive d-none d-md-block">
          <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Jenis Poin</th>
                <th>Poin</th>
                <th>Keterangan</th>
                <th>Pelapor</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($inputPelanggaranT as $index => $item)
              <tr>
                <td>{{ $inputPelanggaranT->firstItem() + $index }}</td>
                <td>
                  <div class="d-flex flex-column">
                    <span class="fw-bold">{{ $item->created_at->format('d/m/Y') }}</span>
                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                  </div>
                </td>
                <td>
                  <div class="d-flex flex-column">
                    <span class="fw-bold">{{ $item->siswa->nama }}</span>
                    <small class="text-muted">NIS: {{ $item->siswa->nis }}</small>
                  </div>
                </td>
                <td>
                  <span class="badge bg-primary">{{ $item->siswa->kelas->subkelas ?? '-' }}</span>
                </td>
                <td>
                  <div class="d-flex flex-column">
                    <span class="fw-bold">{{ $item->jenispelanggaran->nama_pelanggaran }}</span>
                    <small class="text-muted">{{ $item->jenispelanggaran->kategori->nama_kategori ?? '-' }}</small>
                  </div>
                </td>
                <td>
                  <span class="fw-bold {{ $item->jenispelanggaran->poin > 0 ? 'point-positive' : 'point-negative' }}">
                    {{ $item->jenispelanggaran->poin > 0 ? '+' : '' }}{{ $item->jenispelanggaran->poin }}
                  </span>
                </td>
                <td>
                  <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $item->keterangan }}">
                    {{ $item->keterangan ?: '-' }}
                  </span>
                </td>
                <td>
                  <div class="d-flex flex-column">
                    <span class="fw-bold">{{ $item->pelapor->name ?? 'Tidak diketahui' }}</span>
                    <small class="text-muted">ID: {{ $item->pelapor_id }}</small>
                  </div>
                </td>
                <td>
                  <div class="action-buttons">
                    <a href="{{ route('admin.list-input-poin.show', $item->id) }}" 
                       class="btn btn-info btn-sm" 
                       title="Lihat Detail">
                      <i class="ti ti-eye"></i>
                    </a>
                    <a href="{{ route('admin.list-input-poin.edit', $item->id) }}" 
                       class="btn btn-warning btn-sm" 
                       title="Edit">
                      <i class="ti ti-edit"></i>
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="d-md-none">
          @foreach($inputPelanggaranT as $index => $item)
          <div class="mobile-card">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">{{ $item->siswa->nama }}</span>
                <span class="badge bg-primary">{{ $item->siswa->kelas->subkelas ?? '-' }}</span>
              </div>
            </div>
            <div class="card-body">
              <div class="info-row">
                <span class="info-label">Tanggal:</span>
                <span class="info-value">{{ $item->created_at->format('d/m/Y H:i') }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">NIS:</span>
                <span class="info-value">{{ $item->siswa->nis }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Jenis Poin:</span>
                <span class="info-value">{{ $item->jenispelanggaran->nama_pelanggaran }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Poin:</span>
                <span class="info-value {{ $item->jenispelanggaran->poin > 0 ? 'point-positive' : 'point-negative' }}">
                  {{ $item->jenispelanggaran->poin > 0 ? '+' : '' }}{{ $item->jenispelanggaran->poin }}
                </span>
              </div>
              @if($item->keterangan)
              <div class="info-row">
                <span class="info-label">Keterangan:</span>
                <span class="info-value">{{ $item->keterangan }}</span>
              </div>
              @endif
              <div class="info-row">
                <span class="info-label">Pelapor:</span>
                <span class="info-value">{{ $item->pelapor->name ?? 'Tidak diketahui' }}</span>
              </div>
              <div class="actions">
                <a href="{{ route('admin.list-input-poin.show', $item->id) }}" 
                   class="btn btn-info btn-sm">
                  <i class="ti ti-eye me-1"></i>Detail
                </a>
                <a href="{{ route('admin.list-input-poin.edit', $item->id) }}" 
                   class="btn btn-warning btn-sm">
                  <i class="ti ti-edit me-1"></i>Edit
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
          <div class="text-muted">
            Menampilkan {{ $inputPelanggaranT->firstItem() }} sampai {{ $inputPelanggaranT->lastItem() }} 
            dari {{ $inputPelanggaranT->total() }} data
          </div>
          <div>
            {{ $inputPelanggaranT->links() }}
          </div>
        </div>
        @else
        <div class="empty-state">
          <i class="ti ti-database-off"></i>
          <h4>Tidak ada data input poin</h4>
          <p>Belum ada data input poin yang tersimpan.</p>
          <a href="{{ route('admin.input-poin.index') }}" class="btn btn-primary">
            <i class="ti ti-plus me-2"></i>Input Poin Pertama
          </a>
        </div>
        @endif
      </div>
    </div>

  </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
  // Auto-hide flash messages after 5 seconds
  setTimeout(function() {
    $('.alert').fadeOut('slow');
  }, 5000);

  // Show SweetAlert for flash messages
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      showConfirmButton: false,
      timer: 3000
    });
  @endif

  @if(session('error'))
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: '{{ session('error') }}',
      showConfirmButton: true
    });
  @endif

  @if(session('warning'))
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan!',
      text: '{{ session('warning') }}',
      showConfirmButton: false,
      timer: 3000
    });
  @endif

  // Initialize Select2 for filter kelas with AJAX
  $('#filter_kelas').select2({
    placeholder: 'Semua Kelas',
    allowClear: true,
    width: '100%',
    language: {
      noResults: function() {
        return "Tidak ada kelas ditemukan";
      },
      searching: function() {
        return "Mencari kelas...";
      }
    },
    ajax: {
      url: "{{ route('api.get-kelas') }}",
      dataType: 'json',
      delay: 250,
      type: "GET",
      data: function(params) {
        return {
          term: params.term
        };
      },
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            return {
              text: item.nama_kelas + ' - ' + item.subkelas,
              id: item.subkelas,
              data: item
            };
          })
        };
      },
      cache: true,
      error: function() {
        console.log('Error loading kelas data');
      }
    }
  });

  // Initialize Select2 for filter jenis poin with AJAX
  $('#filter_jenis').select2({
    placeholder: 'Semua Jenis',
    allowClear: true,
    width: '100%',
    language: {
      noResults: function() {
        return "Tidak ada jenis poin ditemukan";
      },
      searching: function() {
        return "Mencari jenis poin...";
      }
    },
    ajax: {
      url: "{{ route('api.get-jenis-poin') }}",
      dataType: 'json',
      delay: 250,
      type: "GET",
      data: function(params) {
        return {
          term: params.term
        };
      },
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            return {
              text: item.kode + ' - ' + item.nama_pelanggaran + ' (' + (item.poin > 0 ? '+' : '') + item.poin + ' poin)',
              id: item.nama_pelanggaran,
              data: item
            };
          })
        };
      },
      cache: true,
      error: function() {
        console.log('Error loading jenis poin data');
      }
    }
  });

  // Search functionality
  $('#search').on('keyup', function() {
    let searchTerm = $(this).val().toLowerCase();
    filterTable();
  });

  // Filter functionality
  $('#filter_kelas, #filter_jenis').on('change', function() {
    filterTable();
  });

  // Add loading state handlers for AJAX Select2
  $('#filter_kelas').on('select2:open', function() {
    $(this).closest('.select2-container').addClass('select2-container--loading');
  });

  $('#filter_kelas').on('select2:close', function() {
    $(this).closest('.select2-container').removeClass('select2-container--loading');
  });

  $('#filter_jenis').on('select2:open', function() {
    $(this).closest('.select2-container').addClass('select2-container--loading');
  });

  $('#filter_jenis').on('select2:close', function() {
    $(this).closest('.select2-container').removeClass('select2-container--loading');
  });

  function filterTable() {
    let searchTerm = $('#search').val().toLowerCase();
    let kelasFilter = $('#filter_kelas').val();
    let jenisFilter = $('#filter_jenis').val();

    // Filter desktop table
    $('#dataTable tbody tr').each(function() {
      let row = $(this);
      let siswaNama = row.find('td:nth-child(3)').text().toLowerCase();
      let siswaNis = row.find('td:nth-child(3) small').text().toLowerCase();
      let kelas = row.find('td:nth-child(4)').text().toLowerCase();
      let jenis = row.find('td:nth-child(5)').text().toLowerCase();

      let matchesSearch = searchTerm === '' || 
        siswaNama.includes(searchTerm) || 
        siswaNis.includes(searchTerm) || 
        kelas.includes(searchTerm);

      let matchesKelas = kelasFilter === '' || kelas.includes(kelasFilter.toLowerCase());
      let matchesJenis = jenisFilter === '' || jenis.includes(jenisFilter.toLowerCase());

      if (matchesSearch && matchesKelas && matchesJenis) {
        row.show();
      } else {
        row.hide();
      }
    });

    // Filter mobile cards
    $('.mobile-card').each(function() {
      let card = $(this);
      let siswaNama = card.find('.card-header .fw-bold').text().toLowerCase();
      let siswaNis = card.find('.info-row').eq(1).find('.info-value').text().toLowerCase();
      let kelas = card.find('.card-header .badge').text().toLowerCase();
      let jenis = card.find('.info-row').eq(2).find('.info-value').text().toLowerCase();

      let matchesSearch = searchTerm === '' || 
        siswaNama.includes(searchTerm) || 
        siswaNis.includes(searchTerm) || 
        kelas.includes(searchTerm);

      let matchesKelas = kelasFilter === '' || kelas.includes(kelasFilter.toLowerCase());
      let matchesJenis = jenisFilter === '' || jenis.includes(jenisFilter.toLowerCase());

      if (matchesSearch && matchesKelas && matchesJenis) {
        card.show();
      } else {
        card.hide();
      }
    });
  }

  // Auto refresh every 30 seconds
  setInterval(function() {
    // Optional: Add auto-refresh functionality here
  }, 30000);

  // Keyboard shortcuts
  $(document).on('keydown', function(e) {
    // Ctrl+F: Focus search
    if (e.ctrlKey && e.key === 'f') {
      e.preventDefault();
      $('#search').focus().select();
    }
    
    // F5: Refresh page
    if (e.key === 'F5') {
      e.preventDefault();
      location.reload();
    }
  });

  // Add loading state to action buttons
  $('.action-buttons .btn, .actions .btn').on('click', function() {
    let btn = $(this);
    let originalHtml = btn.html();
    btn.html('<span class="loading-spinner"></span>').prop('disabled', true);
    
    // Re-enable after 2 seconds (fallback)
    setTimeout(function() {
      btn.html(originalHtml).prop('disabled', false);
    }, 2000);
  });
});
</script>
@endsection
