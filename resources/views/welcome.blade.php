<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Study Center!</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            font-family: 'Nunito', sans-serif;
            background: #e0f2e9;
        }
        .welcome-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        .background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .shape {
            position: absolute;
            opacity: 0.5;
        }
        .circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #FFA500;
            top: 10%;
            left: 10%;
            animation: float 6s ease-in-out infinite;
        }
        .square {
            width: 80px;
            height: 80px;
            background-color: #4CAF50;
            bottom: 15%;
            right: 10%;
            animation: rotate 10s linear infinite;
        }
        .triangle {
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 86px solid #FF6347;
            top: 50%;
            left: 15%;
            animation: bounce 4s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        h1 {
            font-size: 3.5rem;
            color: #4CAF50;
            margin-bottom: 1rem;
            font-family: 'Baloo 2', cursive;
            text-shadow: 3px 3px 0px #FFA500;
            animation: wiggle 2s ease-in-out infinite;
        }
        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }
        .login-options {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }
        .login-option {
            width: 180px;
            height: 220px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #ffffff;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 4px solid #FFA500;
        }
        .login-option:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        .login-option img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .login-option:hover img {
            transform: scale(1.1) rotate(10deg);
        }
        .login-option span {
            font-size: 1.2rem;
            color: #4CAF50;
            font-weight: bold;
        }
        #lottie-animation {
            width: 300px;
            height: 300px;
            margin-bottom: 20px;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }
        .btn-primary {
            background-color: #FFA500;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #e59400;
        }
        .alert {
            padding: 10px;
            margin-top: 15px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="background-shapes">
            <div class="shape circle"></div>
            <div class="shape square"></div>
            <div class="shape triangle"></div>
        </div>

        <div class="container mt-5">
            {{-- Form untuk pencarian berdasarkan NIM --}}
            <div class="form-container">
                <form action="{{ route('files.search') }}" method="GET" class="mb-4">
                    <div class="form-group">
                        <label for="nip">NIP:</label>
                        <input type="number" class="form-control" id="nip" name="nip" required>
                    </div>
                    <button type="submit" class="btn-primary">Search</button>
                </form>
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
        </div>
        <h1>Selamat Datang di Study Center!</h1>
        <div id="lottie-animation"></div>
        <div class="login-options">
            <div class="login-option" onclick="login('student')">
                <img src="https://cdn-icons-png.flaticon.com/512/2995/2995620.png" alt="Student">
                <span>Masuk Siswa</span>
            </div>
            <div class="login-option" onclick="window.location.href='{{ route('admin.login') }}'">
                <img src="https://cdn-icons-png.flaticon.com/512/3048/3048122.png" alt="Admin">
                <span>Masuk Admin</span>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: 'https://assets2.lottiefiles.com/packages/lf20_tll0j4bb.json' // Kids learning animation
            });
        });

        function login(type) {
            if (type === 'student') {
                alert('Yay! Ayo mulai belajar!');
                // Redirect ke halaman login siswa
            } else {
                alert('Selamat datang, Guru hebat!');
                // Redirect ke halaman login admin
            }
        }
    </script>
</body>
</html>