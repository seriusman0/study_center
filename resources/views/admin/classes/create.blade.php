@extends('admin.layout')

@section('title', 'Create Class')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Create New Class</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Class Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control @error('level') is-invalid @enderror" 
                                    id="level" name="level" required>
                                <option value="">Select Level</option>
                                @foreach(['10', '11', '12'] as $level)
                                    <option value="{{ $level }}" {{ old('level') == $level ? 'selected' : '' }}>
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                            @error('level')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="section">Section</label>
                            <select class="form-control @error('section') is-invalid @enderror" 
                                    id="section" name="section">
                                <option value="">Select Section</option>
                                @foreach(['A', 'B', 'C', 'D', 'E'] as $section)
                                    <option value="{{ $section }}" {{ old('section') == $section ? 'selected' : '' }}>
                                        {{ $section }}
                                    </option>
                                @endforeach
                            </select>
                            @error('section')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="academic_year">Academic Year</label>
                            <input type="text" class="form-control @error('academic_year') is-invalid @enderror" 
                                   id="academic_year" name="academic_year" 
                                   value="{{ old('academic_year', date('Y').'/'.((int)date('Y')+1)) }}" 
                                   placeholder="2023/2024" required>
                            @error('academic_year')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_active" 
                               name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Class</button>
                    <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
