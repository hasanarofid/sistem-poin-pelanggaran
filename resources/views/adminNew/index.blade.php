@extends('layouts.admin.home')
@section('title', 'Dashboard')
@section('titelcard', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Sekolah</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-success waves-effect waves-light">
                                        <span class="ti ti-school"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_sekolah }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Pengawas</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-info waves-effect waves-light">
                                        <span class="ti ti-user"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_pengawas }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Rencana Kerja</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-danger waves-effect waves-light">
                                        <span class="ti ti-eye"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_rencankerja }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-1 pt-2">Total Umpan Balik</h5>
                                <div class="badge p-2 rounded">
                                    <button type="button" class="btn btn-icon btn-primary waves-effect waves-light">
                                        <span class="ti ti-briefcase"></span>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-0">{{ $total_umpanbalik }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
   
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Grafik Jumlah Rencana per pengawas </h6>
                    </div>
                        <div class="card-body p-3">
                            <canvas id="pengawasChart"></canvas> <!-- Canvas for the chart -->
                        </div>
                  </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Grafik umpan balik per pengawas </h6>
                      </div>
                          <div class="card-body p-3">
                            <canvas id="umpanbalikChart"></canvas> <!-- Canvas for the chart -->
                          </div>
                    </div>
                  </div>

            </div>

        </div>
    </div>
@endsection


@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js library -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch data for the first chart (Jumlah Rencana Kerja)
    fetch("{{ route('admin.chartData') }}")
        .then(response => response.json())
        .then(data => {
            const pengawasNames = data.map(item => item.pengawas);
            const rencanaCounts = data.map(item => item.total);

            // Set up the first chart
            const ctx = document.getElementById('pengawasChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: pengawasNames,
                    datasets: [{
                        label: 'Jumlah Rencana Kerja',
                        data: rencanaCounts,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)', // Color for each bar
                            'rgba(255, 159, 64, 0.2)', // Color for each bar
                            'rgba(153, 102, 255, 0.2)', // Color for each bar
                            'rgba(255, 99, 132, 0.2)', // Color for each bar
                            'rgba(54, 162, 235, 0.2)', // Color for each bar
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',  // Border color
                            'rgba(255, 159, 64, 1)',  // Border color
                            'rgba(153, 102, 255, 1)', // Border color
                            'rgba(255, 99, 132, 1)',  // Border color
                            'rgba(54, 162, 235, 1)',  // Border color
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Rencana Kerja'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Pengawas'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching chart data:', error));

    // Fetch data for the second chart (Jumlah Umpan Balik)
    fetch("{{ route('admin.chartData2') }}")
        .then(response => response.json())
        .then(data => {
            const pengawasNames = data.map(item => item.pengawas);
            const rencanaCounts = data.map(item => item.total);

            // Set up the second chart
            const ctx = document.getElementById('umpanbalikChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: pengawasNames,
                    datasets: [{
                        label: 'Jumlah Umpan Balik',
                        data: rencanaCounts,
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.2)', // Color for each bar
                            'rgba(255, 159, 64, 0.2)',  // Color for each bar
                            'rgba(75, 192, 192, 0.2)',  // Color for each bar
                            'rgba(255, 99, 132, 0.2)',  // Color for each bar
                            'rgba(54, 162, 235, 0.2)',  // Color for each bar
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',  // Border color
                            'rgba(255, 159, 64, 1)',   // Border color
                            'rgba(75, 192, 192, 1)',   // Border color
                            'rgba(255, 99, 132, 1)',   // Border color
                            'rgba(54, 162, 235, 1)',   // Border color
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Umpan Balik'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Pengawas'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching chart data:', error));
});
</script>
