@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2>Manajemen Pengguna</h2>
            <div class="d-flex gap-2">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari pengguna..." id="searchInput">
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Pengguna Baru
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Statistik Pengguna</h5>
                    <div class="stats-card floating">
                        <div class="stats-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stats-number">{{ $users->total() }}</div>
                        <div class="stats-label">Total Pengguna</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Peran Pengguna</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Peran</th>
                                    <th>Jumlah</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalUsers = $users->total();
                                    $adminCount = $users->where('role', 'admin')->count();
                                    $userCount = $users->where('role', 'user')->count();
                                @endphp
                                <tr>
                                    <td>Admin</td>
                                    <td>{{ $adminCount }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: {{ ($adminCount / $totalUsers) * 100 }}%">
                                                {{ number_format(($adminCount / $totalUsers) * 100, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pengguna</td>
                                    <td>{{ $userCount }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: {{ ($userCount / $totalUsers) * 100 }}%">
                                                {{ number_format(($userCount / $totalUsers) * 100, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Daftar Pengguna</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'success' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada pengguna ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<style>
.stats-card {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 1.5rem;
    border-radius: 15px;
    text-align: center;
}

.stats-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.stats-number {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.stats-label {
    font-size: 1rem;
    opacity: 0.9;
}

.progress {
    background-color: rgba(0,0,0,0.1);
    border-radius: 10px;
}

[data-bs-theme="dark"] .progress {
    background-color: rgba(255,255,255,0.1);
}

.progress-bar {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border-radius: 10px;
}

.avatar-circle {
    width: 35px;
    height: 35px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
}

.search-box {
    position: relative;
}

.search-box input {
    padding-right: 40px;
    border-radius: 20px;
    border: 1px solid rgba(0,0,0,0.1);
    background: var(--card-bg-light);
    transition: all 0.3s ease;
}

[data-bs-theme="dark"] .search-box input {
    background: var(--card-bg-dark);
    border-color: rgba(255,255,255,0.1);
}

.search-box input:focus {
    box-shadow: 0 0 0 0.2rem rgba(65, 105, 225, 0.25);
    border-color: var(--primary-color);
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    border: none;
    color: var(--primary-color);
    padding: 0.5rem 1rem;
    margin: 0 0.2rem;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: var(--primary-color);
    color: white;
}

.page-item.active .page-link {
    background: var(--primary-color);
    color: white;
}

.badge {
    padding: 0.5em 1em;
    font-weight: 500;
}

.btn-group {
    gap: 0.5rem;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
    border-radius: 5px;
}
</style>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchText = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});
</script>
@endsection 