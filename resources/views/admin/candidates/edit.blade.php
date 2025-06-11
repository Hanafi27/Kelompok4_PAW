@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg mt-5 border-0">
                <div class="card-body p-5">
                    <h2 class="card-title mb-4 text-center fw-bold">Edit Kandidat</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.candidates.update', $candidate->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div class="current-image mb-3">
                                @if($candidate->image_path)
                                    <img src="{{ asset('storage/' . $candidate->image_path) }}" alt="{{ $candidate->name }}" class="img-thumbnail" style="max-width: 200px;">
                                @else
                                    <div class="no-image-placeholder">
                                        <i class="bi bi-person-circle"></i>
                                        <p>Tidak ada gambar tersedia</p>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Ubah Gambar</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                <small class="text-muted">Biarkan kosong untuk mempertahankan gambar saat ini</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $candidate->name) }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="vision" class="form-label">Visi</label>
                            <textarea name="vision" id="vision" class="form-control" rows="4" required>{{ old('vision', $candidate->vision) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="mission" class="form-label">Misi</label>
                            <textarea name="mission" id="mission" class="form-control" rows="4" required>{{ old('mission', $candidate->mission) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    background: #fff;
    border-radius: 15px;
}

[data-bs-theme="dark"] .card {
    background: #2c3e50;
}

.card-title {
    color: #2c3e50;
    letter-spacing: 1px;
}

[data-bs-theme="dark"] .card-title {
    color: #fff;
}

.input-group-text {
    background: linear-gradient(45deg, #4e73df, #224abe);
    color: #fff;
    border: none;
}

.form-control {
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.1);
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

[data-bs-theme="dark"] .form-control {
    background: #34495e;
    border-color: rgba(255,255,255,0.1);
    color: #fff;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    border-color: #4e73df;
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.current-image {
    text-align: center;
}

.current-image img {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.no-image-placeholder {
    width: 200px;
    height: 200px;
    background: #f8f9fa;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #adb5bd;
    margin: 0 auto;
}

[data-bs-theme="dark"] .no-image-placeholder {
    background: #34495e;
    color: #95a5a6;
}

.no-image-placeholder i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.btn {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    border: none;
}

.btn-primary:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

.btn-outline-secondary {
    border: 1px solid #6c757d;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: #fff;
    transform: translateY(-2px);
}

.alert {
    border-radius: 10px;
    border: none;
}

.alert-danger {
    background: #fee2e2;
    color: #dc2626;
}

[data-bs-theme="dark"] .alert-danger {
    background: rgba(220, 38, 38, 0.2);
    color: #fca5a5;
}
</style>

@push('scripts')
<script>
// Preview image before upload
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.current-image');
            preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px;">`;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
