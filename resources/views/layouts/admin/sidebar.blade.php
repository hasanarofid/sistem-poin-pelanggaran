<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background: #1a1a1a !important;">
    <div class="app-brand demo" style="height: 60px !important; padding: 15px 20px; display: flex; align-items: center; border-bottom: 1px solid #333;">
        <div style="width: 30px; height: 30px; background: #3b82f6; border-radius: 6px; margin-right: 12px; display: flex; align-items: center; justify-content: center; position: relative;">
            <div style="width: 18px; height: 18px; background: white; border-radius: 3px; position: relative;"></div>
            <div style="position: absolute; top: 3px; left: 50%; transform: translateX(-50%); width: 12px; height: 4px; background: white; border-radius: 1px 1px 0 0;"></div>
        </div>
        <div style="font-size: 16px; font-weight: 700; color: white;">Sistem Poin Pelanggaran</div>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1" style="margin-top: 0; padding: 10px 0;">
        @php
            $user = auth()->user();
            $isAdmin = $user &&  $user->role === 'admin';
            $isGuru = $user &&  $user->role === 'guru';
            $isSiswa = $user &&  $user->role === 'siswa';
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
                <i class="menu-icon tf-icons ti ti-dashboard" style="margin-right: 12px;"></i>
                <div data-i18n="Profile">Dashboard</div>
            </a>
        </li>

        {{-- Menu untuk Admin --}}
        @if($isAdmin)
            <li class="menu-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('admin.siswa.index') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('admin.siswa.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-users" style="margin-right: 12px;"></i>
                    <div data-i18n="Profile">Data Siswa</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('input-pelanggaran.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('input-pelanggaran.index') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('input-pelanggaran.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-edit" style="margin-right: 12px;"></i>
                    <div data-i18n="Profile">Input Pelanggaran</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('laporan.index') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('laporan.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-file-text" style="margin-right: 12px;"></i>
                    <div data-i18n="Profile">Laporan</div>
                </a>
            </li>
        @endif

        {{-- Menu untuk Guru --}}
        @if($isGuru)
            <li class="menu-item {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('guru.siswa.index') }}" class="menu-link" style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('guru.siswa.*') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-users" style="margin-right: 12px;"></i>
                    <div data-i18n="Profile">Data Siswa</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guru.input-pelanggaran') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('guru.input-pelanggaran') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('guru.input-pelanggaran') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-edit" style="margin-right: 12px;"></i>
                    <div data-i18n="Profile">Input Pelanggaran</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guru.laporan') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('guru.laporan') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('guru.laporan') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-file-text" style="margin-right: 12px;"></i>
                    <div data-i18n="Profile">Laporan</div>
                </a>
            </li>
        @endif

        {{-- Menu untuk Siswa --}}
        @if($isSiswa)
            <li class="menu-item {{ request()->routeIs('siswa.profile') ? 'active' : '' }}" style="margin: 2px 10px;">
                <a href="{{ route('siswa.profile') }}"
                    class="menu-link"
                    style="color: white; padding: 12px 15px; border-radius: 6px; {{ request()->routeIs('siswa.profile') ? 'background: #4a5568 !important;' : '' }}">
                    <i class="menu-icon tf-icons ti ti-user" style="margin-right: 12px;"></i>
                    <div data-i18n="Profile">Profile Saya</div>
                </a>
            </li>
        @endif
    </ul>
</aside>