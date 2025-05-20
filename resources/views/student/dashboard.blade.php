@extends('layouts.student')

@section('title', 'Student Dashboard | Study Center')

@section('content')
    <!-- Welcome-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7">
            <h1 class="font-weight-light">Welcome, {{ $student->nama }}!</h1>
            <p>This is your personal dashboard where you can monitor your attendance and academic progress.</p>
        </div>
    </div>

    <!-- Attendance Stats -->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-3 mb-5">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-user-graduate"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Regular Attendance</span>
                    <span class="info-box-number">{{ $attendanceRecord->regular_attendance ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-5">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">CSS Attendance</span>
                    <span class="info-box-number">{{ $attendanceRecord->css_attendance ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-5">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-pencil-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">CGG Attendance</span>
                    <span class="info-box-number">{{ $attendanceRecord->cgg_attendance ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-5">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-book-open"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Journal Entries</span>
                    <span class="info-box-number">{{ $attendanceRecord->journal_entry ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Journal Card -->
    <div class="row gx-4 gx-lg-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daily Journal</h5>
                    <a href="{{ route('student.journals.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Entry
                    </a>
                </div>
                <div class="card-body">
                    @if($student->journals()->latest()->first())
                        <div class="alert alert-info">
                            <h6 class="alert-heading">Latest Journal Entry</h6>
                            <p class="mb-0">
                                Submitted on {{ $student->journals()->latest()->first()->created_at->format('d F Y, H:i') }}
                            </p>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('student.journals.index') }}" class="btn btn-link">View All Entries</a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-3">You haven't created any journal entries yet.</p>
                            <a href="{{ route('student.journals.create') }}" class="btn btn-primary">
                                Create Your First Entry
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Permission Request Card -->
    <div class="row gx-4 gx-lg-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Permission Requests</h5>
                    <a href="{{ route('student.permissions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Request
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Class Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($student->permissionRequests()->latest()->take(5)->get() as $request)
                                    <tr>
                                        <td>{{ $request->date->format('d M Y') }}</td>
                                        <td><span class="text-uppercase">{{ $request->class_type }}</span></td>
                                        <td>
                                            <span class="badge bg-{{ $request->status_badge }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('student.permissions.show', $request) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <p class="text-muted mb-0">No permission requests found.</p>
                                            <a href="{{ route('student.permissions.create') }}" class="btn btn-primary mt-2">
                                                Create New Request
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($student->permissionRequests()->count() > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('student.permissions.index') }}" class="btn btn-link">
                                View All Requests
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Student Details -->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-6 mb-5">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student Information</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width:30%">Name</th>
                            <td>{{ $student->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>{{ $student->nip }}</td>
                        </tr>
                        <tr>
                            <th>School</th>
                            <td>{{ $studentDetail->sekolah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Class Level</th>
                            <td>{{ $studentDetail->tingkat_kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Academic Year</th>
                            <td>{{ $studentDetail->tahun_ajaran ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">SPR Information</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width:30%">Permission</th>
                            <td>{{ $attendanceRecord->permission ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th>SPR Father</th>
                            <td>{{ $attendanceRecord->spr_father ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th>SPR Mother</th>
                            <td>{{ $attendanceRecord->spr_mother ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th>SPR Sibling</th>
                            <td>{{ $attendanceRecord->spr_sibling ?? 0 }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
