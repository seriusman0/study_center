<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Journals | Study Center</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/styles.css') }}">
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('student.journals.index') }}">My Journals</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content-->
    <div class="container px-4 px-lg-5 mt-5">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row gx-4 gx-lg-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">My Journal Entries</h4>
                        <a href="{{ route('student.journals.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Entry
                        </a>
                    </div>
                    <div class="card-body">
                        @if($journals->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-3">You haven't created any journal entries yet.</p>
                                <a href="{{ route('student.journals.create') }}" class="btn btn-primary">
                                    Create Your First Entry
                                </a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Activities</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($journals as $journal)
                                            <tr>
                                                <td>{{ $journal->entry_date->format('d M Y') }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <span class="badge bg-{{ $journal->mengawali_hari_dengan_berdoa ? 'success' : 'danger' }}" title="Berdoa">
                                                            <i class="fas fa-pray"></i>
                                                        </span>
                                                        <span class="badge bg-{{ $journal->baca_alkitab_pl && $journal->baca_alkitab_pb ? 'success' : 'danger' }}" title="Baca Alkitab">
                                                            <i class="fas fa-book"></i>
                                                        </span>
                                                        <span class="badge bg-{{ $journal->hadir_kelas_sc ? 'success' : 'danger' }}" title="SC">
                                                            SC
                                                        </span>
                                                        <span class="badge bg-{{ $journal->hadir_css ? 'success' : 'danger' }}" title="CSS">
                                                            CSS
                                                        </span>
                                                        <span class="badge bg-{{ $journal->hadir_cgg ? 'success' : 'danger' }}" title="CGG">
                                                            CGG
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($journal->is_submitted)
                                                        <span class="badge bg-success">Submitted</span>
                                                    @else
                                                        <span class="badge bg-warning">Draft</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('student.journals.show', $journal) }}" 
                                                       class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('student.journals.edit', $journal) }}" 
                                                       class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('student.journals.destroy', $journal) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this journal entry?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $journals->links() }}
                            </div>
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
</body>
</html>
