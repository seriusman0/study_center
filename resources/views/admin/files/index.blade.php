@extends('admin.layout')

@section('title', 'Files Management')

@section('page-title', 'Files')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.files.create') }}" class="btn btn-primary mb-2">Upload File</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>File Name</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $file->file_name }}</td>
                    <td>{{ $file->user->nama }}</td>
                    <td>
                        <a href="{{ route('admin.files.view', $file->id) }}" class="btn btn-info" target="_blank">View</a>
                        <a href="{{ route('admin.files.edit', $file->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.files.destroy', $file->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection