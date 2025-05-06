@extends('admin.layout')

@section('title', 'Statistics Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Statistics Dashboard</h1>

    <!-- Overall Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body text-white">
                    <h5 class="card-title">Total Students</h5>
                    <h2>{{ $overallStats['total_students'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success">
                <div class="card-body text-white">
                    <h5 class="card-title">Avg Journal Submission</h5>
                    <h2>{{ number_format($overallStats['avg_journal_submission_rate'], 1) }}%</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body text-white">
                    <h5 class="card-title">Avg Attendance Rate</h5>
                    <h2>{{ number_format($overallStats['avg_attendance_rate'], 1) }}%</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-body text-white">
                    <h5 class="card-title">Avg Permission Approval</h5>
                    <h2>{{ number_format($overallStats['avg_permission_approval_rate'], 1) }}%</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Statistics Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Detailed Student Statistics</h3>
            <div>
                <a href="{{ route('admin.journals.download-all') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Export Report
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th colspan="3" class="text-center bg-success text-white">Journal Statistics</th>
                            <th colspan="3" class="text-center bg-primary text-white">Attendance Statistics</th>
                            <th colspan="3" class="text-center bg-warning text-white">Permission Statistics</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <!-- Journal Headers -->
                            <th>Total</th>
                            <th>Submitted</th>
                            <th>Rate</th>
                            <!-- Attendance Headers -->
                            <th>Total</th>
                            <th>Present</th>
                            <th>Rate</th>
                            <!-- Permission Headers -->
                            <th>Total</th>
                            <th>Approved</th>
                            <th>Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student['nama'] }}</td>
                                <td>{{ $student['kelas'] }}</td>
                                <!-- Journal Data -->
                                <td>{{ $student['total_journals'] }}</td>
                                <td>{{ $student['submitted_journals'] }}</td>
                                <td>{{ number_format($student['journal_submission_rate'], 1) }}%</td>
                                <!-- Attendance Data -->
                                <td>{{ $student['total_attendance'] }}</td>
                                <td>{{ $student['present_attendance'] }}</td>
                                <td>{{ number_format($student['attendance_rate'], 1) }}%</td>
                                <!-- Permission Data -->
                                <td>{{ $student['total_permissions'] }}</td>
                                <td>{{ $student['approved_permissions'] }}</td>
                                <td>{{ number_format($student['permission_approval_rate'], 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
