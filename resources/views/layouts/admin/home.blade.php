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
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .fixed-header {
                left: 0 !important;
                width: 100% !important;
                padding: 8px 15px !important;
                min-height: 50px !important;
            }
            .content-with-fixed-header {
                margin-top: 50px !important;
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
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar" style="display: flex; width: 100%;">
        <div class="layout-container" style="display: flex; width: 100%;">
            <!-- Menu -->
            @include('layouts.admin.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page" style="flex: 1; margin-left: 0 !important; width: calc(100% - 280px) !important; display: flex; flex-direction: column;">
                <!-- Navbar - FIXED HEADER -->
                <div class="fixed-header" style="position: fixed; top: 0; left: 280px; right: 0; background: white; border-bottom: 1px solid #e5e7eb; padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; width: calc(100% - 280px); min-height: 60px; z-index: 1000; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    
                    <!-- Left Side: Logo and Title -->
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('logopoint.png') }}" style="height:50px;" alt="">
                        <h4 style="margin: 0; color: #1f2937; font-weight: 700;">Sistem Poin Pelanggaran</h4>
                    </div>
                    <!-- Right Side: User Info and Logout Button -->
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div style="text-align: right;">
                            <div style="font-size: 11px; color: #9ca3af; margin-bottom: 1px;"> Login Sebagai {{ ucwords(Auth::user()->role) }}</div>
                            <div style="font-size: 13px; font-weight: 500; color: #374151;">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        </div>
                      
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           style="background: #dc2626; border: none; padding: 10px 18px; border-radius: 8px; font-weight: 600; box-shadow: 0 3px 6px rgba(220, 38, 38, 0.3); color: white; text-decoration: none; white-space: nowrap; display: inline-block;">
                            <i class="ti ti-arrow-left" style="margin-right: 5px;"></i>
                            Keluar
                        </a>
                    </div>

                </div>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper content-with-fixed-header" style="flex: 1; display: flex; flex-direction: column; margin-top: 60px;">
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
    @yield('script')

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Force Logout Button to be Visible -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>

</body>

</html>
