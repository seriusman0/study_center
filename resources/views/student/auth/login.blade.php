<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login | Study Center</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/styles.css') }}">
    <!-- Custom styles -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Source Sans Pro', sans-serif;
        }
        .login-box {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
            border-radius: 8px;
        }
        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .card-header a {
            color: #333;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }
        .card-body {
            padding: 0 20px;
        }
        .login-box-msg {
            margin-bottom: 20px;
            text-align: center;
            color: #666;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 10px;
            width: calc(100% - 40px);
        }
        .input-group-text {
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-left: none;
            padding: 10px;
        }
        .btn-primary {
            background-color: #3498DB;
            border-color: #3498DB;
            padding: 10px 0;
            width: 100%;
            border-radius: 4px;
            color: #fff;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #2980B9;
            border-color: #2980B9;
        }
        .text-decoration-none {
            text-decoration: none;
            color: #3498DB;
        }
        .text-decoration-none:hover {
            color: #2980B9;
        }
    </style>
</head>
<body>
<div class="login-box">
    <div class="card-header">
        <a href="/"><b>Study Center</b></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('student.login') }}" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" 
                       placeholder="NIP" value="{{ old('nip') }}" required autofocus>
                
            </div>
            @error('nip')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Password" required>
                
            </div>
            @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>

        <p class="mt-3 text-center">
            <a href="/" class="text-decoration-none">Back to Home</a>
        </p>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/user/js/scripts.js') }}"></script>
</body>
</html>