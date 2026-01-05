<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QHSE Report') }} - @yield('title', 'Dashboard')</title>

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        /* Utility Classes for Brand Colors */
        .bg-ubs-blue { background-color: var(--ubs-blue) !important; }
        .bg-ubs-dark-grey { background-color: var(--ubs-dark-grey) !important; }
        .bg-ubs-light-grey { background-color: var(--ubs-light-grey) !important; }
        .bg-ubs-orange { background-color: var(--ubs-orange) !important; }
        .bg-ubs-green { background-color: var(--ubs-green) !important; }
        .bg-ubs-red-orange { background-color: var(--ubs-red-orange) !important; }
        .bg-ubs-yellow { background-color: var(--ubs-yellow) !important; }
        .bg-ubs-red { background-color: var(--ubs-red) !important; }
        .bg-ubs-bright-blue { background-color: var(--ubs-bright-blue) !important; }
        .bg-ubs-gold { background-color: var(--ubs-gold) !important; }

        .text-ubs-blue { color: var(--ubs-blue) !important; }
        .text-ubs-dark { color: var(--ubs-dark-grey) !important; }
        .text-ubs-light-grey { color: var(--ubs-light-grey) !important; }
        .text-ubs-orange { color: var(--ubs-orange) !important; }
        .text-ubs-green { color: var(--ubs-green) !important; }
        .text-ubs-red-orange { color: var(--ubs-red-orange) !important; }
        .text-ubs-yellow { color: var(--ubs-yellow) !important; }
        .text-ubs-red { color: var(--ubs-red) !important; }
        .text-ubs-bright-blue { color: var(--ubs-bright-blue) !important; }
        .text-ubs-gold { color: var(--ubs-gold) !important; }

        .border-ubs-blue { border-color: var(--ubs-blue) !important; }
        .border-ubs-light-grey { border-color: var(--ubs-light-grey) !important; }

        /* Global Font Family */
        * {
            font-family: var(--ubs-font-family);
        }

        /* Two-tiered navbar system */
        body {
            padding-top: 170px; /* Combined height of both navbars */
            font-family: var(--ubs-font-family);
        }

        /* Top Dark Blue Navbar */
        .navbar-top {
            background-color: var(--ubs-blue) !important;
            height: 350px;
            z-index: 1030;
        }

        .navbar-top .logo-img {
            height: 200px;
            width: auto;
            margin-left: 19rem;
            margin-bottom: 2rem;
        }

        .navbar-top .user-profile {
            color: #ffffff;
            font-weight: 600;
            font-size: 4rem;
        }

        .navbar-top .user-icon {
            font-size: 10rem;
            margin-right: 3rem;
        }

        .navbar-top .dropdown-arrow {
            height: 2rem;
            width: auto;
            margin-left: 3rem;
            margin-right: 24rem;
        }

        /* Dropdown menu styling */
        .navbar-top .dropdown-menu {
            font-size: 2.5rem;
            min-width: 25rem;
            padding: 1rem 0;
        }

        .navbar-top .dropdown-item {
            padding: 1.5rem 2.5rem;
            font-size: 2.5rem;
        }

        .navbar-top .dropdown-item i {
            font-size: 2.5rem;
            margin-right: 1.5rem;
        }

        .navbar-top .dropdown-divider {
            margin: 1rem 0;
        }

        /* White Navigation Bar */
        .navbar-secondary {
            background-color: #ffffff !important;
            border-bottom: 2px solid var(--ubs-light-grey);
            height: 150px;
            top: 350px; /* Position below the top navbar */
            z-index: 1029;
        }

        .navbar-secondary .nav-link {
            color: var(--ubs-dark-grey) !important;
            font-weight: 600;
            font-size: 3.5rem;
            padding: 0.75rem 1rem;
            width: 35rem;
            text-align: center;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .navbar-secondary .nav-link:hover,
        .navbar-secondary .nav-link:focus {
            color: var(--ubs-blue) !important;
            background-color: rgba(11, 74, 111, 0.05);
        }

        .navbar-secondary .nav-link.active {
            color: var(--ubs-blue) !important;
            font-weight: 600;
            border-bottom: 3px solid var(--ubs-blue);
        }

        /* User dropdown styling */
        .user-profile-link {
            color: #ffffff !important;
            text-decoration: none;
        }

        .user-profile-link:hover {
            color: #e0e0e0 !important;
        }

        /* Mobile responsive adjustments */
        @media (max-width: 991px) {
            body {
                padding-top: 200px; /* More space for collapsed navbars on mobile */
            }
            
            .navbar-secondary {
                top: 80px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Top Dark Blue Navbar (Primary Header Bar) -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-top fixed-top">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/ubs-logo.png') }}" alt="UBS Logo" class="logo-img">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavContent" aria-controls="topNavContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Right Side - User Profile -->
            <div class="collapse navbar-collapse" id="topNavContent">
                <div class="ms-auto">
                    <div class="dropdown">
                        <a class="d-flex align-items-center user-profile-link" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                            <i class="bi bi-person-circle user-icon"></i>
                            <span class="user-profile">John Doe</span>
                            <svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="dropdown-arrow">
                                <path d="M0 0L7.5 7.5L15 0H0Z" fill="white"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- White Navigation Bar (Secondary Nav Links Bar) -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-secondary fixed-top">
        <div class="container-fluid">
            <!-- Mobile Toggle for Secondary Nav -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#secondaryNavContent" aria-controls="secondaryNavContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main Navigation Links -->
            <div class="collapse navbar-collapse" id="secondaryNavContent">
                <ul class="navbar-nav mx-auto mb-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('quality') ? 'active' : '' }}" href="{{ route('quality') }}">Quality</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('health') ? 'active' : '' }}" href="{{ route('health') }}">Health</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('safety') ? 'active' : '' }}" href="{{ route('safety') }}">Safety</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('compliance') ? 'active' : '' }}" href="{{ route('compliance') }}">Compliance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('training') ? 'active' : '' }}" href="{{ route('training') }}">Training</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    @stack('scripts')
</body>
</html>
