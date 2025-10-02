@if($inputPelanggaranT->count() > 0)
  <!-- Desktop Table -->
  <div class="table-responsive d-none d-md-block">
    <table class="table table-hover" id="dataTable">
      <thead>
        <tr>
          <th>NO</th>
          <th>TANGGAL</th>
          <th>SISWA</th>
          <th>KELAS</th>
          <th>JENIS POIN</th>
          <th>POIN</th>
          <th>KETERANGAN</th>
          <th>PELAPOR</th>
          <th>AKSI</th>
        </tr>
      </thead>
      <tbody>
        @foreach($inputPelanggaranT as $index => $item)
        <tr>
          <td>{{ $inputPelanggaranT->firstItem() + $index }}</td>
          <td>
            <span class="fw-medium">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</span><br>
            <small class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</small>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="avatar avatar-sm me-2">
                <span class="avatar-initial rounded-circle bg-primary">{{ substr($item->siswa->nama, 0, 1) }}</span>
              </div>
              <div>
                <span class="fw-medium">{{ $item->siswa->nama }}</span><br>
                <small class="text-muted">NIS: {{ $item->siswa->nis }}</small>
              </div>
            </div>
          </td>
          <td>
            <span class="badge bg-info">{{ $item->siswa->kelas->nama_kelas }} - {{ $item->siswa->kelas->subkelas }}</span>
          </td>
          <td>
            <div>
              <span class="fw-medium">{{ $item->jenispelanggaran->kode }} - {{ $item->jenispelanggaran->nama_pelanggaran }}</span><br>
              <small class="text-muted">{{ $item->jenispelanggaran->kategori->nama_kategori }}</small>
            </div>
          </td>
          <td>
            <span class="badge {{ $item->jenispelanggaran->poin > 0 ? 'bg-success' : 'bg-danger' }}">
              {{ $item->jenispelanggaran->poin > 0 ? '+' : '' }}{{ $item->jenispelanggaran->poin }}
            </span>
          </td>
          <td>
            <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $item->keterangan }}">
              {{ $item->keterangan ?: '-' }}
            </span>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xs me-2">
                <span class="avatar-initial rounded-circle bg-secondary">{{ substr($item->pelapor->name, 0, 1) }}</span>
              </div>
              <span class="fw-medium">{{ $item->pelapor->name }}</span>
            </div>
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.list-input-poin.show', $item->id) }}" 
                 class="btn btn-info btn-sm">
                <i class="ti ti-eye"></i>
              </a>
              <a href="{{ route('admin.list-input-poin.edit', $item->id) }}" 
                 class="btn btn-warning btn-sm">
                <i class="ti ti-edit"></i>
              </a>
              <button type="button" 
                      class="btn btn-danger btn-sm delete-btn" 
                      data-id="{{ $item->id }}"
                      data-siswa="{{ $item->siswa->nama }}"
                      data-poin="{{ $item->jenispelanggaran->poin }}"
                      data-jenis="{{ $item->jenispelanggaran->nama_pelanggaran }}">
                <i class="ti ti-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Mobile Cards -->
  <div class="d-block d-md-none">
    <div class="row">
      @foreach($inputPelanggaranT as $index => $item)
      <div class="col-12 mb-3 mobile-card">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h6 class="fw-bold mb-0">{{ $item->siswa->nama }}</h6>
              <span class="badge bg-info">{{ $item->siswa->kelas->nama_kelas }} - {{ $item->siswa->kelas->subkelas }}</span>
            </div>
            <span class="badge {{ $item->jenispelanggaran->poin > 0 ? 'bg-success' : 'bg-danger' }}">
              {{ $item->jenispelanggaran->poin > 0 ? '+' : '' }}{{ $item->jenispelanggaran->poin }}
            </span>
          </div>
          <div class="card-body">
            <div class="info-row mb-2">
              <div class="d-flex justify-content-between">
                <span class="text-muted">Tanggal:</span>
                <span class="fw-medium">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</span>
              </div>
            </div>
            <div class="info-row mb-2">
              <div class="d-flex justify-content-between">
                <span class="text-muted">NIS:</span>
                <span class="info-value">{{ $item->siswa->nis }}</span>
              </div>
            </div>
            <div class="info-row mb-2">
              <div class="d-flex justify-content-between">
                <span class="text-muted">Jenis Poin:</span>
                <span class="info-value">{{ $item->jenispelanggaran->kode }} - {{ $item->jenispelanggaran->nama_pelanggaran }}</span>
              </div>
            </div>
            @if($item->keterangan)
            <div class="info-row mb-2">
              <div class="d-flex justify-content-between">
                <span class="text-muted">Keterangan:</span>
                <span class="info-value">{{ $item->keterangan }}</span>
              </div>
            </div>
            @endif
            <div class="info-row mb-2">
              <div class="d-flex justify-content-between">
                <span class="text-muted">Pelapor:</span>
                <span class="info-value">{{ $item->pelapor->name }}</span>
              </div>
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
              <button type="button" 
                      class="btn btn-danger btn-sm delete-btn" 
                      data-id="{{ $item->id }}"
                      data-siswa="{{ $item->siswa->nama }}"
                      data-poin="{{ $item->jenispelanggaran->poin }}"
                      data-jenis="{{ $item->jenispelanggaran->nama_pelanggaran }}">
                <i class="ti ti-trash me-1"></i>Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
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
