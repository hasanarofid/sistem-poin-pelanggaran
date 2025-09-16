<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background: #1a1a1a !important;">
    <div class="app-brand demo" style="height: 60px !important; padding: 15px 20px; display: flex; align-items: center; border-bottom: 1px solid #333;">
        <img src="{{ asset('logopoint.png') }}" style="height:50px;" alt="">
        <div style="font-size: 16px; font-weight: 700; color: white;">Sistem Poin Pelanggaran</div>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto" id="menu-toggle">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1" style="margin-top: 0; padding: 10px 0;">
        @php
            $user = auth()->user();
            $isAdmin = $user && ($user->role === 'admin' || $user->role === 'Admin');
            $isGuru = $user && ($user->role === 'guru' || $user->role === 'Guru');
            $isSiswa = $user && ($user->role === 'siswa' || $user->role === 'Siswa');
        @endphp

        {{-- Dashboard --}}
        <li class="menu-item {{ request()->is('dashboard') || request()->is('/') || request()->routeIs('guru.dashboard') || request()->routeIs('siswa.dashboard') ? 'active' : '' }}" style="margin: 2px 10px;">
            @if($isAdmin)
                <a href="{{ route('admin.index') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->is('dashboard') || request()->is('/') ? 'background: #4a5568 !important;' : '' }}">
            @elseif($isGuru)
                <a href="{{ route('guru.dashboard') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('guru.dashboard') ? 'background: #4a5568 !important;' : '' }}">
            @elseif($isSiswa)
                <a href="{{ route('siswa.dashboard') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('siswa.dashboard') ? 'background: #4a5568 !important;' : '' }}">
            @endif
                <i class="menu-icon tf-icons ti ti-dashboard" style="margin-right: 12px; color: white;"></i>
                <div data-i18n="Profile" style="color: white; font-weight: 500;">Dashboard</div>
            </a>
        </li>

        {{-- Menu untuk Admin --}}
        @if($isAdmin)
            <li class="menu-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.siswa.index') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.siswa.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-users" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Data Siswa</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.kategori.index') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.kategori.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-category" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Kategori</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.jenis-poin.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.jenis-poin.index') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.jenis-poin.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-star" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Jenis Poin</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.input-poin.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.input-poin.index') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.input-poin.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-edit" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Input Poin</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.list-input-poin.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.list-input-poin.index') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.list-input-poin.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-clipboard-list" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">List Input Poin</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.penambahan-poin-kelas.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.penambahan-poin-kelas.index') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.penambahan-poin-kelas.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-users" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Penambahan Poin Kelas</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.laporan.index') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.laporan.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-file-text" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Laporan</div>
                </a>
            </li>
        @endif

        {{-- Menu untuk Guru --}}
        @if($isGuru)
            <li class="menu-item {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('guru.siswa.index') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('guru.siswa.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-users" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Data Siswa</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guru.input-poin') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('guru.input-poin') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('guru.input-poin') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-edit" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Input Poin</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guru.laporan') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('guru.laporan') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('guru.laporan') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-file-text" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Laporan</div>
                </a>
            </li>
        @endif

        {{-- Menu untuk Siswa --}}
        @if($isSiswa)
            <li class="menu-item {{ request()->routeIs('siswa.profile') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('siswa.profile') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('siswa.profile') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-user" style="margin-right: 12px; color: white;"></i>
                    <div data-i18n="Profile" style="color: white; font-weight: 500;">Profile Saya</div>
                </a>
            </li>
        @endif
    </ul>
</aside>