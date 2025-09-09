@extends('layouts.dashboard')
@section('title','Dashboard')

@section('content')
<div class="page-title">Dashboard</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Total Siswa</div>
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-value">4</div>
        <div class="stat-description">Siswa terdaftar</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Pelanggaran Bulan Ini</div>
            <div class="stat-icon red">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
        <div class="stat-value">0</div>
        <div class="stat-description">Kasus tercatat</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Siswa Bermasalah</div>
            <div class="stat-icon orange">
                <i class="fas fa-user-times"></i>
            </div>
        </div>
        <div class="stat-value">2</div>
        <div class="stat-description">Poin ≥ 20</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">Sanksi Aktif</div>
            <div class="stat-icon purple">
                <i class="fas fa-gavel"></i>
            </div>
        </div>
        <div class="stat-value">1</div>
        <div class="stat-description">Poin ≥ 30</div>
    </div>
</div>

<!-- Main Sections -->
<div class="main-sections">
    <!-- Statistik Pelanggaran -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-title">Statistik Pelanggaran</div>
            <div class="section-subtitle">
                <i class="fas fa-sync-alt"></i>
                Update otomatis
            </div>
        </div>
        <div class="chart-placeholder">
            No data available for the chart
        </div>
    </div>
    
    <!-- Pelanggaran Terbaru -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-title">Pelanggaran Terbaru</div>
            <div class="section-subtitle">
                <i class="fas fa-circle" style="color: #10b981; font-size: 8px;"></i>
                Real-time
            </div>
        </div>
        
        <div class="list-item">
            <div>
                <div class="list-text" style="font-weight: 600;">Ahmad Rizki - XII RPL 1</div>
                <div class="list-text" style="font-size: 12px; color: #6b7280;">Terlambat masuk kelas - Wali Kelas XII RPL 1</div>
                <div class="list-text" style="font-size: 12px; color: #6b7280;">15/11/2024</div>
            </div>
            <div style="background: #dc2626; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                +5
            </div>
        </div>
        
        <div class="list-item">
            <div>
                <div class="list-text" style="font-weight: 600;">Siti Nurhaliza - XI BD 2</div>
                <div class="list-text" style="font-size: 12px; color: #6b7280;">Mengganggu teman - Wali Kelas XI BD 2</div>
                <div class="list-text" style="font-size: 12px; color: #6b7280;">12/11/2024</div>
            </div>
            <div style="background: #dc2626; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                +15
            </div>
        </div>
        
        <div class="list-item">
            <div>
                <div class="list-text" style="font-weight: 600;">Ahmad Rizki - XII RPL 1</div>
                <div class="list-text" style="font-size: 12px; color: #6b7280;">Tidak mengerjakan tugas - Wali Kelas XII RPL 1</div>
                <div class="list-text" style="font-size: 12px; color: #6b7280;">10/11/2024</div>
            </div>
            <div style="background: #dc2626; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                +10
            </div>
        </div>
    </div>
</div>

<!-- Bottom Cards -->
<div class="bottom-cards">
    <div class="bottom-card">
        <div class="bottom-card-title">Top Pelanggaran</div>
        <div class="list-item">
            <div class="list-text">1 Terlambat masuk kelas 1x</div>
        </div>
        <div class="list-item">
            <div class="list-text">2 Mengganggu teman 1x</div>
        </div>
        <div class="list-item">
            <div class="list-text">3 Tidak mengerjakan tugas 1x</div>
        </div>
    </div>
    
    <div class="bottom-card">
        <div class="bottom-card-title">Kelas Bermasalah</div>
        <div class="list-item">
            <div class="list-text">1 XI BD 2 1 siswa</div>
        </div>
        <div class="list-item">
            <div class="list-text">2 XII DPIB 1 1 siswa</div>
        </div>
    </div>
    
    <div class="bottom-card">
        <div class="bottom-card-title">Trend Mingguan</div>
        <div style="display: flex; justify-content: space-between; align-items: end; height: 120px; margin-top: 10px;">
            <div style="text-align: center;">
                <div style="width: 20px; height: 0px; background: #e5e7eb; margin: 0 auto 5px;"></div>
                <div style="font-size: 12px; color: #6b7280;">Rab</div>
            </div>
            <div style="text-align: center;">
                <div style="width: 20px; height: 0px; background: #e5e7eb; margin: 0 auto 5px;"></div>
                <div style="font-size: 12px; color: #6b7280;">Kam</div>
            </div>
            <div style="text-align: center;">
                <div style="width: 20px; height: 0px; background: #e5e7eb; margin: 0 auto 5px;"></div>
                <div style="font-size: 12px; color: #6b7280;">Jum</div>
            </div>
            <div style="text-align: center;">
                <div style="width: 20px; height: 0px; background: #e5e7eb; margin: 0 auto 5px;"></div>
                <div style="font-size: 12px; color: #6b7280;">Sab</div>
            </div>
            <div style="text-align: center;">
                <div style="width: 20px; height: 0px; background: #e5e7eb; margin: 0 auto 5px;"></div>
                <div style="font-size: 12px; color: #6b7280;">Min</div>
            </div>
        </div>
    </div>
</div>
@endsection