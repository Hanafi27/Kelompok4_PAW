@extends('layouts.adminlte')

@section('page-title', 'Pemilihan')
@section('breadcrumb', 'Pemilihan')

@section('content')
<div class="card">
    <div class="card-header bg-gradient-primary">
        <h3 class="card-title text-white">
            <i class="fas fa-vote-yea mr-2"></i> Pilih Kandidat Terbaik
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($candidates as $candidate)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-top position-relative" style="height: 200px; overflow: hidden;">
                            @if($candidate->image_path)
                                <img src="{{ asset('storage/' . $candidate->image_path) }}" alt="{{ $candidate->name }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title mb-3">{{ $candidate->name }}</h4>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-info btn-sm detail-btn" 
                                    data-name="{{ $candidate->name }}"
                                    data-vision="{{ $candidate->vision }}"
                                    data-mission="{{ $candidate->mission }}"
                                    data-image="{{ asset('storage/' . $candidate->image_path) }}"
                                    onclick="showCandidateDetails(this)">
                                    <i class="fas fa-info-circle"></i> Detail
                                </button>
                                <form class="voteForm d-inline" method="POST" action="{{ route('vote.store') }}">
                                    @csrf
                                    <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                    <button class="btn btn-success btn-sm vote-btn" type="submit">
                                        <i class="fas fa-vote-yea"></i> Pilih
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Candidate Detail Modal -->
<div class="modal fade" id="candidateModal" tabindex="-1" role="dialog" aria-labelledby="candidateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="candidateModalLabel">
                    <i class="fas fa-user-circle mr-2"></i> Detail Kandidat
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <img id="modalCandidateImage" src="" alt="Candidate" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 id="modalCandidateName" class="mb-2"></h4>
                </div>
                <div class="mb-4">
                    <h5 class="border-bottom pb-2">
                        <i class="fas fa-eye mr-2"></i>Visi
                    </h5>
                    <p id="modalCandidateVision" class="mb-0"></p>
                </div>
                <div>
                    <h5 class="border-bottom pb-2">
                        <i class="fas fa-bullseye mr-2"></i>Misi
                    </h5>
                    <p id="modalCandidateMission" class="mb-0"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Use Bootstrap's modal functionality
var candidateModal = new bootstrap.Modal(document.getElementById('candidateModal'));

function showCandidateDetails(button) {
    var name = button.dataset.name;
    var vision = button.dataset.vision;
    var mission = button.dataset.mission;
    var image = button.dataset.image;

    // Update modal content
    document.getElementById('modalCandidateImage').src = image;
    document.getElementById('modalCandidateName').textContent = name;
    document.getElementById('modalCandidateVision').textContent = vision;
    document.getElementById('modalCandidateMission').textContent = mission;

    // Show modal using Bootstrap's JS
    candidateModal.show();
}

// Vote form submission with animation and SweetAlert2 for warnings
$(document).ready(function() {
    // Ensure jQuery is loaded before this script
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded. Vote form functionality may not work.');
        return;
    }

    $('.voteForm').on('submit', function(event) {
        event.preventDefault();
        var $form = $(this);
        var $voteBtn = $form.find('.vote-btn');

        // Add voting animation class and disable button
        $voteBtn.addClass('voting').prop('disabled', true);

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                $voteBtn.removeClass('voting'); // Remove animation regardless of outcome
                if (response.existingVote) {
                    $voteBtn.prop('disabled', false); // Re-enable if already voted
                    // Use SweetAlert2 for warning
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Anda sudah melakukan pemilihan sebelumnya!',
                        confirmButtonColor: '#ffc107', // Warning color
                        customClass: {
                            popup: 'animated shake'
                        }
                    });
                } else {
                    // Show success animation and SweetAlert2
                    $voteBtn.addClass('voted-success');
                    $voteBtn.find('span').html('<i class="fas fa-check"></i> Terpilih'); // Update button text

                    // Disable all other vote buttons after a successful vote
                    $('.vote-btn').prop('disabled', true)
                        .removeClass('voting')
                        .addClass('voted-success')
                        .find('span')
                        .html('<i class="fas fa-check"></i> Terpilih');

                    // Show success message with animation
                    Swal.fire({
                        icon: 'success',
                        title: 'Pemilihan Berhasil!',
                        text: 'Terima kasih telah berpartisipasi dalam pemilihan.',
                        confirmButtonColor: '#28a745', // Success color
                        customClass: {
                            popup: 'animated bounceIn'
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                $voteBtn.removeClass('voting').prop('disabled', false); // Re-enable on error
                console.error("AJAX Error: ", status, error, xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonColor: '#dc3545', // Error color
                    customClass: {
                        popup: 'animated shake'
                    }
                });
            }
        });
    });
});
</script>

<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card-img-top {
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2c3e50;
}

.btn {
    padding: 0.5rem 1rem;
    font-weight: 500;
    border-radius: 0.25rem;
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.modal-content {
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.modal-title {
    font-weight: 600;
    color: #2c3e50;
}

.modal-body {
    padding: 2rem;
}

.modal-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
}
</style>
@endpush
@endsection
