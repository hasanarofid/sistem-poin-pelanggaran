@extends('layouts.pengawas.home')
@section('title','Login')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      @if(Session::has('success'))
      <div class="alert alert-success">
          {{ Session::get('success') }}
      </div>
      {{ Session::forget('success') }}
  @endif
  <div class="row">
    <div class="col-6 col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Grafik Rencana Kerja</h5>
                    <small class="text-muted">Pengawas: {{ Auth::user()->name }}</small>
                </div>
            </div>
            <div class="card-body">
                <canvas id="lineChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Grafik Rencana Kerja per sekolah</h5>
                    <small class="text-muted">Pengawas: {{ Auth::user()->name }}</small>
                </div>
            </div>
            <div class="card-body">
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>



    

    <div class="content-backdrop fade"></div>
  </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var dates = {!! $dates->toJson() !!};
  var jumlahRencanaKerja = {!! $jumlahRencanaKerja !!};
  var rencanaPerSekolah = {!! $rencanaPerSekolah->toJson() !!};

  var lineChartCtx = document.getElementById('lineChart').getContext('2d');
  var lineChart = new Chart(lineChartCtx, {
      type: 'line',
      data: {
          labels: dates,
          datasets: [{
              label: 'Jumlah Rencana Kerja',
              data: jumlahRencanaKerja,
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
          }]
      }
  });

  var barChartCtx = document.getElementById('barChart').getContext('2d');
  var barChart = new Chart(barChartCtx, {
      type: 'bar',
      data: {
          labels: Object.keys(rencanaPerSekolah),
          datasets: [{
              label: 'Jumlah Rencana Kerja',
              data: Object.values(rencanaPerSekolah),
              backgroundColor: 'rgba(255, 99, 132, 0.2)',
              borderColor: 'rgba(255, 99, 132, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>


@endsection