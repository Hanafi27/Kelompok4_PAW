@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg mt-5 border-0">
                <div class="card-body p-5">
                    <h2 class="card-title mb-4 text-center fw-bold">Tambah Pengguna Baru</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <select name="role" class="form-select" required>
                                <option value="user" @if(old('role')=='user') selected @endif>Pengguna</option>
                                <option value="admin" @if(old('role')=='admin') selected @endif>Admin</option>
                            </select>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Pengguna
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
</style>
@endsection 