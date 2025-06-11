@extends('layouts.adminlte')

@section('page-title', 'Mahasiswa')
@section('breadcrumb', 'Students')

@section('content')
    <!-- Your custom content goes here -->
    <h1>Edit Mahasiswa</h1>
    <form method="POST" action="{{ route('admin.students.update', $user) }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $user->name }}">
        <input type="email" name="email" value="{{ $user->email }}">
        @if (Auth::check() && Auth::user()->role === 'admin')
        <select name="role">
            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        @endif
        <button type="submit">Update</button>
    </form>
@endsection

@push('scripts')
    <!-- Additional scripts -->
@endpush

