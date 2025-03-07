<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>404 - Halaman Tidak Ditemukan | Study Center</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/studycenter.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/public/logo/sc-logo.jpg') }}">
</head>
<body class="error-page">
    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/public/logo/sc-logo.jpg') }}" alt="Study Center" class="logo">
                </a>
            </div>
        </nav>
    </header>

    <!-- Konten -->
    <main class="container mt-5 text-center">
        <div class="error-content">
            <h1 class="display-1 text-primary mb-4"><i class="fa fa-exclamation-triangle"></i> 404</h1>
            <h2 class="h1 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="lead mb-5">Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
            
            
            <div class="error-actions">
                <a href="{{ url('/') }}" class="btn btn-primary btn-lg mr-3 mb-3">
                    <i class="fa fa-home"></i> Kembali ke Beranda
                </a>
                <a href="javascript:window.history.back()" class="btn btn-secondary btn-lg mb-3">
                    <i class="fa fa-arrow-left"></i> Kembali ke Sebelumnya
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">&copy; {{ date('Y') }} Study Center. All rights reserved.</span>
        </div>
    </footer>

    <!-- Script -->
    <script src="{{ asset('assets/admin/dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>