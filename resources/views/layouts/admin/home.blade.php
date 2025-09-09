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
    <link rel="icon" type="image/x-icon" href="{{ asset('logo_simodip_new.jpeg') }}" />

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
        }
        
        .layout-wrapper {
            width: 100% !important;
        }
        
        .layout-container {
            display: flex !important;
            width: 100% !important;
        }
        
        .layout-page {
            flex: 1 !important;
            margin-left: 0 !important;
            width: calc(100% - 280px) !important;
        }
        
        .layout-navbar {
            width: 100% !important;
            margin: 0 !important;
        }
        
        .content-wrapper {
            width: 100% !important;
            margin: 0 !important;
        }
        
        .container-xxl {
            max-width: none !important;
            width: 100% !important;
            padding: 30px !important;
        }
        
        /* Fix navbar */
        .navbar {
            width: 100% !important;
            padding: 0 30px !important;
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
            <div class="layout-page" style="flex: 1; margin-left: 0 !important; width: calc(100% - 280px) !important;">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar" style="background: white !important; border-bottom: 1px solid #e5e7eb; margin: 0 !important; width: 100% !important;">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm" style="color: #374151;"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse" style="width: 100%; justify-content: space-between;">
                        <div class="d-flex align-items-center">
                            <div style="width: 30px; height: 30px; background: #3b82f6; border-radius: 6px; margin-right: 12px; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="width: 18px; height: 18px; background: white; border-radius: 3px; position: relative;"></div>
                                <div style="position: absolute; top: 3px; left: 50%; transform: translateX(-50%); width: 12px; height: 4px; background: white; border-radius: 1px 1px 0 0;"></div>
                            </div>
                            <h4 style="margin: 0; color: #1f2937; font-weight: 700;">Sistem Poin Pelanggaran</h4>
                        </div>
                    <ul class="navbar-nav flex-row align-items-center">
                        <li class="nav-item me-3">
                            <div class="text-end">
                                <div style="font-size: 12px; color: #6b7280; margin-bottom: 2px;">Administrator</div>
                                <div style="font-size: 14px; font-weight: 600; color: #1f2937;">(ADMIN)</div>
                            </div>
                        </li>
                        <li class="nav-item me-2">
                            <div class="text-end">
                                <div style="font-size: 11px; color: #9ca3af; margin-bottom: 1px;">Login sebagai</div>
                                <div style="font-size: 13px; font-weight: 500; color: #374151;">{{ Auth::user()->name ?? 'Administrator' }}</div>
                            </div>
                        </li>
                        <li class="nav-item me-2">
                            <div class="text-end">
                                <div style="font-size: 11px; color: #9ca3af; margin-bottom: 1px;">Terakhir login</div>
                                <div style="font-size: 13px; font-weight: 500; color: #374151;">{{ now()->format('d/m/Y H:i') }}</div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="btn btn-danger btn-sm" style="background: #dc2626 !important; border: none !important; padding: 10px 18px !important; border-radius: 8px !important; font-weight: 600 !important; box-shadow: 0 3px 6px rgba(220, 38, 38, 0.3) !important; transition: all 0.2s ease !important; color: white !important; text-decoration: none !important;">
                                <i class="ti ti-arrow-left me-1"></i>
                                Keluar
                            </a>
                        </li>
                    </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper d-none">
                        <input type="text" class="form-control search-input container-xxl border-0"
                            placeholder="Search..." aria-label="Search..." />
                        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                @yield('content')
                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    @include('layouts.admin.footer')
                </footer>
                <!-- / Footer -->
                <!-- Content wrapper -->
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

</body>

</html>
