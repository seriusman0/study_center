@extends('admin.layout')

@section('title', 'Manage Classes')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Manage Classes</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Class
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
                            <th>Name</th>
                            <th>Level</th>
                            <th>Section</th>
                            <th>Academic Year</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->level }}</td>
                                <td>{{ $class->section ?? '-' }}</td>
                                <td>{{ $class->academic_year }}</td>
                                <td>{{ $class->students_count }}</td>
                                <td>
                                    <span class="badge badge-{{ $class->is_active ? 'success' : 'danger' }}">
                                        {{ $class->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.classes.show', $class->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @if($class->students_count == 0)
                                        <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this class?')">
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
