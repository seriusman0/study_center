<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permission Request Details | Study Center</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/styles.css') }}">
    <!-- Custom styles -->
    <style>
        .detail-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }
        .status-badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#">Study Center</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.permissions.index') }}">My Permissions</a></li>
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
        <div class="detail-container">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Permission Request Details</h4>
                        <span class="badge bg-{{ $permission->status_badge }} status-badge">
                            {{ ucfirst($permission->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Request Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 150px">Class Type:</th>
                                    <td class="text-uppercase">{{ $permission->class_type }}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $permission->date->format('l, d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Submitted:</th>
                                    <td>{{ $permission->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Student Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 150px">Name:</th>
                                    <td>{{ $permission->user->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIP:</th>
                                    <td>{{ $permission->user->nip }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Reason</h5>
                        <p class="mb-0">{{ $permission->reason }}</p>
                    </div>

                    @if($permission->attachment)
                        <div class="mb-4">
                            <h5>Supporting Document</h5>
                            <a href="{{ Storage::url($permission->attachment) }}" 
                               class="btn btn-sm btn-primary" 
                               target="_blank">
                                <i class="fas fa-file-download"></i> View Document
                            </a>
                        </div>
                    @endif

                    @if($permission->admin_notes)
                        <div class="mb-4">
                            <h5>Admin Notes</h5>
                            <p class="mb-0">{{ $permission->admin_notes }}</p>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('student.permissions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        @if($permission->status === 'pending')
                            <form action="{{ route('student.permissions.destroy', $permission) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to cancel this request?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times"></i> Cancel Request
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark mt-5">
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
