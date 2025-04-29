@extends('admin.layout')

@section('title', 'Class Details')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Class Details: {{ $class->name }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Class
            </a>
            <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Class Information</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $class->name }}</td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <td>{{ $class->level }}</td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td>{{ $class->section ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Academic Year</th>
                            <td>{{ $class->academic_year }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge badge-{{ $class->is_active ? 'success' : 'danger' }}">
                                    {{ $class->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Students</th>
                            <td>{{ $class->students_count }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
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
                                    <th>School</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->nama }}</td>
                                        <td>{{ $student->nip }}</td>
                                        <td>{{ $student->batch->name ?? '-' }}</td>
                                        <td>{{ $student->studentDetail->sekolah ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $student->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No students in this class yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
