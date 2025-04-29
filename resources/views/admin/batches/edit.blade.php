@extends('admin.layout')

@section('title', 'Edit Batch')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Edit Batch</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.batches.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Batch Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $batch->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Batch</button>
                    <a href="{{ route('admin.batches.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @if($batch->users_count > 0)
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Students in this Batch</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>NIP</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($batch->users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->nip }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
