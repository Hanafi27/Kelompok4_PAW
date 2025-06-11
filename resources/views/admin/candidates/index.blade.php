@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2>Manajemen Kandidat</h2>
            <div class="d-flex gap-2">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Cari kandidat..." id="searchInput">
                </div>
                <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Kandidat
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @forelse($candidates as $candidate)
        <div class="col-md-4">
            <div class="card candidate-card">
                <div class="candidate-header">
                    <div class="candidate-avatar">
                        @if($candidate->image_path)
                            <img src="{{ asset('storage/' . $candidate->image_path) }}" alt="{{ $candidate->name }}">
                        @else
                            <div class="avatar-placeholder">
                                {{ strtoupper(substr($candidate->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="candidate-info">
                        <h5 class="mb-1">{{ $candidate->name }}</h5>
                        <p class="text-muted mb-0">Kandidat</p>
                    </div>
                </div>
                
                <div class="candidate-stats mt-4">
                    <div class="stat-item">
                        <i class="bi bi-check2-square"></i>
                        <span>{{ $candidate->votes_count ?? 0 }} Suara</span>
                    </div>
                    <div class="stat-item">
                        <span>{{ $candidate->vote_percentage ?? 0 }}%</span>
                    </div>
                </div>

                <div class="candidate-actions mt-4">
                    <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm delete-btn">
                            <i class="bi bi-trash me-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-person-x display-1 text-muted mb-3"></i>
                    <h4>Tidak Ada Kandidat Ditemukan</h4>
                    <p class="text-muted">Mulai dengan menambahkan kandidat pertama Anda</p>
                    <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Kandidat
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $candidates->links() }}
    </div>
</div>

<style>
.candidate-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    padding: 1.5rem;
}

.candidate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.candidate-header {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.candidate-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.candidate-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
}

.candidate-stats {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: rgba(0,0,0,0.03);
    border-radius: 10px;
}

[data-bs-theme="dark"] .candidate-stats {
    background: rgba(255,255,255,0.05);
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #2c3e50;
}

[data-bs-theme="dark"] .stat-item {
    color: #fff;
}

.candidate-actions {
    display: flex;
    gap: 0.5rem;
}

.search-box {
    position: relative;
}

.search-box input {
    padding-right: 40px;
    border-radius: 20px;
    border: 1px solid rgba(0,0,0,0.1);
    background: #fff;
    transition: all 0.3s ease;
}

[data-bs-theme="dark"] .search-box input {
    background: #2c3e50;
    border-color: rgba(255,255,255,0.1);
}

.search-box input:focus {
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    border-color: #4e73df;
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    border: none;
    color: #4e73df;
    padding: 0.5rem 1rem;
    margin: 0 0.2rem;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #4e73df;
    color: white;
}

.page-item.active .page-link {
    background: #4e73df;
    color: white;
}

[data-bs-theme="dark"] .candidate-card {
    background: #2c3e50;
}

[data-bs-theme="dark"] .candidate-info h5 {
    color: #fff;
}

[data-bs-theme="dark"] .candidate-info p {
    color: #bdc3c7;
}
</style>

@push('scripts')
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchText = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.candidate-card');
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.closest('.col-md-4').style.display = text.includes(searchText) ? '' : 'none';
    });
});

// Delete confirmation
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>
@endpush
@endsection
