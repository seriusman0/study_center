<div>
    <!-- Filter Controls -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Filter Options</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="classRange">Class Range:</label>
                        <select wire:model.live="classRange" class="form-control">
                            <option value="7-9">7-9</option>
                            <option value="10-12">10-12</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalClasses">Total Classes:</label>
                        <input type="number" wire:model.live="totalClasses" class="form-control" min="1" max="12">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="selectedPeriod">Periode:</label>
                        <select wire:model.live="selectedPeriod" class="form-control">
                            @foreach($periods as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <h2>{{ number_format($overallStats['avg_attendance_percentage'], 1) }}%</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-body text-white">
                    <h5 class="card-title">Students with Appreciation</h5>
                    <h2>{{ $overallStats['total_with_appreciation'] }}</h2>
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
                            <th>SPP</th>
                            <th>Status</th>
                            <th>Pembayaran Final</th>
                            <th colspan="2" class="text-center bg-success text-white">Journal Statistics</th>
                            <th colspan="6" class="text-center bg-primary text-white">Attendance Statistics</th>
                            <th colspan="3" class="text-center bg-warning text-white">Permission Statistics</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <!-- Journal Headers -->
                            <th>Submitted</th>
                            <th>Rate</th>
                            <!-- Attendance Headers -->
                            <th>Regular</th>
                            <th>CSS</th>
                            <th>CGG</th>
                            <th>Total</th>
                            <th>Percentage</th>
                            <th>Total SPR</th>
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
                                <td>{{ $student['spp'] }}</td>
                                <td>
                                    @if($student['has_appreciation'])
                                        <span class="badge bg-success">Apresiasi</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student['final_payment'] !== null)
                                        {{ number_format($student['final_payment'], 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <!-- Journal Data -->
                                <td>{{ $student['submitted_journals'] }}</td>
                                <td>{{ number_format($student['journal_submission_rate'], 1) }}%</td>
                                <!-- Attendance Data -->
                                <td>{{ $student['regular_attendance'] }}</td>
                                <td>{{ $student['css_attendance'] }}</td>
                                <td>{{ $student['cgg_attendance'] }}</td>
                                <td>{{ $student['total_attendance'] }}</td>
                                <td>{{ number_format($student['attendance_percentage'], 1) }}%</td>
                                <td>{{ $student['total_spr_attendance'] }}</td>
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
