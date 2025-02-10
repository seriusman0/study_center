@extends('admin.layouts.auth')

@section('title', 'Admin Login')

@section('styles')
<style>
    .login-page {
        background: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-box {
        width: 360px;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        background: rgba(255, 255, 255, 0.9);
    }
    .login-title {
        font-weight: bold;
        color: #333;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .input-group-text {
        background-color: #4CAF50;
        border: none;
        color: white;
    }
    .form-control {
        border-radius: 20px;
    }
    .btn-primary {
        background-color: #4CAF50;
        border: none;
        border-radius: 20px;
        padding: 10px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
</style>
@endsection

@section('auth_header')
    <div class="text-center mb-4">
        <h2 class="login-title">LOGIN ADMIN SC</h2>
    </div>
@endsection

@section('auth_body')
    <form action="{{ route('admin.login') }}" method="post">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Email" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
        </div>
    </form>
@endsection