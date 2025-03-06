@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h1 class="m-0 text-dark">User Details</h1>
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
