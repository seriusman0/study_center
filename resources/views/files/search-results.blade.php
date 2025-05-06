<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Proof Files - {{ $user->nama }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .file-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .back-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Payment Proof Files</h2>
                        <div class="user-info mb-4">
                            <h5>User Details:</h5>
                            <p class="mb-1"><strong>Name:</strong> {{ $user->nama }}</p>
                            <p class="mb-1"><strong>NIP:</strong> {{ $user->nip }}</p>
                        </div>
                        
                        <div class="files-list">
                            @foreach($paymentProofs as $proof)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="{{ $proof->file_icon }} file-icon text-primary"></i>
                                            </div>
                                            <div class="col">
                                                <h5 class="card-title mb-1">Payment Proof - {{ $proof->formatted_period }}</h5>
                                                @if($proof->notes)
                                                    <p class="card-text text-muted small mb-2">{{ $proof->notes }}</p>
                                                @endif
                                            </div>
                                            <div class="col-auto">
                                                <a href="{{ $proof->file_url }}" 
                                                   class="btn btn-primary btn-sm"
                                                   target="_blank">
                                                    <i class="fas fa-eye me-1"></i> View File
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ url('/') }}" class="btn btn-secondary back-btn">
        <i class="fas fa-arrow-left me-1"></i> Back to Home
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
