@extends('layouts.admin.home')
@section('title', 'Detail Input Poin')
@section('titelcard', 'Detail Input Poin')
@section('content')
<style>
.detail-card {
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  border: none;
}

.detail-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-radius: 12px 12px 0 0;
  padding: 1.5rem;
}

.detail-body {
  padding: 2rem;
}

.info-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
  border-bottom: 1px solid #e5e7eb;
}

.info-item:last-child {
  border-bottom: none;
}

.info-label {
  font-weight: 600;
  color: #374151;
  flex: 1;
}

.info-value {
  color: #6b7280;
  flex: 2;
  text-align: right;
}

.point-badge {
  font-size: 1.25rem;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-weight: 700;
}

.point-positive {
  background-color: #d1fae5;
  color: #065f46;
}

.point-negative {
  background-color: #fee2e2;
  color: #991b1b;
}

.student-info {
  background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
  border-radius: 8px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

.student-avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 2rem;
  margin: 0 auto 1rem;
}

.action-buttons {
  display: flex;
  gap: 0.5rem;
  justify-content: center;
  margin-top: 2rem;
}

.action-buttons .btn {
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  border-radius: 8px;
}

.back-button {
  background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
  border: none;
  color: white;
}

.edit-button {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  border: none;
  color: white;
}

.timeline {
  position: relative;
  padding-left: 2rem;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 0.75rem;
  top: 0;
  bottom: 0;
  width: 2px;
  background: linear-gradient(to bottom, #667eea, #764ba2);
}

.timeline-item {
  position: relative;
  margin-bottom: 1.5rem;
}

.timeline-item::before {
  content: '';
  position: absolute;
  left: -1.75rem;
  top: 0.5rem;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #667eea;
  border: 3px solid white;
  box-shadow: 0 0 0 2px #667eea;
}

.timeline-content {
  background: white;
  border-radius: 8px;
  padding: 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-left: 4px solid #667eea;
}

.timeline-title {
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.timeline-meta {
  font-size: 0.875rem;
  color: #6b7280;
}

.breadcrumb {
  background: none;
  padding: 0;
  margin-bottom: 1.5rem;
}

.breadcrumb-item a {
  color: #667eea;
  text-decoration: none;
}

.breadcrumb-item a:hover {
  color: #5a2d91;
  text-decoration: underline;
}

.breadcrumb-item.active {
  color: #6b7280;
}
</style>

<div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
  <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.list-input-poin.index') }}">List Input Poin</a></li>
        <li class="breadcrumb-item active">Detail Input Poin</li>
      </ol>
    </nav>

    <!-- Header Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Detail Input Poin</h1>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.list-input-poin.index') }}" class="btn btn-secondary">
          <i class="ti ti-arrow-left me-2"></i>Kembali
        </a>
        <a href="{{ route('admin.list-input-poin.edit', $inputPelanggaran->id) }}" class="btn btn-warning">
          <i class="ti ti-edit me-2"></i>Edit
        </a>
      </div>
    </div>

    <div class="row">
      <!-- Main Detail Card -->
      <div class="col-lg-8">
        <div class="card detail-card">
          <div class="detail-header">
            <h4 class="mb-0"><i class="ti ti-info-circle me-2"></i>Informasi Input Poin</h4>
          </div>
          <div class="detail-body">
            <div class="info-item">
              <span class="info-label">ID Input Poin</span>
              <span class="info-value fw-bold">#{{ $inputPelanggaran->id }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Tanggal Input</span>
              <span class="info-value">{{ $inputPelanggaran->created_at->format('d F Y, H:i') }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Jenis Poin</span>
              <span class="info-value fw-bold">{{ $inputPelanggaran->jenispelanggaran->nama_pelanggaran }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Kategori</span>
              <span class="info-value">{{ $inputPelanggaran->jenispelanggaran->kategori->nama_kategori ?? '-' }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Poin</span>
              <span class="info-value">
                <span class="point-badge {{ $inputPelanggaran->jenispelanggaran->poin > 0 ? 'point-positive' : 'point-negative' }}">
                  {{ $inputPelanggaran->jenispelanggaran->poin > 0 ? '+' : '' }}{{ $inputPelanggaran->jenispelanggaran->poin }}
                </span>
              </span>
            </div>
            <div class="info-item">
              <span class="info-label">Keterangan</span>
              <span class="info-value">{{ $inputPelanggaran->keterangan ?: 'Tidak ada keterangan' }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Pelapor</span>
              <span class="info-value">
                <div class="d-flex flex-column">
                  <span class="fw-bold">{{ $inputPelanggaran->pelapor->name ?? 'Tidak diketahui' }}</span>
                  <small class="text-muted">ID: {{ $inputPelanggaran->pelapor_id }}</small>
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Student Info Card -->
      <div class="col-lg-4">
        <div class="card detail-card">
          <div class="detail-header">
            <h4 class="mb-0"><i class="ti ti-user me-2"></i>Informasi Siswa</h4>
          </div>
          <div class="detail-body">
            <div class="student-info text-center">
              <div class="student-avatar">
                <i class="ti ti-user"></i>
              </div>
              <h5 class="mb-1">{{ $inputPelanggaran->siswa->nama }}</h5>
              <p class="mb-1 text-muted">NIS: {{ $inputPelanggaran->siswa->nis }}</p>
              <p class="mb-0">
                <span class="badge bg-primary">{{ $inputPelanggaran->siswa->kelas->subkelas ?? '-' }}</span>
              </p>
            </div>
            
            <div class="info-item">
              <span class="info-label">Poin Saat Ini</span>
              <span class="info-value fw-bold text-primary">
                {{ $inputPelanggaran->siswa->point ? $inputPelanggaran->siswa->point->total_poin : 100 }}
              </span>
            </div>
            <div class="info-item">
              <span class="info-label">Jenis Kelamin</span>
              <span class="info-value">{{ ucfirst($inputPelanggaran->siswa->jenis_kelamin) }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Status</span>
              <span class="info-value">
                <span class="badge {{ $inputPelanggaran->siswa->status ? 'bg-success' : 'bg-danger' }}">
                  {{ $inputPelanggaran->siswa->status ? 'Aktif' : 'Tidak Aktif' }}
                </span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Timeline Card -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card detail-card">
          <div class="detail-header">
            <h4 class="mb-0"><i class="ti ti-clock me-2"></i>Riwayat Perubahan</h4>
          </div>
          <div class="detail-body">
            <div class="timeline">
              <div class="timeline-item">
                <div class="timeline-content">
                  <div class="timeline-title">Input Poin Dibuat</div>
                  <div class="timeline-meta">
                    {{ $inputPelanggaran->created_at->format('d F Y, H:i') }} 
                    oleh {{ $inputPelanggaran->pelapor->name ?? 'Pelapor ID: ' . $inputPelanggaran->pelapor_id }}
                  </div>
                </div>
              </div>
              
              @if($inputPelanggaran->updated_at != $inputPelanggaran->created_at)
              <div class="timeline-item">
                <div class="timeline-content">
                  <div class="timeline-title">Input Poin Diperbarui</div>
                  <div class="timeline-meta">
                    {{ $inputPelanggaran->updated_at->format('d F Y, H:i') }}
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
      <a href="{{ route('admin.list-input-poin.index') }}" class="btn back-button">
        <i class="ti ti-arrow-left me-2"></i>Kembali ke List
      </a>
      <a href="{{ route('admin.list-input-poin.edit', $inputPelanggaran->id) }}" class="btn edit-button">
        <i class="ti ti-edit me-2"></i>Edit Input Poin
      </a>
    </div>

  </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
  // Add smooth scrolling for anchor links
  $('a[href^="#"]').on('click', function(event) {
    var target = $(this.getAttribute('href'));
    if (target.length) {
      event.preventDefault();
      $('html, body').stop().animate({
        scrollTop: target.offset().top - 100
      }, 1000);
    }
  });

  // Add loading state to action buttons
  $('.action-buttons .btn').on('click', function() {
    let btn = $(this);
    let originalHtml = btn.html();
    btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Loading...').prop('disabled', true);
    
    // Re-enable after 3 seconds (fallback)
    setTimeout(function() {
      btn.html(originalHtml).prop('disabled', false);
    }, 3000);
  });

  // Keyboard shortcuts
  $(document).on('keydown', function(e) {
    // Escape: Go back
    if (e.key === 'Escape') {
      window.location.href = "{{ route('admin.list-input-poin.index') }}";
    }
    
    // Ctrl+E: Edit
    if (e.ctrlKey && e.key === 'e') {
      e.preventDefault();
      window.location.href = "{{ route('admin.list-input-poin.edit', $inputPelanggaran->id) }}";
    }
  });
});
</script>
@endsection
