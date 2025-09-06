@extends('admin.layout')

@section('title', 'Attendance Management')

@section('content')
<div class="container-fluid">
    <!-- Header buttons -->
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Attendance Management</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.attendance.import') }}" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Import Attendance
                </a>
                <a href="{{ route('admin.attendance.template') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Download Template
                </a>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Attendance List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Regular</th>
                                    <th>CSS</th>
                                    <th>CGG</th>
                                    <th>CGG Father</th>
                                    <th>CGG Mother</th>
                                    <th>SPR Sibling</th>
                                    <th colspan="3">Last Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->nama }}</td>
                                    <td>{{ optional($student->attendanceRecord)->regular_attendance ?? 0 }}</td>
                                    <td>{{ optional($student->attendanceRecord)->css_attendance ?? 0 }}</td>
                                    <td>{{ optional($student->attendanceRecord)->cgg_attendance ?? 0 }}</td>
                                    <td>{{ optional($student->attendanceRecord)->spr_father ?? 0 }}</td>
                                    <td>{{ optional($student->attendanceRecord)->spr_mother ?? 0 }}</td>
                                    <td>{{ optional($student->attendanceRecord)->spr_sibling ?? 0 }}</td>
                                    <td colspan="3">
                                        @if($student->attendanceRecord)
                                            <small class="text-muted">Last updated: {{ $student->attendanceRecord->updated_at->format('Y-m-d H:i') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $student->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modals -->
    @foreach($students as $student)
    <div class="modal fade" id="editModal{{ $student->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.attendance.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Attendance - {{ $student->nama }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Regular Attendance</label>
                                    <input type="number" name="regular_attendance" class="form-control" value="{{ optional($student->attendanceRecord)->regular_attendance ?? 0 }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CSS Attendance</label>
                                    <input type="number" name="css_attendance" class="form-control" value="{{ optional($student->attendanceRecord)->css_attendance ?? 0 }}" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CGG Attendance</label>
                                    <input type="number" name="cgg_attendance" class="form-control" value="{{ optional($student->attendanceRecord)->cgg_attendance ?? 0 }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Record Date</label>
                                    <input type="date" name="record_date" class="form-control" value="{{ optional($student->attendanceRecord)->record_date ?? now()->format('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CGG Father</label>
                                    <input type="number" name="spr_father" class="form-control" value="{{ optional($student->attendanceRecord)->spr_father ?? 0 }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CGG Mother</label>
                                    <input type="number" name="spr_mother" class="form-control" value="{{ optional($student->attendanceRecord)->spr_mother ?? 0 }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>SPR Sibling</label>
                                    <input type="number" name="spr_sibling" class="form-control" value="{{ optional($student->attendanceRecord)->spr_sibling ?? 0 }}" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ optional($student->attendanceRecord)->notes }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
