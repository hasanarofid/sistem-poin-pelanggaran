<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('theme/assets/') }}"
    data-template="vertical-menu-template-no-customizer">

<head>
    @php
        $profile = App\ProfileMarket::find(1);
    @endphp
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ $profile->title }}</title>
    <meta name="description" content="Pengawas" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logopoint.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive-pagination.css') }}" />

    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('theme/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('theme/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('theme/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet"
        href="{{ asset('theme/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/libs/select2/select2.css') }}" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('theme/assets/vendor/css/pages/page-profile.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Helpers -->
    <script src="{{ asset('theme/assets/vendor/js/helpers.js') }}"></script>

    
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('theme/assets/js/config.js') }}"></script>
    
    @yield('css')
    
    <!-- Fixed Layout CSS -->
    <style>
        /* Fix layout overflow */
        body, html {
            overflow-x: hidden !important;
            height: 100% !important;
        }
        
        .layout-wrapper {
            width: 100% !important;
            min-height: 100vh !important;
            display: flex !important;
            flex-direction: column !important;
        }
        
        .layout-container {
            display: flex !important;
            width: 100% !important;
            flex: 1 !important;
        }
        
        .layout-page {
            flex: 1 !important;
            margin-left: 0 !important;
            width: calc(100% - 280px) !important;
            display: flex !important;
            flex-direction: column !important;
        }
        
        .layout-navbar {
            width: 100% !important;
            margin: 0 !important;
        }
        
        .content-wrapper {
            width: 100% !important;
            margin: 0 !important;
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
        }
        
        .container-xxl {
            max-width: none !important;
            width: 100% !important;
            padding: 30px !important;
            flex: 1 !important;
        }
        
        /* Fix navbar */
        .navbar {
            width: 100% !important;
            padding: 15px 30px !important;
            min-height: 70px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }
        
        .layout-navbar {
            padding: 15px 30px !important;
            min-height: 70px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
        }
        
        /* Force logout button to be visible */
        .ms-auto {
            margin-left: auto !important;
            display: flex !important;
            align-items: center !important;
            gap: 20px !important;
        }
        
        .btn-danger {
            flex-shrink: 0 !important;
            white-space: nowrap !important;
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 999 !important;
        }
        
        /* Force navbar layout */
        .layout-navbar > div:last-child {
            display: flex !important;
            align-items: center !important;
            gap: 20px !important;
            margin-left: auto !important;
        }
        
        /* Override any theme CSS that might hide the button */
        .navbar-nav-right {
            display: flex !important;
            align-items: center !important;
            gap: 20px !important;
            margin-left: auto !important;
        }
        
        /* Ensure button is always visible on desktop */
        @media (min-width: 768px) {
            .btn-danger {
                display: inline-block !important;
                visibility: visible !important;
                opacity: 1 !important;
            }
        }
        
        /* FORCE LOGOUT BUTTON TO BE VISIBLE - OVERRIDE EVERYTHING */
        a[href*="logout"],
        a[onclick*="logout"],
        .btn-danger,
        #layout-navbar .btn-danger,
        .layout-navbar .btn-danger,
        nav .btn-danger,
        div a[href*="logout"] {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 9999 !important;
            background: #dc2626 !important;
            color: white !important;
            border: none !important;
            padding: 10px 18px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            flex-shrink: 0 !important;
            width: auto !important;
            height: auto !important;
            margin: 0 !important;
            float: none !important;
            clear: none !important;
        }
        
        /* Force navbar layout */
        #layout-navbar,
        .layout-navbar,
        nav {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
        }
        
        /* Force all logout buttons to be visible */
        *[href*="logout"] {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            background: #dc2626 !important;
            color: white !important;
        }
        
        /* Fixed Header Styles */
        .fixed-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1000 !important;
            background: white !important;
            border-bottom: 1px solid #e5e7eb !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
        }
        
        /* Adjust content for fixed header */
        .content-with-fixed-header {
            margin-top: 60px !important;
        }
        
        /* Mobile Sidebar Styles */
        .layout-menu {
            transition: transform 0.3s ease-in-out !important;
        }
        
        .layout-menu.mobile-hidden {
            transform: translateX(-100%) !important;
        }
        
        .layout-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0, 0, 0, 0.5) !important;
            z-index: 999 !important;
            display: none !important;
        }
        
        .layout-overlay.show {
            display: block !important;
        }
        
        /* Mobile Menu Toggle Button */
        .mobile-menu-toggle {
            display: none !important;
            position: relative !important;
            z-index: 1001 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
            background: none !important;
            border: none !important;
            padding: 8px !important;
            margin-right: 15px !important;
            font-size: 24px !important;
            color: #374151 !important;
            transition: color 0.3s ease !important;
        }
        
        .mobile-menu-toggle:hover {
            color: #1f2937 !important;
            background: rgba(0, 0, 0, 0.05) !important;
            border-radius: 4px !important;
        }
        
        .mobile-menu-toggle:active {
            transform: scale(0.95) !important;
        }
        
        .mobile-menu-toggle i {
            pointer-events: none !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 1199px) {
            .layout-menu {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 280px !important;
                height: 100vh !important;
                z-index: 1000 !important;
                transform: translateX(-100%) !important;
            }
            
            .layout-menu.show {
                transform: translateX(0) !important;
            }
            
            .layout-page {
                width: 100% !important;
                margin-left: 0 !important;
            }
            
            .fixed-header {
                left: 0 !important;
                width: 100% !important;
                padding: 8px 15px !important;
                min-height: 50px !important;
            }
            
            .content-with-fixed-header {
                margin-top: 50px !important;
            }
            
            .mobile-menu-toggle {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                pointer-events: auto !important;
                cursor: pointer !important;
                z-index: 1001 !important;
                position: relative !important;
            }
            
            /* Hide desktop menu toggle */
            .layout-menu-toggle {
                display: none !important;
            }
        }
        
        @media (max-width: 768px) {
            .fixed-header {
                padding: 8px 15px !important;
                min-height: 50px !important;
            }
            
            .content-with-fixed-header {
                margin-top: 50px !important;
            }
            
            /* Adjust logo size on mobile */
            .fixed-header img {
                height: 35px !important;
            }
            
            .fixed-header h4 {
                font-size: 16px !important;
            }
        }
        
        /* Desktop adjustments */
        @media (min-width: 769px) {
            .fixed-header {
                left: 280px !important;
                width: calc(100% - 280px) !important;
            }
        }
        
        /* Fix cards spacing */
        .row {
            margin: 0 -10px !important;
        }
        
        .col-xl-3, .col-md-6, .col-12 {
            padding: 0 10px !important;
        }
        
        /* Header styling improvements */
        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
        }
        
        .navbar-nav .nav-item .text-end {
            line-height: 1.2;
        }
        
        /* Logout button hover effect */
        .btn-danger:hover {
            background: #b91c1c !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 12px rgba(220, 38, 38, 0.4) !important;
            color: white !important;
        }
        
        /* Ensure button is always visible */
        .btn-danger {
            background: #dc2626 !important;
            border: none !important;
            color: white !important;
        }
        
        /* Header info styling */
        .navbar-nav .nav-item .text-end div:first-child {
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Sticky Footer */
        .content-footer {
            margin-top: auto !important;
            background: white !important;
            border-top: 1px solid #e5e7eb !important;
            padding: 20px 0 !important;
        }
        
        .footer-container {
            color: #374151 !important;
            font-size: 14px !important;
        }
        
        .footer-container a {
            color: #3b82f6 !important;
            text-decoration: none !important;
        }
        
        .footer-container a:hover {
            text-decoration: underline !important;
        }
        
        /* Mobile Menu Toggle Hover Effect */
        .mobile-menu-toggle {
            background: none !important;
            border: none !important;
            cursor: pointer !important;
            z-index: 1001 !important;
            position: relative !important;
            touch-action: manipulation !important;
            -webkit-tap-highlight-color: transparent !important;
        }
        
        .mobile-menu-toggle:hover {
            background-color: #f3f4f6 !important;
            transform: scale(1.05) !important;
        }
        
        .mobile-menu-toggle:active {
            transform: scale(0.95) !important;
            background-color: #e5e7eb !important;
        }
        
        .mobile-menu-toggle:focus {
            outline: 2px solid #3b82f6 !important;
            outline-offset: 2px !important;
        }
        
        /* Profile Dropdown Hover Effects */
        .nav-link:hover {
            background-color: #f3f4f6 !important;
        }
        
        .dropdown-item:hover {
            background-color: #f3f4f6 !important;
        }
        
        /* Mobile Sidebar Styles */
        #layout-menu {
            transition: transform 0.3s ease-in-out;
        }
        
        #layout-menu.show {
            transform: translateX(0) !important;
        }
        
        @media (max-width: 1199.98px) {
            .layout-wrapper {
                display: block !important;
            }
            
            .layout-container {
                display: block !important;
            }
            
            #layout-menu {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                height: 100vh !important;
                z-index: 1002 !important;
                transform: translateX(-100%) !important;
                width: 260px !important;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3) !important;
            }
            
            #layout-menu.show {
                transform: translateX(0) !important;
            }
            
            .layout-overlay {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                background: rgba(0, 0, 0, 0.5) !important;
                z-index: 1001 !important;
                opacity: 0 !important;
                visibility: hidden !important;
                transition: opacity 0.3s ease-in-out !important;
            }
            
            .layout-overlay.show {
                opacity: 1 !important;
                visibility: visible !important;
            }
            
            .fixed-header {
                left: 0 !important;
                width: 100% !important;
            }
            
            .layout-page {
                width: 100% !important;
                margin-left: 0 !important;
            }
            
            .mobile-menu-toggle {
                display: flex !important;
            }
        }
        
        /* Ensure sidebar stays open on larger screens */
        @media (min-width: 1200px) {
            .layout-wrapper {
                display: flex !important;
                flex-direction: row !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            .layout-container {
                display: flex !important;
                flex-direction: row !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            #layout-menu {
                position: relative !important;
                transform: translateX(0) !important;
                width: 260px !important;
                min-width: 260px !important;
                max-width: 260px !important;
                box-shadow: none !important;
                flex-shrink: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            .layout-overlay {
                display: none !important;
            }
            
            .mobile-menu-toggle {
                display: none !important;
            }
            
            .fixed-header {
                left: 260px !important;
                width: calc(100% - 260px) !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            .layout-page {
                width: calc(100% - 260px) !important;
                margin-left: 0 !important;
                flex: 1 !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            .content-wrapper {
                margin: 0 !important;
                padding: 0 !important;
            }
            
            .layout-page .container-xxl {
                margin-left: 10px !important;
                padding-left: 20px !important;
            }
        }
        
        /* Desktop sidebar toggle functionality */
        @media (min-width: 1200px) {
            .sidebar-collapsed #layout-menu {
                width: 0 !important;
                min-width: 0 !important;
                max-width: 0 !important;
                overflow: hidden !important;
            }
            
            .sidebar-collapsed .fixed-header {
                left: 0 !important;
                width: 100% !important;
            }
            
            .sidebar-collapsed .layout-page {
                width: 100% !important;
                margin-left: 0 !important;
            }
            
            .sidebar-collapsed .layout-page .container-xxl {
                margin-left: 10px !important;
                padding-left: 20px !important;
            }
        }
        
        @media (max-width: 768px) {
            .fixed-header {
                padding: 8px 15px !important;
            }
            
            .fixed-header h4 {
                font-size: 16px !important;
            }
            
            .fixed-header img {
                height: 40px !important;
            }
            
            .avatar {
                width: 35px !important;
                height: 35px !important;
                font-size: 14px !important;
            }
            
            .nav-link {
                padding: 6px 8px !important;
            }
            
            .nav-link div {
                display: none !important;
            }
            
            .nav-link .avatar {
                margin-right: 0 !important;
            }
        }
        
        /* Sidebar hover improvements */
        .menu-link {
            transition: all 0.3s ease !important;
            position: relative !important;
        }
        
        .menu-link:hover {
            background-color: #4a5568 !important;
            color: white !important;
            transform: translateX(5px) !important;
        }
        
        .menu-link:hover div {
            color: white !important;
            opacity: 1 !important;
        }
        
        .menu-link div {
            transition: all 0.3s ease !important;
            opacity: 1 !important;
        }
        
        /* Active menu item styling */
        .menu-item.active .menu-link {
            background-color: #4a5568 !important;
            color: white !important;
        }
        
        .menu-item.active .menu-link div {
            color: white !important;
            opacity: 1 !important;
        }
        
        /* Content spacing improvements */
        .content-wrapper {
            padding-top: 10px !important;
            background: #f8f9fa !important;
            min-height: calc(100vh - 60px) !important;
            margin: 0 !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        .container-xxl {
            padding-top: 10px !important;
            background: white !important;
            border-radius: 8px !important;
            margin: 10px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        }
        
        /* Remove left spacing */
        .layout-page .content-wrapper {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }
        
        .layout-page .container-xxl {
            margin-left: 10px !important;
            padding-left: 20px !important;
        }
        
        /* Layout improvements */
        .layout-wrapper {
            background: #f8f9fa !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .layout-container {
            background: #f8f9fa !important;
            width: 100% !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        /* Sidebar base styles */
        #layout-menu {
            background: #1a1a1a !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        /* Layout page styles */
        .layout-page {
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh !important;
            position: relative !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        /* Content wrapper styles */
        .content-wrapper {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        @media (max-width: 768px) {
            .container-xxl {
                padding-top: 8px !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
                margin: 5px !important;
            }
            
            .content-wrapper {
                background: white !important;
            }
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Mobile Overlay -->
            <div class="layout-overlay"></div>
            
            <!-- Menu -->
            @include('layouts.admin.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar - FIXED HEADER -->
                <div class="fixed-header" style="position: fixed; top: 0; left: 260px; right: 0; background: white; border-bottom: 1px solid #e5e7eb; padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; width: calc(100% - 260px); min-height: 60px; z-index: 1000; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    
                    <!-- Left Side: Hamburger Menu (Mobile) + Logo and Title -->
                    <div style="display: flex; align-items: center;">
                        <!-- Hamburger Menu for Mobile - PERBESAR ICON -->
                        <button type="button" class="mobile-menu-toggle d-xl-none" id="mobile-menu-toggle" style="background: none; border: none; margin-right: 15px; font-size: 32px; color: #374151; cursor: pointer; z-index: 1001; position: relative; padding: 12px; min-width: 56px; min-height: 56px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: all 0.2s; touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                            <i class="ti ti-menu-2"></i>
                        </button>
                        <img src="{{ asset('logopoint.png') }}" style="height:50px;" alt="">
                        <h4 style="margin: 0; color: #1f2937; font-weight: 700;">Sistem Poin Pelanggaran</h4>
                    </div>
                    
                    <!-- Right Side: Profile Dropdown -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" style="display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 8px; text-decoration: none; color: #374151; transition: background-color 0.2s;">
                                <div class="avatar avatar-online" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 16px;">
                                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 12px; color: #9ca3af; margin-bottom: 1px;">Login Sebagai {{ ucwords(Auth::user()->role) }}</div>
                                    <div style="font-size: 14px; font-weight: 500; color: #374151;">{{ Auth::user()->name ?? 'Administrator' }}</div>
                                </div>
                                <i class="ti ti-chevron-down" style="font-size: 16px; color: #9ca3af;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="min-width: 200px; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                <div class="dropdown-header" style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; background: #f9fafb;">
                                    <div style="font-size: 14px; font-weight: 600; color: #374151;">{{ Auth::user()->name ?? 'Administrator' }}</div>
                                    <div style="font-size: 12px; color: #9ca3af;">{{ Auth::user()->username ?? 'admin@example.com' }}</div>
                                </div>
                                {{-- <a class="dropdown-item" href="#" style="padding: 12px 16px; color: #374151; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: background-color 0.2s;">
                                    <i class="ti ti-user" style="font-size: 16px; color: #6b7280;"></i>
                                    <span>Profile</span>
                                </a>
                                <a class="dropdown-item" href="#" style="padding: 12px 16px; color: #374151; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: background-color 0.2s;">
                                    <i class="ti ti-settings" style="font-size: 16px; color: #6b7280;"></i>
                                    <span>Settings</span>
                                </a> --}}
                                <div class="dropdown-divider" style="margin: 8px 0; border-top: 1px solid #e5e7eb;"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="padding: 12px 16px; color: #dc2626; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: background-color 0.2s;">
                                    <i class="ti ti-logout" style="font-size: 16px; color: #dc2626;"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper content-with-fixed-header" style="flex: 1; display: flex; flex-direction: column; margin-top: 60px; padding-top: 10px;">
                    @yield('content')
                </div>
                
                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme" style="margin-top: auto;">
                    @include('layouts.admin.footer')
                </footer>
                <!-- / Footer -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    

    <script src="{{ asset('theme/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('theme/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('theme/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <script src="{{ asset('theme/assets/vendor/libs/select2/select2.js') }}"></script>
    <!-- Vendors JS -->
    <script src="{{ asset('theme/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>


    <script src="{{ asset('theme/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('theme/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('theme/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('theme/assets/js/tables-datatables-basic.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('script')

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Mobile Sidebar Toggle and Logout Button Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle functionality
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const layoutMenu = document.getElementById('layout-menu');
            const layoutOverlay = document.querySelector('.layout-overlay');
            const menuToggle = document.getElementById('menu-toggle');
            const layoutWrapper = document.querySelector('.layout-wrapper');
            
            console.log('Mobile menu toggle element:', mobileMenuToggle);
            console.log('Layout menu element:', layoutMenu);
            console.log('Layout overlay element:', layoutOverlay);
            
            // Toggle sidebar on mobile
            if (mobileMenuToggle) {
                // Remove any existing event listeners first
                mobileMenuToggle.removeEventListener('click', handleMobileToggle);
                mobileMenuToggle.removeEventListener('touchstart', handleMobileTouch);
                
                // Add click event
                mobileMenuToggle.addEventListener('click', handleMobileToggle);
                
                // Add touch event for mobile
                mobileMenuToggle.addEventListener('touchstart', handleMobileTouch, { passive: false });
                
                function handleMobileToggle(e) {
                    if (window.innerWidth < 1200) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('Mobile menu toggle clicked');
                        
                        if (layoutMenu) {
                            layoutMenu.classList.toggle('show');
                            console.log('Layout menu classes:', layoutMenu.className);
                        }
                        
                        if (layoutOverlay) {
                            layoutOverlay.classList.toggle('show');
                            console.log('Layout overlay classes:', layoutOverlay.className);
                        }
                        
                        // Prevent body scroll when menu is open
                        if (layoutMenu.classList.contains('show')) {
                            document.body.style.overflow = 'hidden';
                        } else {
                            document.body.style.overflow = '';
                        }
                    }
                }
                
                function handleMobileTouch(e) {
                    if (window.innerWidth < 1200) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('Mobile menu toggle touched');
                        
                        if (layoutMenu) {
                            layoutMenu.classList.toggle('show');
                        }
                        
                        if (layoutOverlay) {
                            layoutOverlay.classList.toggle('show');
                        }
                        
                        // Prevent body scroll when menu is open
                        if (layoutMenu.classList.contains('show')) {
                            document.body.style.overflow = 'hidden';
                        } else {
                            document.body.style.overflow = '';
                        }
                    }
                }
            } else {
                console.error('Mobile menu toggle element not found');
            }
            
            // Close sidebar when clicking overlay
            if (layoutOverlay) {
                layoutOverlay.addEventListener('click', function() {
                    layoutMenu.classList.remove('show');
                    layoutOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                });
            }
            
            // Close sidebar when clicking menu toggle inside sidebar
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    layoutMenu.classList.remove('show');
                    layoutOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                });
            }
            
            // Desktop sidebar toggle functionality
            function toggleDesktopSidebar() {
                if (window.innerWidth >= 1200) {
                    if (layoutWrapper) {
                        layoutWrapper.classList.toggle('sidebar-collapsed');
                        console.log('Desktop sidebar toggled:', layoutWrapper.classList.contains('sidebar-collapsed'));
                    }
                }
            }
            
            // Add desktop toggle functionality to mobile menu toggle
            if (mobileMenuToggle) {
                // Remove existing event listeners
                mobileMenuToggle.removeEventListener('click', handleDesktopToggle);
                
                // Add new event listener
                mobileMenuToggle.addEventListener('click', handleDesktopToggle);
                
                function handleDesktopToggle(e) {
                    if (window.innerWidth >= 1200) {
                        e.preventDefault();
                        e.stopPropagation();
                        toggleDesktopSidebar();
                    }
                }
            }
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1200) {
                    // Desktop view - remove mobile classes
                    if (layoutMenu) {
                        layoutMenu.classList.remove('show');
                    }
                    if (layoutOverlay) {
                        layoutOverlay.classList.remove('show');
                    }
                    document.body.style.overflow = '';
                } else {
                    // Mobile view - remove desktop classes
                    if (layoutWrapper) {
                        layoutWrapper.classList.remove('sidebar-collapsed');
                    }
                }
            });
            
            // Close sidebar when clicking menu links on mobile
            const menuLinks = document.querySelectorAll('.menu-link');
            menuLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1200) {
                        layoutMenu.classList.remove('show');
                        layoutOverlay.classList.remove('show');
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1200) {
                    layoutMenu.classList.remove('show');
                    layoutOverlay.classList.remove('show');
                }
            });
            
            // Enhanced mobile menu toggle - REMOVED DUPLICATE
            
            // Alternative toggle method using jQuery if available - REMOVED DUPLICATE
            
            // Close menu when clicking outside or on overlay
            document.addEventListener('click', function(e) {
                const menu = document.getElementById('layout-menu');
                const overlay = document.querySelector('.layout-overlay');
                const toggle = document.getElementById('mobile-menu-toggle');
                
                // Only handle mobile menu closing on mobile screens
                if (window.innerWidth <= 1199) {
                    // Close when clicking on overlay
                    if (e.target === overlay) {
                        menu.classList.remove('show');
                        overlay.classList.remove('show');
                        document.body.style.overflow = '';
                        return;
                    }
                    
                    // Close when clicking outside menu and toggle
                    if (menu && menu.classList.contains('show') && 
                        !menu.contains(e.target) && 
                        !toggle.contains(e.target)) {
                        menu.classList.remove('show');
                        if (overlay) overlay.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                }
            });
            
            // Close menu when pressing escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const menu = document.getElementById('layout-menu');
                    const overlay = document.querySelector('.layout-overlay');
                    
                    if (menu && menu.classList.contains('show') && window.innerWidth <= 1199) {
                        menu.classList.remove('show');
                        if (overlay) overlay.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                const menu = document.getElementById('layout-menu');
                const overlay = document.querySelector('.layout-overlay');
                
                if (window.innerWidth >= 1200) {
                    // Desktop view - ensure menu is visible
                    if (menu) {
                        menu.classList.remove('show');
                        menu.style.transform = 'translateX(0)';
                    }
                    if (overlay) {
                        overlay.classList.remove('show');
                    }
                    document.body.style.overflow = '';
                } else {
                    // Mobile view - ensure menu is hidden by default
                    if (menu && !menu.classList.contains('show')) {
                        menu.style.transform = 'translateX(-100%)';
                    }
                }
            });
            
            // Initialize mobile menu on page load - REMOVED DUPLICATE
            
            // Force logout button to be visible
            const logoutButtons = document.querySelectorAll('a[href*="logout"], a[onclick*="logout"]');
            logoutButtons.forEach(function(button) {
                button.style.display = 'inline-block';
                button.style.visibility = 'visible';
                button.style.opacity = '1';
                button.style.background = '#dc2626';
                button.style.color = 'white';
                button.style.padding = '10px 18px';
                button.style.borderRadius = '8px';
                button.style.fontWeight = '600';
                button.style.textDecoration = 'none';
                button.style.whiteSpace = 'nowrap';
                button.style.position = 'relative';
                button.style.zIndex = '9999';
            });
            
            // Also check for any hidden logout buttons and make them visible
            setTimeout(function() {
                const allButtons = document.querySelectorAll('a');
                allButtons.forEach(function(button) {
                    if (button.href && button.href.includes('logout')) {
                        button.style.display = 'inline-block';
                        button.style.visibility = 'visible';
                        button.style.opacity = '1';
                    }
                });
            }, 1000);
            
            // Debug function to test toggle manually
            window.testToggle = function() {
                console.log('Manual toggle test');
                const menu = document.getElementById('layout-menu');
                const overlay = document.querySelector('.layout-overlay');
                
                if (menu) {
                    menu.classList.toggle('show');
                    console.log('Menu classes:', menu.className);
                }
                
                if (overlay) {
                    overlay.classList.toggle('show');
                    console.log('Overlay classes:', overlay.className);
                }
            };
            
            // Test if elements exist
            setTimeout(function() {
                console.log('=== DEBUG INFO ===');
                console.log('Mobile toggle exists:', !!document.getElementById('mobile-menu-toggle'));
                console.log('Layout menu exists:', !!document.getElementById('layout-menu'));
                console.log('Layout overlay exists:', !!document.querySelector('.layout-overlay'));
                console.log('Window width:', window.innerWidth);
                console.log('Is mobile view:', window.innerWidth < 1200);
                console.log('==================');
            }, 2000);
        });
    </script>

</body>

</html>
