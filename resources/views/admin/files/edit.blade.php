@extends('admin.layout')

@section('title', 'Edit File')

@section('page-title', 'Edit File')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">User:</label>
            <select class="form-control" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $file->user_id == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="file">File (PDF only):</label>
            <input type="file" class="form-control" name="file">
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection