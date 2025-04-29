@extends('admin.layout')

@section('title', 'Manage Batches')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Manage Batches</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.batches.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Batch
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Number of Students</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($batches as $batch)
                            <tr>
                                <td>{{ $batch->id }}</td>
                                <td>{{ $batch->name }}</td>
                                <td>{{ $batch->users_count }}</td>
                                <td>{{ $batch->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('admin.batches.edit', $batch->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @if($batch->users_count == 0)
                                        <form action="{{ route('admin.batches.destroy', $batch->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this batch?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
