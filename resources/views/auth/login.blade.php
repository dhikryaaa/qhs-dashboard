<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QHSE Report') }} - Login</title>

    <!-- Google Fonts - Poppins & Public Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        /* UBS Brand Color Palette - CSS Variables */
        :root {
            --ubs-font-family: 'Poppins', sans-serif;
            --ubs-blue: #124477;
            --ubs-dark-blue: #264462;
            --ubs-dark-grey: #344054;
            --ubs-light-grey: #EAECF0;
            --ubs-orange: #F8961E;
            --ubs-green: #90BE6D;
            --ubs-red-orange: #F3722C;
            --ubs-yellow: #F9C74F;
            --ubs-red: #F94144;
            --ubs-bright-blue: #2090E0;
            --ubs-gold: #E3982F;
        }

        /* Global Font Family */
        * {
            font-family: var(--ubs-font-family);
        }

        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: var(--ubs-font-family);
        }

        /* Full Height Container */
        .login-container {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }

        /* Left Side - Background */
        .login-left {
            background-image: url('{{ asset('img/login-bg-smoke.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            flex: 1;
        }

        /* Right Side - Login Form Area */
        .login-right {
            background-color: var(--ubs-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            flex-shrink: 0;
            width: 38%;
        }

        /* Login Card */
        .login-card {
            background: var(--ubs-dark-blue);
            border-radius: 4rem;
            padding: 4rem 3.5rem;
            width: 100%;
            height: 100%;
            max-width: 1400px;
            max-height: 1700px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.2),
                0 0 60px rgba(255, 255, 255, 0.15),
                0 0 100px rgba(255, 255, 255, 0.08);
            position: relative;
            border-top: 6px solid rgba(255, 255, 255, 0.5);
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.3) 0%, 
                rgba(255, 255, 255, 0.1) 50%, 
                rgba(255, 255, 255, 0.05) 100%);
            border-radius: 3rem;
            z-index: -1;
            filter: blur(15px);
        }

        /* HSE Logo */
        .hse-logo {
            width: 650px;
            height: auto;
            padding-top: 85px;
            margin-bottom: 3rem;
        }

        /* Heading Text */
        .login-heading {
            color: #ffffff;
            font-size: 4.5rem;
            font-weight: 600;
            text-align: left;
            font-family: 'Public Sans', sans-serif;
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 3rem;
            font-family: 'Public Sans', sans-serif;
            font-weight: 400;
            margin-bottom: 3.5rem;
            text-align: left;
        }

        /* Form Labels */
        .login-label {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
            display: block;
        }

        /* Form Inputs */
        .login-input {
            background-color: var(--ubs-dark-grey);
            border: 6px solid rgba(255, 255, 255, 0.5);
            border-top-right-color: transparent;
            border-bottom-left-color: transparent;
            border-radius: 3rem;
            color: #ffffff;
            padding: 1.25rem 1.5rem;
            font-size: 6rem;
            width: 100%;
            margin-bottom: 3rem;
        }

        .login-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .login-input:focus {
            background-color: var(--ubs-dark-grey);
            border: 6px solid rgba(255, 255, 255, 0.5);
            border-top-right-color: transparent;
            border-bottom-left-color: transparent;
            color: #ffffff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        /* Password Input Group */
        .password-group {
            position: relative;
            margin-bottom: 3rem;
        }

        .password-toggle {
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            padding: 0;
            font-size: 1.5rem;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Login Button */
        .login-button {
            background: linear-gradient(135deg, #0B4A6F 0%, #2090E0 100%);
            border: 6px solid rgba(255, 255, 255, 0.5);
            border-top-right-color: transparent;
            border-bottom-left-color: transparent;
            border-radius: 3rem;
            color: #ffffff;
            font-size: 6rem;
            font-weight: 600;
            padding: 1.25rem 2rem;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(32, 144, 224, 0.3);
            margin-top: 0.25rem;
        }

        .login-button:hover {
            background: linear-gradient(135deg, #2090E0 0%, #0B4A6F 100%);
            box-shadow: 0 6px 20px rgba(32, 144, 224, 0.4);
            transform: translateY(-2px);
        }

        .login-button:active {
            transform: translateY(0);
        }

        /* Mobile Responsive */
        @media (max-width: 767px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-heading {
                font-size: 1.5rem;
            }

            .hse-logo {
                width: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Background Image -->
        <div class="login-left d-none d-md-block">
            <!-- Background image with gradient overlay applied via CSS -->
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
                <div class="login-card">
                    <!-- HSE Logo -->
                    <div class="text-center">
                        <img src="{{ asset('img/hse-logo-yellow.png') }}" alt="HSE Logo" class="hse-logo">
                    </div>

                    <!-- Heading -->
                    <h1 class="login-heading">Selamat datang.</h1>
                    <p class="login-subtitle">Silahkan isi NIK & Password anda</p>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="text-start">
                        @csrf

                        <!-- NIK Input -->
                        <div class="mb-3">
                            <label for="nik" class="login-label">NIK</label>
                            <input 
                                type="text" 
                                class="form-control login-input @error('nik') is-invalid @enderror" 
                                id="nik" 
                                name="nik" 
                                value="{{ old('nik') }}" 
                                placeholder="000001"
                                required 
                                autofocus
                            >
                            @error('nik')
                                <span class="invalid-feedback d-block text-white" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="login-label">Password</label>
                            <div class="password-group">
                                <input 
                                    type="password" 
                                    class="form-control login-input @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password" 
                                    placeholder="******"
                                    required
                                >
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block text-white" role="alert">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
</body>
</html>
