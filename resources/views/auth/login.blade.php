<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QHSE Report') }} - Login</title>

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- UBS Global Variables & Utilities -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">

    <!-- Custom Styles -->
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            display: flex;
        }

        /* Main Container - Full Screen */
        .login-main-container {
            width: 100%;
            height: 100%;
            background-color: #FFFFFF;
            display: flex;
            flex-direction: row;
            flex: 1;
        }

        /* Left Side - Image Area (62%) */
        .login-left {
            width: 62%;
            background: url('{{ asset('img/login-bg-smoke.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Right Side - Form Area (38%) */
        .login-right {
            width: 38%;
            background-color: var(--ubs-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Login Card - 381px x 465px */
        .login-card {
            width: 381px;
            height: 465px;
            background: rgba(68, 68, 68, 0.4);
            border-radius: 20px;
            padding: 40px 20px;
            box-shadow: 0px 0px 17px rgba(205, 243, 251, 0.29);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* HSE Logo */
        .hse-logo {
            height: 80px;
            width: auto;
            margin-bottom: 24px;
        }

        /* Welcome Text */
        .login-heading {
            color: #FFFFFF;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            width: 100%;
        }

        /* Subtitle */
        .login-subtitle {
            color: #E6E6E6;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 24px;
            width: 100%;
        }

        /* Form Container */
        .login-form {
            width: 100%;
        }

        /* Form Labels */
        .login-label {
            color: #F2F4F7;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        /* Form Inputs */
        .login-input {
            width: 100%;
            height: 46px;
            background: rgba(156, 156, 156, 0.47);
            border: none;
            border-radius: 10px;
            color: #E3E3E3;
            padding: 0 16px;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .login-input::placeholder {
            color: rgba(227, 227, 227, 0.5);
        }

        .login-input:focus {
            outline: none;
            background: rgba(156, 156, 156, 0.57);
            box-shadow: 0 0 0 2px rgba(242, 244, 247, 0.2);
        }

        /* Password Input Group */
        .password-group {
            position: relative;
            margin-bottom: 12px;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(227, 227, 227, 0.6);
            cursor: pointer;
            padding: 0;
            font-size: 16px;
        }

        .password-toggle:hover {
            color: rgba(227, 227, 227, 0.9);
        }

        /* Login Button */
        .login-button {
            width: 100%;
            height: 48px;
            background: linear-gradient(171.91deg, rgba(101, 167, 233, 0.264) 1.37%, rgba(50, 94, 140, 0.592) 44.22%);
            border: none;
            border-radius: 10px;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background: linear-gradient(171.91deg, rgba(101, 167, 233, 0.364) 1.37%, rgba(50, 94, 140, 0.692) 44.22%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(101, 167, 233, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        /* Error Messages */
        .invalid-feedback {
            color: #FFB4AB;
            font-size: 11px;
            margin-top: -12px;
            margin-bottom: 12px;
            display: block;
        }

        /* Mobile Responsive */
        @media (max-width: 1500px) {
            .login-main-container {
                width: 95vw;
                height: auto;
                min-height: 600px;
            }

            .login-left {
                width: 62%;
            }

            .login-right {
                width: 38%;
            }
        }

        @media (max-width: 991px) {
            .login-main-container {
                flex-direction: column;
                width: 90vw;
                height: auto;
            }

            .login-left {
                display: none;
            }

            .login-right {
                width: 100%;
                border-radius: 20px;
                min-height: 600px;
            }
        }
    </style>
</head>

<body>
    <div class="login-main-container">
        <!-- Left Side - Background Image with Gradient -->
        <div class="login-left"></div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-card">
                <!-- HSE Logo -->
                <img src="{{ asset('img/hse-logo-yellow.png') }}" alt="HSE Logo" class="hse-logo">

                <!-- Welcome Text -->
                <h1 class="login-heading">Selamat datang.</h1>
                <p class="login-subtitle">Silahkan isi NIK & Password anda</p>

                <!-- Login Form -->
                <form class="login-form"
                    onsubmit="event.preventDefault(); loginUser();">
                    @csrf

                    <!-- NIK Input -->
                    <div class="mb-0">
                        <label for="nik" class="login-label">NIK</label>
                        <input type="text" class="login-input @error('nik') is-invalid @enderror" id="nik"
                            name="nik" value="{{ old('nik') }}" placeholder="000001" required autofocus>
                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-0">
                        <label for="password" class="login-label">Password</label>
                        <div class="password-group">
                            <input type="password" class="login-input @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="******" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-button">
                        Log In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>

    <!-- Login Script -->
    <script>
        function loginUser() {
            const nik = document.getElementById('nik').value;
            const password = document.getElementById('password').value;

            if (!nik || !password) {
                alert('NIK dan Password harus diisi.');
                return;
            }

            window.location.href = '{{ route('home') }}';

            /* 
            fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        no_induk: nik,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.user) {
                        window.location.href = '{{ route('home') }}';
                    } else {
                        alert('Login gagal: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            */
        }
    </script>
</body>

</html>
