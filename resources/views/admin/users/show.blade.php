@extends('admin.layout')

@section('title', 'User Details')

@section('page-title', 'User Details')

@section('content')
<div class="container-fluid">
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td>{{ $user->nama }}</td>
        </tr>
        <tr>
            <th>NIP</th>
            <td>{{ $user->nip }}</td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{ $user->username }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $user->updated_at }}</td>
        </tr>
    </table>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users</a>
</div>
@endsection