<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard | Study Center</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/styles.css') }}">
    <!-- Custom styles -->
    <style>
        .info-box {
            min-height: 100px;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
            padding: 1rem;
        }
        .info-box-icon {
            width: 60px;
            height: 60px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            float: left;
            margin-right: 1rem;
        }
        .info-box-icon i {
            font-size: 1.5rem;
            color: #fff;
        }
        .info-box-content {
            padding: 0.5rem 0;
        }
        .bg-info { background-color: #3498DB !important; }
        .bg-success { background-color: #2ECC71 !important; }
        .bg-warning { background-color: #F1C40F !important; }
        .bg-danger { background-color: #E74C3C !important; }
    </style>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#">Study Center</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <form action="{{ route('student.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn nav-link border-0 bg-transparent">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content-->
    <div class="container px-4 px-lg-5 mt-5">
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
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Copyright &copy; Study Center {{ date('Y') }}</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/scripts.js') }}"></script>
</body>
</html>
