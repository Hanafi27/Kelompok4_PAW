<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-center">
        <span class="brand-text font-weight-bold text-dark" style="font-size: 1.5rem;">E-Voting</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Kelola Mahasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/candidates') }}" class="nav-link {{ request()->is('admin/candidates*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Kelola Kandidat</p>
                    </a>
                </li>
                @endif

                @if (Auth::check() && Auth::user()->role === 'user')
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-vote-yea"></i>
                        <p>Pemilihan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/profile') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
.main-sidebar {
    background: #ffffff;
}

.brand-link {
    border-bottom: 1px solid #f4f6f9;
    padding: 1rem;
}

.brand-text {
    letter-spacing: 1px;
}

.nav-sidebar .nav-item .nav-link {
    border-radius: 0.25rem;
    margin: 0.2rem 0.8rem;
    transition: all 0.3s ease;
    color: #6c757d;
}

.nav-sidebar .nav-item .nav-link:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

.nav-sidebar .nav-item .nav-link.active {
    background-color: #007bff;
    color: #ffffff;
}

.nav-icon {
    width: 1.5rem;
    text-align: center;
    margin-right: 0.5rem;
}
</style>
