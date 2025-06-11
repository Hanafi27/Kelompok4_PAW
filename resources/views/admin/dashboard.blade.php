@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-4">Dashboard</h2>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stats-card floating">
                <div class="stats-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stats-number">{{ $totalUsers ?? 0 }}</div>
                <div class="stats-label">Total Pengguna</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card floating" style="animation-delay: 0.2s">
                <div class="stats-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="stats-number">{{ $totalCandidates ?? 0 }}</div>
                <div class="stats-label">Total Kandidat</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card floating" style="animation-delay: 0.4s">
                <div class="stats-icon">
                    <i class="bi bi-check2-square"></i>
                </div>
                <div class="stats-number">{{ $totalVotes ?? 0 }}</div>
                <div class="stats-label">Total Suara</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card floating" style="animation-delay: 0.6s">
                <div class="stats-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="stats-number">{{ $votingPercentage ?? 0 }}%</div>
                <div class="stats-label">Persentase Pemilihan</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Suara Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pengguna</th>
                                    <th>Kandidat</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentVotes ?? [] as $vote)
                                <tr>
                                    <td>{{ $vote->user->name }}</td>
                                    <td>{{ $vote->candidate->name }}</td>
                                    <td>{{ $vote->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada suara</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Tindakan Cepat</h5>
                    <div class="d-grid gap-2">
                        <a href="/admin/candidates/create" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Kandidat Baru
                        </a>
                        <a href="/admin/users" class="btn btn-outline-primary">
                            <i class="bi bi-people me-2"></i>Kelola Pengguna
                        </a>
                        <a href="/admin/settings" class="btn btn-outline-primary">
                            <i class="bi bi-gear me-2"></i>Pengaturan Sistem
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
