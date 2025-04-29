@extends('admin.layout')

@section('title', 'Create Batch')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Create New Batch</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.batches.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Batch Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Batch</button>
                    <a href="{{ route('admin.batches.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
