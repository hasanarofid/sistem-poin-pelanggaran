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
                            <div class="row mb-3">
                               
    
                                <div class="col-md-6">
                                    <label for="filter-pengawas">Filter Bulan:</label>
                                    <select
                                    id="filter-bln"
                                    name="bln"
                                    class="select2 form-select"
                                    required
                                >
                                    <option value="all">All</option> <!-- Option to show all records -->
                                    @foreach($months as $month)
                                        <option value="{{ $month['name'] }}">
                                            {{ $month['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                </div>

                                <div class="col-md-6">
                                    <label for="filter-tahun">Filter Tahun:</label>
                                    <select
                                        id="filter-tahun"
                                        name="tahun"
                                        class="select2 form-select"
                                        required
                                    >
                                        <option value="all">All</option> <!-- Option to show all records -->
                                        @foreach($years as $year)
                                            <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                
                                </div>
                                
                            </div>
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
                            <div class="row mb-3">
                              
                                <div class="col-md-12">
                                  
                                    <label for="filter-pengawas">Filter by Pengawas:</label>
                                    <select
                                    id="filter-pengawas"
                                    name="pengawas"
                                    class="select2 form-select"
                                    required
                                >
                                    <option value="all">All</option> <!-- Option to show all records -->
                                    @foreach ($listPengawas as $item)
                                        <option value="{{ $item->id }}">{{ $item->name.' - '.$item->nip }}</option>
                                    @endforeach
                                </select>
                                </div>
                                
                                
                            </div>
                            <canvas id="umpanbalikChart"></canvas> <!-- Canvas for the chart -->
                          </div>
                    </div>
                </div>

               


            </div>
            <div class="row mt-4">
                 {{-- begin spider web --}}
                 <div class="col-lg-6">
                    <div class="card">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Spider Web Profile Pengawas </h6>
                      </div>
                          <div class="card-body p-3">
                            <div class="row mb-3">
                              
                                <div class="col-md-12">
                                  
                                    <label for="filter-pengawas">Filter by Pengawas:</label>
                                    <select
                                    id="filter-pengawas2"
                                    name="pengawas"
                                    class="select2 form-select"
                                    required
                                >
                                    <option value="all">All</option> <!-- Option to show all records -->
                                    @foreach ($listPengawas as $item)
                                        <option value="{{ $item->id }}">{{ $item->name.' - '.$item->nip }}</option>
                                    @endforeach
                                </select>
                                </div>
                                
                                
                            </div>
                            <canvas id="spiderWebPengawas"></canvas> <!-- Canvas for the chart -->
                          </div>
                    </div>
                </div>

                {{-- end spider web --}}
            </div>

        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js library -->
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#filter-pengawas').select2();
        $('#filter-bln').select2();
        $('#filter-tahun').select2();
   
        let pengawasChartInstance = null;

function fetchChartData(month = 'all', year = 'all') {
    fetch(`{{ route('admin.chartData') }}?bln=${month}&tahun=${year}`)
        .then(response => response.json())
        .then(data => {
            // Check if data is empty
            if (!data || data.length === 0) {
                console.warn('No data available for the chart');
                
                // Destroy the existing chart instance if it exists
                if (pengawasChartInstance) {
                    pengawasChartInstance.destroy();
                }

                // Display a "No data available" message in the canvas
                const ctx = document.getElementById('pengawasChart').getContext('2d');
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Clear previous content
                ctx.font = '16px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('No data available for the chart', ctx.canvas.width / 2, ctx.canvas.height / 2);

                return; // Exit early as there’s no data to display in the chart
            }

            const pengawasNames = data.map(item => item.pengawas);
            const rencanaCounts = data.map(item => item.total);

            // Destroy the existing chart instance if it exists
            if (pengawasChartInstance) {
                pengawasChartInstance.destroy();
            }

            // Set up the chart and assign it to pengawasChartInstance
            const ctx = document.getElementById('pengawasChart').getContext('2d');
            pengawasChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: pengawasNames,
                    datasets: [{
                        label: 'Jumlah Rencana Kerja',
                        data: rencanaCounts,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)', 'rgba(255, 159, 64, 1)', 'rgba(153, 102, 255, 1)',
                            'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Jumlah Rencana Kerja' }
                        },
                        x: {
                            title: { display: true, text: 'Pengawas' }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching chart data:', error));
}

// Initial chart load with no filters (all data)
fetchChartData();

// Event listener for filter changes
$('#filter-bln, #filter-tahun').change(function() {
    const month = $('#filter-bln').val();
    const year = $('#filter-tahun').val();
    fetchChartData(month, year);
});


let umpanbalikChartInstance = null;

function fetchChartData2(pengawas = 'all') {
    fetch(`{{ route('admin.chartData2') }}?pengawas=${pengawas}`)
        .then(response => response.json())
        .then(data => {
            // Check if data is empty
            if (!data || data.length === 0) {
                console.warn('No data available for the chart');
                
                // Destroy the existing chart instance if it exists
                if (umpanbalikChartInstance) {
                    umpanbalikChartInstance.destroy();
                }

                // Display a "No data available" message in the canvas
                const ctx = document.getElementById('umpanbalikChart').getContext('2d');
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Clear previous content
                ctx.font = '16px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('No data available for the chart', ctx.canvas.width / 2, ctx.canvas.height / 2);

                return; // Exit early as there’s no data to display in the chart
            }

            const pengawasNames = data.map(item => item.pengawas);
            const rencanaCounts = data.map(item => item.total);

            // Destroy the existing chart instance if it exists
            if (umpanbalikChartInstance) {
                umpanbalikChartInstance.destroy();
            }

            // Set up the chart and assign it to umpanbalikChartInstance
            const ctx = document.getElementById('umpanbalikChart').getContext('2d');
            umpanbalikChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: pengawasNames,
                    datasets: [{
                        label: 'Jumlah Umpan Balik',
                        data: rencanaCounts,
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
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
}

// Initial chart load with no filters (all data)
fetchChartData2();

// Event listener for filter changes
$('#filter-pengawas').change(function() {
    const pengawas = $('#filter-pengawas').val();
    fetchChartData2(pengawas);
});

$('#filter-pengawas2').select2();

let spiderChartInstance;

// Define category colors
const categoryColors = {
    interaksi: 'rgba(54, 162, 235, 0.2)', // Light blue
    suasana: 'rgba(255, 99, 132, 0.2)', // Light red
    materi: 'rgba(75, 192, 192, 0.2)', // Light green
    komunikasi: 'rgba(153, 102, 255, 0.2)', // Light purple
    ketepatan_waktu: 'rgba(255, 159, 64, 0.2)' // Light orange
};

// Function to fetch chart data and display it
function fetchSpiderWebData(pengawas = 'all') {
    fetch(`{{ route('admin.spiderWebData') }}?pengawas=${pengawas}`)
        .then(response => response.json())
        .then(data => {
            if (spiderChartInstance) {
                spiderChartInstance.destroy();
            }

            const ctx = document.getElementById('spiderWebPengawas').getContext('2d');

            // Prepare dataset for the chart
            const dataset = {
                label: `Pengawas ${pengawas === 'all' ? 'All' : pengawas}`,
                data: [
                    data.interaksi,
                    data.suasana,
                    data.materi,
                    data.komunikasi,
                    data.ketepatan_waktu
                ],
                fill: true,
                backgroundColor: [
                    categoryColors.interaksi,
                    categoryColors.suasana,
                    categoryColors.materi,
                    categoryColors.komunikasi,
                    categoryColors.ketepatan_waktu
                ],
                borderColor: [
                    'rgb(54, 162, 235)', // Blue
                    'rgb(255, 99, 132)', // Red
                    'rgb(75, 192, 192)', // Green
                    'rgb(153, 102, 255)', // Purple
                    'rgb(255, 159, 64)' // Orange
                ],
                pointBackgroundColor: [
                    'rgb(54, 162, 235)', // Blue
                    'rgb(255, 99, 132)', // Red
                    'rgb(75, 192, 192)', // Green
                    'rgb(153, 102, 255)', // Purple
                    'rgb(255, 159, 64)' // Orange
                ],
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: [
                    'rgb(54, 162, 235)', // Blue
                    'rgb(255, 99, 132)', // Red
                    'rgb(75, 192, 192)', // Green
                    'rgb(153, 102, 255)', // Purple
                    'rgb(255, 159, 64)' // Orange
                ]
            };

            // Configure the radar chart
            spiderChartInstance = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['Interaksi', 'Suasana', 'Materi', 'Komunikasi', 'Ketepatan Waktu'],
                    datasets: [dataset]
                },
                options: {
                    responsive: true,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 4, // Set max to match your rating scale (0-4 if 'Sangat Baik' is 4)
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching spider web data:', error));
}

// Initial chart data load
fetchSpiderWebData();

// Fetch data when the pengawas filter changes
$('#filter-pengawas2').change(function() {
    const pengawas = $(this).val();
    fetchSpiderWebData(pengawas);
});


});



</script>
