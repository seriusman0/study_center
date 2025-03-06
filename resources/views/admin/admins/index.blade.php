@extends('admin.layout')

@section('title', 'Admins Management')

@section('page-title', 'Admins')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary mb-2">Create Admin</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->username }}</td>
                    <td>
                        <a href="{{ route('admin.admins.show', $admin->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
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
