@extends('admin.layout')

@section('title', 'Edit Class')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Edit Class</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.classes.update', $class->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Class Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $class->name) }}" required>
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
                                    <option value="{{ $level }}" {{ old('level', $class->level) == $level ? 'selected' : '' }}>
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
                                    <option value="{{ $section }}" {{ old('section', $class->section) == $section ? 'selected' : '' }}>
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
                                   value="{{ old('academic_year', $class->academic_year) }}" 
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
                               name="is_active" {{ old('is_active', $class->is_active) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Class</button>
                    <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @if($class->students_count > 0)
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Students in this Class</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>NIP</th>
                            <th>Batch</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($class->students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->nama }}</td>
                                <td>{{ $student->nip }}</td>
                                <td>{{ $student->batch->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $student->id) }}" class="btn btn-sm btn-info">
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
