@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2>Manajemen Suara</h2>
            <div class="d-flex gap-2">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari suara..." id="searchInput">
                </div>
                <a href="{{ route('admin.votes.export') }}" class="btn btn-primary">
                    <i class="bi bi-download me-2"></i>Ekspor Suara
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Statistik Suara</h5>
                    <div class="stats-card floating">
                        <div class="stats-icon">
                            <i class="bi bi-check2-square"></i>
                        </div>
                        <div class="stats-number">{{ $totalVotes }}</div>
                        <div class="stats-label">Total Suara</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Suara Berdasarkan Kandidat</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kandidat</th>
                                    <th>Total Suara</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($votesByCandidate as $vote)
                                <tr>
                                    <td>{{ $vote->candidate->name }}</td>
                                    <td>{{ $vote->total }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: {{ ($vote->total / $totalVotes) * 100 }}%">
                                                {{ number_format(($vote->total / $totalVotes) * 100, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Suara Terbaru</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pemilih</th>
                            <th>Kandidat</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($votes as $vote)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">
                                        {{ strtoupper(substr($vote->user->name, 0, 1)) }}
                                    </div>
                                    {{ $vote->user->name }}
                                </div>
                            </td>
                            <td>{{ $vote->candidate->name }}</td>
                            <td>{{ $vote->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada suara yang tercatat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $votes->links() }}
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