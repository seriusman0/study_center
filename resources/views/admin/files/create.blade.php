@extends('admin.layout')

@section('title', 'Upload File')

@section('page-title', 'Upload File')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="user_id">User:</label>
            <select class="form-control" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="file">File (PDF only):</label>
            <input type="file" class="form-control" name="file" required>
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection