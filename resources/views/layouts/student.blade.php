<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student | Study Center')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/styles.css') }}">
    @stack('styles')
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
        .bg-info { background-color: #3498DB !important; }
        .bg-success { background-color: #2ECC71 !important; }
        .bg-warning { background-color: #F1C40F !important; }
        .bg-danger { background-color: #E74C3C !important; }
    </style>
</head>
<body style="min-height: 100vh; display: flex; flex-direction: column;">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#">Study Center</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.journals.index') }}">Jurnal</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.permissions.index') }}">Izin</a></li>
                    <li class="nav-item">
                        <form action="{{ route('student.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn nav-link border-0 bg-transparent">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container px-4 px-lg-5 mt-5" style="flex-grow: 1;">
        @yield('content')
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark mt-auto">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Hak Cipta &copy; Study Center {{ date('Y') }}</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
