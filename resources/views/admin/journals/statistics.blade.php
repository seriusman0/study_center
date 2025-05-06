@extends('admin.layout')

@section('title', 'Statistics Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Statistics Dashboard</h1>
    
    @livewire('journal-statistics')
</div>
@endsection

@push('css')
<style>
    .card {
        margin-bottom: 1rem;
    }
    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endpush
