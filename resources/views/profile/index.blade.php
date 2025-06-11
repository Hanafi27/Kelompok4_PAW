@extends('layouts.adminlte')

@section('page-title', 'Profil')
@section('breadcrumb', 'Profil Saya')

@push('styles')
<style>
.profile-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

.profile-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    overflow: hidden;
}

.profile-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    padding: 2rem;
    text-align: center;
    color: white;
    position: relative;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid white;
    margin: 0 auto 1rem;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: #007bff;
}

.profile-name {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.profile-role {
    font-size: 1rem;
    opacity: 0.9;
}

.profile-body {
    padding: 2rem;
}

.profile-info {
    margin-bottom: 1.5rem;
}

.profile-info-label {
    font-size: 0.875rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

.profile-info-value {
    font-size: 1rem;
    color: #2c3e50;
    font-weight: 500;
}

.profile-actions {
    padding: 1.5rem;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
    text-align: center;
}

.btn-edit-profile {
    padding: 0.75rem 2rem;
    font-weight: 500;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-edit-profile:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.info-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.info-icon {
    font-size: 1.5rem;
    color: #007bff;
    margin-bottom: 1rem;
}
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h2 class="profile-name">{{ $user->name }}</h2>
            <div class="profile-role">
                {{ $user->role === 'admin' ? 'Administrator' : 'Pemilih' }}
            </div>
        </div>
        
        <div class="profile-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="profile-info">
                            <div class="profile-info-label">Email</div>
                            <div class="profile-info-value">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="profile-info">
                            <div class="profile-info-label">Bergabung Sejak</div>
                            <div class="profile-info-value">{{ $user->created_at->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="profile-info">
                            <div class="profile-info-label">Status Akun</div>
                            <div class="profile-info-value">
                                <span class="badge bg-success">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-actions">
            <button type="button" class="btn btn-primary btn-edit-profile" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fas fa-edit me-2"></i>Edit Profil
            </button>
        </div>
    </div>
</div>

@include('profile.edit')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Add animation when hovering over info cards
    $('.info-card').hover(
        function() {
            $(this).find('.info-icon').addClass('animate__animated animate__pulse');
        },
        function() {
            $(this).find('.info-icon').removeClass('animate__animated animate__pulse');
        }
    );

    // Initialize Bootstrap modal
    const editProfileModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
});
</script>
@endpush

