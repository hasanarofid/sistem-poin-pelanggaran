<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') | Sistem Poin Pelanggaran</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('logopoint.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logopoint.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo-container {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 10px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .logo-icon::before {
            content: '';
            width: 30px;
            height: 30px;
            background: #3b82f6;
            border-radius: 4px;
            position: relative;
        }
        
        .logo-icon::after {
            content: '';
            position: absolute;
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 6px;
            background: #3b82f6;
            border-radius: 2px 2px 0 0;
        }
        
        .logo-title {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
        }
        
        .logo-subtitle {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 10px;
        }
        
        .logo-description {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Navigation */
        .nav-menu {
            padding: 20px 0;
        }
        
        .nav-item {
            margin: 5px 15px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }
        
        .nav-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            background: white;
        }
        
        /* Header */
        .header {
            background: white;
            padding: 20px 30px 20px 30px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .header-logo {
            display: flex;
            align-items: center;
            margin-right: 30px;
        }
        
        .header-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            border-radius: 8px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .header-logo-icon::before {
            content: '';
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 3px;
            position: relative;
        }
        
        .header-logo-icon::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 50%;
            transform: translateX(-50%);
            width: 16px;
            height: 5px;
            background: white;
            border-radius: 1px 1px 0 0;
        }
        
        .header-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 30px;
            justify-content: flex-end;
        }
        
        .user-info {
            text-align: right;
            margin-right: 10px;
        }
        
        .user-role {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 2px;
        }
        
        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }
        
        .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 10px;
        }
        
        .logout-btn:hover {
            background: #b91c1c;
        }
        
        /* Content Area */
        .content {
            padding: 30px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 30px;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .stat-title {
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }
        
        .stat-icon.blue {
            background: #3b82f6;
        }
        
        .stat-icon.red {
            background: #dc2626;
        }
        
        .stat-icon.orange {
            background: #ea580c;
        }
        
        .stat-icon.purple {
            background: #7c3aed;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }
        
        .stat-description {
            font-size: 14px;
            color: #6b7280;
        }
        
        /* Main Sections */
        .main-sections {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .section-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }
        
        .section-subtitle {
            font-size: 12px;
            color: #6b7280;
            display: flex;
            align-items: center;
        }
        
        .section-subtitle i {
            margin-right: 5px;
        }
        
        /* Bottom Cards */
        .bottom-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        
        .bottom-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .bottom-card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 15px;
        }
        
        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .list-item:last-child {
            border-bottom: none;
        }
        
        .list-text {
            font-size: 14px;
            color: #374151;
        }
        
        .list-value {
            font-size: 12px;
            color: #6b7280;
        }
        
        /* Chart Placeholder */
        .chart-placeholder {
            height: 200px;
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 14px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-sections {
                grid-template-columns: 1fr;
            }
            
            .bottom-cards {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    @yield('styles')
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <div class="logo-icon"></div>
                    <div class="logo-title">SISTEM MODIP</div>
                    <div class="logo-subtitle">MONITORING DIGITAL PENGAWAS</div>
                    <div class="logo-description">PENGEMBANGAN DARI DILAPLAH</div>
                </div>
            </div>
            
            <nav class="nav-menu">
                <div class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        Dashboard
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        Master Data
                        <i class="fas fa-chevron-right ml-auto"></i>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        Master Simodip
                        <i class="fas fa-chevron-right ml-auto"></i>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        List Rencana Kerja
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        Umpan Balik
                        <i class="fas fa-chevron-right ml-auto"></i>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        Histori Wa Blast
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="nav-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        Logout
                    </a>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <div class="header-logo">
                        <div class="header-logo-icon"></div>
                        <div class="header-title">Sistem Poin Pelanggaran</div>
                    </div>
                </div>
                
                <div class="header-right">
                    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar
                    </button>
                    <div class="user-info">
                        <div class="user-role">Administrator</div>
                        <div class="user-name">(ADMIN)</div>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    @yield('scripts')
</body>
</html>
