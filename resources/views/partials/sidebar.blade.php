<div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header d-flex align-items-center justify-content-center p-3 pt-4 pb-4">
        <a href="{{ url('dashboard') }}" class="logo">
            <img src="/assets/img/loggo.png" alt="navbar brand" class="navbar-brand" height="82" style="margin-top:35px; margin-bottom:10px;"/>
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

            <li class="nav-item {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('superadmin.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>


            <!-- Memo -->
           <li class="nav-item {{ request()->routeIs('superadmin.memo.index') ? 'active' : '' }}">
                <a href="{{ route('superadmin.memo.index') }}" class="nav-link">
                    <i class="fas fa-file-alt"></i>
                    <p>Memo</p>
                </a>
            </li>

            <!-- Undangan Rapat -->
            <li class="nav-item {{ request()->routeIs('superadmin.undangan.index') ? 'active' : '' }}">
                <a href="{{ route('superadmin.undangan.index') }}" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>
                    <p>Undangan Rapat</p>
                </a>
            </li>

            <!-- Risalah Rapat -->
            <li class="nav-item {{ request()->routeIs('superadmin.risalah.index') ? 'active' : '' }}">
                <a href="{{ route('superadmin.risalah.index') }}" class="nav-link">
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
                <a data-bs-toggle="collapse" href="#pengaturan">
                    <i class="fas fa-cogs"></i>
                    <p>Pengaturan</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="pengaturan">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('data-perusahaan') }}">
                                <span class="sub-item">Data Perusahaan</span>
                            </a>
                        </li>
                    </ul>
                </div>
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
