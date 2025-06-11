@extends('layouts.adminlte')

@section('page-title', 'Daftar Mahasiswa')
@section('breadcrumb', 'Mahasiswa')

@section('content')
    <!-- Your custom content goes here -->
    <div class="card">
        <div class="card-header">
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudentModal">
                <i class="fas fa-plus-circle"></i> Tambah Mahasiswa
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $counter = 1; // Initialize a counter for sequential IDs
                    @endphp
                        @foreach ($users as $user)
                            <tr id="user_row_{{ $user->id }}">
                                <td>{{ $counter }}</td>
                                <td class="user-name">{{ $user->name }}</td>
                                <td class="user-email">{{ $user->email }}</td>
                                <td class="user-role">{{ $user->role }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary btn-sm mr-2 edit-btn"
                                            data-toggle="modal" data-target="#editModal"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}"
                                            data-user-email="{{ $user->email }}"
                                            data-user-role="{{ $user->role }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.students.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @php
                            $counter++; // Increment counter for next iteration
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right"></ul>
        </div>
    </div>

    @include('admin.students.create')
    @include('admin.students.edit')

@endsection

@push('scripts')
    <!-- Additional scripts -->
    <script>
$(document).ready(function() {
    // Function to populate modal with user data when edit button is clicked
    $(document).on('click', '.edit-btn', function() {
        var userId = $(this).data('user-id');
        var userName = $(this).data('user-name');
        var userEmail = $(this).data('user-email');
        var userRole = $(this).data('user-role');

        // Update modal fields with new data
        $('#editModal').find('.modal-title').text('Edit Mahasiswa');
        $('#editModal').find('#editId').val(userId);
        $('#editModal').find('#editName').val(userName);
        $('#editModal').find('#editEmail').val(userEmail);
        $('#editModal').find('#editRole').val(userRole);

        $('#editModal').modal('show');
    });

    // Ensure the modal content is cleared when the modal is hidden
    $('#editModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset(); // Reset form fields
    });

    // Handle form submission
    $('#editForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var userId = $('#editId').val();

        $.ajax({
            url: $(this).attr('action').replace('__userId__', userId),
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log('Form submission successful');
                console.log('Response:', response);
                $('#editModal').modal('hide');

                // Update the corresponding row in the table with the updated data
                $('#user_row_' + userId).find('.user-name').text($('#editName').val());
                $('#user_row_' + userId).find('.user-email').text($('#editEmail').val());
                $('#user_row_' + userId).find('.user-role').text($('#editRole').val());

                // Re-populate modal with updated data
                $('.edit-btn[data-user-id="' + userId + '"]').data('user-name', $('#editName').val());
                $('.edit-btn[data-user-id="' + userId + '"]').data('user-email', $('#editEmail').val());
                $('.edit-btn[data-user-id="' + userId + '"]').data('user-role', $('#editRole').val());
            },
            error: function(error) {
                console.error('Form submission error:', error);
                console.log('Error Response:', error.responseJSON);
                var errors = error.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value[0] + '<br>';
                });
                $('#formErrors').html('<div class="alert alert-danger">'+ errorMessage +'</div>');
            }
        });
    });
});

    </script>
@endpush
