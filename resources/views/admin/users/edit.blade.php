@extends('admin.layout')

@section('title', 'Edit User')

@section('page-title', 'Edit User')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}" required>
            @error('nama')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" class="form-control" name="nip" value="{{ old('nip', $user->nip) }}" required>
            @error('nip')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password">
            <small class="form-text text-muted">Leave blank to keep current password.</small>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection