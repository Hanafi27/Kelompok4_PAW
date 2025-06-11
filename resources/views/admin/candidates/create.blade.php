@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg mt-5 border-0">
                <div class="card-body p-5">
                    <h2 class="card-title mb-4 text-center fw-bold">Tambah Kandidat Baru</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.candidates.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" class="form-control" placeholder="Nama Kandidat" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="vision" class="form-label">Visi</label>
                            <textarea name="vision" id="vision" class="form-control" rows="3" required>{{ old('vision') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="mission" class="form-label">Misi</label>
                            <textarea name="mission" id="mission" class="form-control" rows="3" required>{{ old('mission') }}</textarea>
                        </div>
                         <div class="mb-3">
                            <label for="image" class="form-label">Gambar Kandidat</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Kandidat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.card-title {
    letter-spacing: 1px;
}
.input-group-text {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: #fff;
    border: none;
}
.form-control, .form-select {
    border-radius: 0 8px 8px 0;
}
.input-group .form-control, .input-group .form-select {
    border-left: 0;
}
.btn-primary {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
}
.btn-primary:hover {
    opacity: 0.9;
}
/* Style for textarea */
textarea.form-control {
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.1);
    background: var(--card-bg-light);
    transition: all 0.3s ease;
}
[data-bs-theme="dark"] textarea.form-control {
    background: var(--card-bg-dark);
    border-color: rgba(255,255,255,0.1);
}
textarea.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(65, 105, 225, 0.25);
    border-color: var(--primary-color);
}
</style>
@endsection
