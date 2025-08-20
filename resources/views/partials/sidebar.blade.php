<div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header d-flex align-items-center justify-content-center p-3">
        <a href="{{ url('dashboard') }}" class="logo">
            <img src="/assets/img/loggo.png" alt="navbar brand" class="navbar-brand" height="70" />
        </a>
    </div>
    <!-- End Logo Header -->
</div>

<div class="sidebar-wrapper">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">

            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">MENU</h4>
            </li>

            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Memo -->
            <li class="nav-item {{ request()->is('memo') ? 'active' : '' }}">
                <a href="{{ url('memo') }}">
                    <i class="fas fa-file-alt"></i>
                    <p>Memo</p>
                </a>
            </li>

            <!-- Undangan Rapat -->
            <li class="nav-item {{ request()->is('undangan') ? 'active' : '' }}">
                <a href="{{ url('undangan') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <p>Undangan Rapat</p>
                </a>
            </li>

            <!-- Risalah Rapat -->
            <li class="nav-item {{ request()->is('risalah') ? 'active' : '' }}">
                <a href="{{ url('risalah') }}">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Risalah Rapat</p>
                </a>
            </li>

            <!-- Arsip -->
            <li class="nav-item {{ request()->is('arsip') ? 'active' : '' }}">
                <a href="{{ url('arsip') }}">
                    <i class="fas fa-archive"></i>
                    <p>Arsip</p>
                </a>
            </li>

            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">LAINNYA</h4>
            </li>

            <!-- Pengaturan -->
            <li class="nav-item {{ request()->is('pengaturan') ? 'active' : '' }}">
                <a href="{{ url('pengaturan') }}">
                    <i class="fas fa-cogs"></i>
                    <p>Pengaturan</p>
                </a>
            </li>

            <!-- Info -->
            <li class="nav-item {{ request()->is('info') ? 'active' : '' }}">
                <a href="{{ route('info') }}">
                    <i class="fas fa-info-circle"></i>
                    <p>Info</p>
                </a>
            </li>
        </ul>
    </div>
</div>
