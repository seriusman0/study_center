<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Proof Search Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Payment Proof Files for {{ $user->nama }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>NIP:</strong> {{ $user->nip }}
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        <th>File Type</th>
                                        <th>Notes</th>
                                        <th>Upload Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paymentProofs as $proof)
                                    <tr>
                                        <td>{{ $proof->formatted_period }}</td>
                                        <td>
                                            <i class="{{ $proof->file_icon }}"></i>
                                            {{ strtoupper($proof->file_type) }}
                                        </td>
                                        <td>{{ $proof->notes ?: '-' }}</td>
                                        <td>{{ $proof->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            <a href="{{ $proof->file_url }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            <a href="/" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>