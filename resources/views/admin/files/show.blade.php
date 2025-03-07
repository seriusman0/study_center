@extends('admin.layout')

@section('title', 'Admin Details')

@section('page-title', 'Admin Details')

@section('content')
<div class="container-fluid">
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <td>{{ $admin->name }}</td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{ $admin->username }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $admin->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $admin->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Back to Admins</a>
</div>
@endsection