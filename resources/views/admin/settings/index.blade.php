@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Pengaturan Sistem</h2>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pengaturan Pemilihan</h5>
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Status Pemilihan</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="voting_enabled" id="votingEnabled" 
                                    {{ $settings->voting_enabled ? 'checked' : '' }}>
                                <label class="form-check-label" for="votingEnabled">Aktifkan Pemilihan</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Periode Pemilihan</label>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="datetime-local" class="form-control" name="voting_start" 
                                        value="{{ $settings->voting_start }}">
                                </div>
                                <div class="col">
                                    <input type="datetime-local" class="form-control" name="voting_end" 
                                        value="{{ $settings->voting_end }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Aturan Pemilihan</label>
                            <textarea class="form-control" name="voting_rules" rows="4">{{ $settings->voting_rules }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Preferensi Sistem</h5>
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Sistem</label>
                            <input type="text" class="form-control" name="system_name" 
                                value="{{ $settings->system_name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Logo Sistem</label>
                            <input type="file" class="form-control" name="system_logo">
                            @if($settings->system_logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $settings->system_logo) }}" 
                                        alt="Logo Sistem" class="img-thumbnail" style="max-height: 100px">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pengaturan Email</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="email_notifications" 
                                    id="emailNotifications" {{ $settings->email_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="emailNotifications">Aktifkan Notifikasi Email</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pengaturan SMTP</label>
                            <input type="text" class="form-control mb-2" name="smtp_host" 
                                placeholder="Host SMTP" value="{{ $settings->smtp_host }}">
                            <input type="text" class="form-control mb-2" name="smtp_port" 
                                placeholder="Port SMTP" value="{{ $settings->smtp_port }}">
                            <input type="text" class="form-control mb-2" name="smtp_username" 
                                placeholder="Nama Pengguna SMTP" value="{{ $settings->smtp_username }}">
                            <input type="password" class="form-control" name="smtp_password" 
                                placeholder="Kata Sandi SMTP">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.form-control {
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,0.1);
    padding: 0.8rem 1rem;
    transition: all 0.3s ease;
}

[data-bs-theme="dark"] .form-control {
    background: var(--card-bg-dark);
    border-color: rgba(255,255,255,0.1);
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(65, 105, 225, 0.25);
    border-color: var(--primary-color);
}

.form-label {
    font-weight: 500;
    color: var(--text-light);
    margin-bottom: 0.5rem;
}

[data-bs-theme="dark"] .form-label {
    color: var(--text-dark);
}

.btn-primary {
    padding: 0.8rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
}

.img-thumbnail {
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,0.1);
}

[data-bs-theme="dark"] .img-thumbnail {
    border-color: rgba(255,255,255,0.1);
}
</style>

<script>
// Add any necessary JavaScript for form validation or dynamic behavior
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add your form submission logic here
    });
});
</script>
@endsection 