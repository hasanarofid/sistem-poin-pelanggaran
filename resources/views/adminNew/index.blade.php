@extends('layouts.admin.home')
@section('title', 'Dashboard')
@section('titelcard', 'Dashboard')
@section('content')
    <div class="content-wrapper" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
        <div class="container-xxl flex-grow-1 container-p-y" style="padding: 30px !important; width: 100% !important; max-width: none !important; margin: 0 !important;">
            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0" style="font-size: 28px; font-weight: 700; color: #1f2937;">Dashboard</h1>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Siswa</h5>
                                <div class="badge p-2 rounded bg-primary">
                                    <span class="ti ti-users text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-primary">{{$total_siswa}}</h4>
                            <small class="text-muted">Siswa terdaftar</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Pelanggaran Bulan Ini</h5>
                                <div class="badge p-2 rounded bg-danger">
                                    <span class="ti ti-alert-triangle text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-danger">{{ $pelanggaran_bulan_ini }}</h4>
                            <small class="text-muted">Kasus tercatat</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Siswa Bermasalah</h5>
                                <div class="badge p-2 rounded bg-warning">
                                    <span class="ti ti-user-x text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-warning">{{ $siswa_bermasalah }}</h4>
                            <small class="text-muted">Poin ≥ 80</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Sanksi Aktif</h5>
                                <div class="badge p-2 rounded bg-secondary">
                                    <span class="ti ti-gavel text-white"></span>
                                </div>
                            </div>
                            <h4 class="mb-0 text-secondary">{{ $sanksi_aktif }}</h4>
                            <small class="text-muted">Poin ≥ 30</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Sections -->
            <div class="row mb-4">
                <!-- Trend Pelanggaran Chart -->
                <div class="col-xl-12 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Trend Pelanggaran Mingguan</h5>
                            <small class="text-muted">
                                <i class="ti ti-refresh me-1"></i>
                                Update otomatis
                            </small>
                        </div>
                        <div class="card-body">
                            <canvas id="trendChart" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pelanggaran Hari Ini -->
                <div class="col-xl-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Pelanggaran Hari Ini</h5>
                            <small class="text-danger">
                                <i class="ti ti-circle-filled me-1" style="font-size: 8px;"></i>
                                Real-time
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($pelanggaran_hari_ini as $pelanggaran)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $pelanggaran->siswa->nama ?? 'N/A' }} - {{ $pelanggaran->siswa->kelas->subkelas ?? 'N/A' }}</h6>
                                            <p class="mb-1 text-muted">{{ $pelanggaran->jenispelanggaran->nama_pelanggaran ?? 'N/A' }}</p>
                                            <small class="text-muted">{{ $pelanggaran->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <span class="badge bg-danger">{{ $pelanggaran->jenispelanggaran->poin ?? 0 }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada pelanggaran hari ini</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reward Hari Ini -->
                <div class="col-xl-6 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Penghargaan Hari Ini</h5>
                            <small class="text-success">
                                <i class="ti ti-circle-filled me-1" style="font-size: 8px;"></i>
                                Real-time
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($reward_hari_ini as $reward)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $reward->siswa->nama ?? 'N/A' }} - {{ $reward->siswa->kelas->subkelas ?? 'N/A' }}</h6>
                                            <p class="mb-1 text-muted">{{ $reward->jenispelanggaran->nama_pelanggaran ?? 'N/A' }}</p>
                                            <small class="text-muted">{{ $reward->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <span class="badge bg-success">+{{ $reward->jenispelanggaran->poin ?? 0 }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada Penghargaan hari ini</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sisi Pelanggaran -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="mb-3" style="color: #dc2626; font-weight: 600;">
                        <i class="ti ti-alert-triangle me-2"></i>Sisi Pelanggaran
                    </h4>
                </div>
            </div>
            
            <div class="row mb-4">
                <!-- Kelas dengan Pelanggar Terbanyak -->
                <div class="col-xl-6 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kelas dengan Pelanggar Terbanyak</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($kelas_pelanggar_terbanyak as $index => $kelas)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $index + 1 }}. {{ $kelas->kelas ?? 'N/A' }}</span>
                                        <span class="badge bg-danger">{{ $kelas->jumlah_siswa }} siswa</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada data</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Trend Pelanggaran dengan Pelanggar Terbanyak -->
                <div class="col-xl-6 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Trend Pelanggaran Mingguan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="trendPelanggaranChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Siswa dengan Pelanggaran Terbanyak -->
                <div class="col-xl-6 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Siswa dengan Pelanggaran Terbanyak</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($siswa_pelanggaran_terbanyak as $index => $siswa)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span>{{ $index + 1 }}. {{ $siswa->nama ?? 'N/A' }}</span>
                                            <br><small class="text-muted">{{ $siswa->kelas ?? 'N/A' }}</small>
                                        </div>
                                        <span class="badge bg-danger">{{ $siswa->jumlah_pelanggaran }}x</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada data</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Top Pelanggaran -->
                 <div class="col-xl-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Top Pelanggaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($top_pelanggaran as $index => $pelanggaran)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $index + 1 }}. {{ $pelanggaran->nama_pelanggaran ?? 'N/A' }}</span>
                                        <span class="badge bg-danger">{{ $pelanggaran->jumlah }}x</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada data</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sisi Reward -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="mb-3" style="color: #059669; font-weight: 600;">
                        <i class="ti ti-award me-2"></i>Sisi Penghargaan
                    </h4>
                </div>
            </div>
            
            <div class="row mb-4">
                
                
                <!-- Kelas dengan Reward Terbanyak -->
                <div class="col-xl-6 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kelas dengan Penghargaan Terbanyak</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($kelas_reward_terbanyak as $index => $kelas)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $index + 1 }}. {{ $kelas->kelas ?? 'N/A' }}</span>
                                        <span class="badge bg-success">{{ $kelas->jumlah_siswa }} siswa</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada data</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Trend Reward dengan Penerima Terbanyak -->
                <div class="col-xl-6 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Trend Penghargaan Mingguan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="trendRewardChart" height="150"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Siswa dengan Reward Positif Terbanyak -->
                <div class="col-xl-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Siswa dengan Penghargaan Terbanyak</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($siswa_reward_terbanyak as $index => $siswa)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span>{{ $index + 1 }}. {{ $siswa->nama ?? 'N/A' }}</span>
                                            <br><small class="text-muted">{{ $siswa->kelas ?? 'N/A' }}</small>
                                        </div>
                                        <span class="badge bg-success">{{ $siswa->jumlah_reward }}x</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada data</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top Pelanggaran -->
                <div class="col-xl-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Top Penghargaan</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @forelse($top_penghargaan as $index => $penghargaan)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $index + 1 }}. {{ $penghargaan->nama_pelanggaran ?? 'N/A' }}</span>
                                        <span class="badge bg-success">{{ $penghargaan->jumlah }}x</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <p class="text-muted">Tidak ada data</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trend Chart (Main)
           // Ganti bagian trendChart dengan:
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            const trendData = @json($trend_combined);

            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: trendData.map(item => item.day),
                    datasets: [
                        {
                            label: 'Pelanggaran',
                            data: trendData.map(item => item.pelanggaran),
                            borderColor: '#dc2626',
                            backgroundColor: 'rgba(220, 38, 38, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Penghargaan',
                            data: trendData.map(item => item.penghargaan),
                            borderColor: '#059669',
                            backgroundColor: 'rgba(5, 150, 105, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

           // Trend Pelanggaran Chart - Ganti dengan:
            const trendPelanggaranCtx = document.getElementById('trendPelanggaranChart').getContext('2d');
            const topPelanggaranData = @json($top_pelanggaran_minggu);

            new Chart(trendPelanggaranCtx, {
                type: 'bar',
                data: {
                    labels: topPelanggaranData.map(item => item.kode || item.nama_pelanggaran),
                    datasets: [{
                        label: 'Jumlah Pelanggaran',
                        data: topPelanggaranData.map(item => item.jumlah),
                        backgroundColor: 'rgba(220, 38, 38, 0.8)',
                        borderColor: '#dc2626',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    const index = context[0].dataIndex;
                                    return topPelanggaranData[index].nama_pelanggaran;
                                },
                                label: function(context) {
                                    return 'Jumlah: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    }
                }
            });

            // Trend Reward Chart - Ganti dengan:
            const trendRewardCtx = document.getElementById('trendRewardChart').getContext('2d');
            const topRewardData = @json($top_reward_minggu);

            new Chart(trendRewardCtx, {
                type: 'bar',
                data: {
                    labels: topRewardData.map(item => item.kode || item.nama_pelanggaran),
                    datasets: [{
                        label: 'Jumlah Penghargaan',
                        data: topRewardData.map(item => item.jumlah),
                        backgroundColor: 'rgba(5, 150, 105, 0.8)',
                        borderColor: '#059669',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    const index = context[0].dataIndex;
                                    return topRewardData[index].nama_pelanggaran;
                                },
                                label: function(context) {
                                    return 'Jumlah: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    }
                }
            });

        });
    </script>
@endsection