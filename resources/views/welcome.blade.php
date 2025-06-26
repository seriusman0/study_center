<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Study Center!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #3498DB;
            --accent-color: #E74C3C;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .welcome-container {
            min-height: 100vh;
            padding: 2rem;
        }

        .brand-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .login-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .login-icon {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        /* Responsive video container */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Study Center</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home-section">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-section">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog-section">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="welcome-container" id="home-section">
        <div class="container">
            <!-- Video Profile Section -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="video-container">
                        <iframe 
                            src="https://www.youtube.com/embed/Q4USmWT0JCA?si=ihLzFE4FcUIRMS2k" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="text-center mb-5" id="about-section">
                <h1 class="brand-title display-4">Selamat Datang di Study Center!</h1>
            </div>

            <!-- Payment Proof Search Section -->
            <div class="row justify-content-center mb-5" id="payment-search-section">
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Search Payment Proof Files</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="GET">
                                <div class="mb-3">
                                    <label for="nip" class="form-label fw-bold">Enter your NIP:</label>
                                    <input type="number" 
                                           class="form-control form-control-lg" 
                                           id="nip" 
                                           name="nip" 
                                           placeholder="e.g., 123456789"
                                           required>
                                    <div class="form-text text-muted">
                                        Enter your NIP to view your payment proof files
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-search me-2"></i>Search Files
                                </button>
                            </form>
                            @if(session('error'))
                                <div class="alert alert-danger mt-3">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Options -->
            <div class="row justify-content-center g-4">
                <div class="col-md-4">
                    <div class="login-card p-4 text-center" onclick="login('student')">
                        <img src="https://cdn-icons-png.flaticon.com/512/2995/2995620.png" 
                             alt="Student" 
                             class="login-icon mb-3">
                        <h4 class="mb-0">Login Siswa</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="login-card p-4 text-center" 
                         onclick="window.location.href='{{ route('admin.login') }}'">
                        <img src="https://cdn-icons-png.flaticon.com/512/3048/3048122.png" 
                             alt="Admin" 
                             class="login-icon mb-3">
                        <h4 class="mb-0">Login Admin</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function login(type) {
            if (type === 'student') {
                window.location.href = '{{ route("student.login") }}';
            } else {
                window.location.href = '{{ route("admin.login") }}';
            }
        }
    </script>
</body>
</html>
