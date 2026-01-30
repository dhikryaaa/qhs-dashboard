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
    
    <!-- UBS Global Variables & Utilities -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">

    <!-- Custom Styles -->
    <style>

        /* Body with Background Image */
        body {
            padding-top: 124px; /* Combined height: 90px + 34px */
            font-family: var(--ubs-font-family);
            background-color: var(--ubs-background-grey);
            min-height: 100vh;
            margin: 0;
            padding-left: 0;
            padding-right: 0;
        }

        /* Top HRIS Header - Dark Blue */
        .hris-header {
            background-color: var(--ubs-blue);
            height: 90px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 80px;
        }

        .hris-header .logo-img {
            height: 42px;
            width: auto;
        }

        .hris-header .user-profile {
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            position: relative;
        }

        .hris-header .user-icon {
            font-size: 32px;
        }

        .hris-header .dropdown-arrow {
            height: 8px;
            width: auto;
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .hris-header .user-profile.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Profile Logout Popup */
        .popup-logout {
            display: none;
            flex-direction: column;
            align-items: flex-start;
            padding: 12px;
            gap: 12px;
            position: absolute;
            width: 167px;
            top: calc(100% + 12px);
            right: 0;
            background: #FFFFFF;
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.32);
            border-radius: 16px;
            z-index: 1040;
        }

        .popup-logout.show {
            display: flex;
        }

        /* User Info Frame */
        .popup-user-info {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 0px;
            gap: 8px;
            width: 143px;
            height: 40px;
        }

        /* Avatar */
        .popup-avatar {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 9999px;
            background: url('{{ asset('img/default-avatar.png') }}') center/cover;
            background-color: #E0E0E0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Public Sans', sans-serif;
            font-weight: 600;
            font-size: 16px;
            color: #7D7D7D;
        }

        /* User Details */
        .popup-user-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 0px;
            width: 95px;
            height: 40px;
            flex-grow: 1;
        }

        .popup-user-nik {
            width: 100%;
            font-family: 'Public Sans', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            line-height: 19px;
            color: #7D7D7D;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .popup-user-name {
            width: 100%;
            font-family: 'Public Sans', sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 16px;
            color: #344054;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Logout Button */
        .popup-logout-btn {
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 4px 14px;
            gap: 8px;
            width: 143px;
            height: 28px;
            background: #FFFFFF;
            border: 1px solid #D4D4D4;
            box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .popup-logout-btn:hover {
            background: #F9FAFB;
            border-color: #387192;
        }

        .popup-logout-btn span {
            font-family: 'Public Sans', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 12px;
            line-height: 20px;
            color: #387192;
        }

        /* Secondary Navbar Header */
        .navbar-header {
            background-color: var(--ubs-lighter-grey);
            height: 34px;
            position: fixed;
            top: 90px;
            left: 0;
            right: 0;
            z-index: 1029;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 2px 18px rgba(0, 0, 0, 0.4);
        }

        .navbar-header .nav-link {
            color: var(--ubs-dark-blue);
            font-weight: 600;
            font-size: 12px;
            padding: 8px 16px;
            width: 150px;
            text-align: center;
            transition: color 0.3s ease, background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .navbar-header .nav-link:hover,
        .navbar-header .nav-link:focus {
            color: var(--ubs-blue);
            background-color: rgba(18, 68, 119, 0.05);
        }
        
        .navbar-header span.nav-link {
            cursor: default;
        }

        .navbar-header .nav-link.active {
            color: var(--ubs-blue);
            font-weight: 700;
            border-bottom: 2px solid var(--ubs-blue);
        }

        /* Navigation Item with Submenu */
        .nav-item {
            position: relative;
            display: inline-block;
        }

        /* Submenu Container */
        .submenu-container {
            position: absolute;
            top: 100%;
            left: 0;
            background: #EAECF0;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 224px;
            padding: 8px 0;
            display: none;
            z-index: 1000;
            margin-top: 2px;
        }

        .nav-item:hover .submenu-container {
            display: block;
        }

        /* Submenu Items */
        .submenu-item {
            display: flex;
            flex-direction: row;
            align-items: center;
            background: #F2F4F7;
            padding: 8px 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 12px;
            color: #132D51;
            text-decoration: none;
            margin: 0 8px 2px 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .submenu-item:hover {
            background: #E5E7EB;
            color: #0B4A6F;
        }

        .submenu-item:last-child {
            margin-bottom: 0;
        }

        /* User dropdown styling */
        .user-profile-link {
            color: #ffffff !important;
            text-decoration: none;
        }

        .user-profile-link:hover {
            color: #e0e0e0 !important;
        }

        /* Main content wrapper */
        .main-content {
            padding: 24px;
            min-height: calc(100vh - 124px);
        }

        /* Mobile responsive adjustments */
        @media (max-width: 991px) {
            body {
                padding-top: 140px;
            }
            
            .hris-header {
                padding: 0 20px;
            }
            
            .navbar-header {
                height: auto;
                flex-wrap: wrap;
            }
            
            .navbar-header .nav-link {
                width: auto;
                font-size: 11px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Top HRIS Header (Dark Blue) -->
    <div class="hris-header">
        <!-- Logo -->
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/ubs-logo.png') }}" alt="UBS Logo" class="logo-img">
        </a>

        <!-- User Profile Dropdown -->
        <div style="position: relative;">
            <div class="user-profile" id="userProfileToggle">
                <i class="bi bi-person-circle user-icon"></i>
                <span>{{ auth()->user()->nama ?? 'John Doe' }}</span>
                <svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="dropdown-arrow">
                    <path d="M0 0L7.5 7.5L15 0H0Z" fill="white"/>
                </svg>
                
                <!-- Popup Logout -->
                <div class="popup-logout" id="popupLogout">
                    <!-- User Info -->
                    <div class="popup-user-info">
                        <!-- Avatar -->
                        <div class="popup-avatar">
                            {{ strtoupper(substr(auth()->user()->nama ?? 'J', 0, 1)) }}
                        </div>
                        
                        <!-- User Details -->
                        <div class="popup-user-details">
                            <div class="popup-user-nik">{{ auth()->user()->nik ?? '00001' }}</div>
                            <div class="popup-user-name">{{ auth()->user()->nama ?? 'Jane Doe' }}</div>
                        </div>
                    </div>
                    
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                        @csrf
                        <button type="submit" class="popup-logout-btn">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Navigation Header -->
    <div class="navbar-header">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">HOME</a>
        
        <!-- Dashboard -->
        <div class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">DASHBOARD</a>
        </div>
        
        <!-- Quality with Submenu -->
        <div class="nav-item">
            <span class="nav-link {{ request()->routeIs('quality*') ? 'active' : '' }}">QUALITY</span>
            <div class="submenu-container">
                <a href="#" class="submenu-item">Document Control (SOP, WI, Policy)</a>
                <a href="#" class="submenu-item">CPAR</a>
                <a href="{{ route('quality.audit-inspection') }}" class="submenu-item">Audit & Inspection</a>
                <a href="#" class="submenu-item">Supplier Quality</a>
            </div>
        </div>
        
        <!-- Health with Submenu -->
        <div class="nav-item">
            <span class="nav-link {{ request()->routeIs('health*') ? 'active' : '' }}">HEALTH</span>
            <div class="submenu-container">
                <a href="#" class="submenu-item">Medical Check-Up Records</a>
                <a href="#" class="submenu-item">First Aid & Clinic Report</a>
                <a href="#" class="submenu-item">Wellness Program</a>
            </div>
        </div>
        
        <!-- Safety with Submenu -->
        <div class="nav-item">
            <span class="nav-link {{ request()->routeIs('safety*') ? 'active' : '' }}">SAFETY</span>
            <div class="submenu-container">
                <a href="#" class="submenu-item">RHIM</a>
                <a href="#" class="submenu-item">ERT Structure</a>
                <a href="#" class="submenu-item">Incident – Accident Report</a>
            </div>
        </div>
        
        <!-- Compliance with Submenu -->
        <div class="nav-item">
            <span class="nav-link {{ request()->routeIs('compliance*') ? 'active' : '' }}">COMPLIANCE</span>
            <div class="submenu-container">
                <a href="#" class="submenu-item">ISO & Standard Compliance (9001/14001/45001)</a>
                <a href="#" class="submenu-item">License & Permit Management</a>
                <a href="#" class="submenu-item">Audit Plan (External / Internal)</a>
            </div>
        </div>
        
        <!-- Training with Submenu -->
        <div class="nav-item">
            <span class="nav-link {{ request()->routeIs('training*') ? 'active' : '' }}">TRAINING</span>
            <div class="submenu-container">
                <a href="#" class="submenu-item">Library (Dokumen, Video, Modul)</a>
                <a href="#" class="submenu-item">E-Learning</a>
                <a href="#" class="submenu-item">Sertifikasi Online</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Profile Popup Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userProfileToggle = document.getElementById('userProfileToggle');
            const popupLogout = document.getElementById('popupLogout');
            
            // Toggle popup on profile click
            userProfileToggle.addEventListener('click', function(e) {
                // Prevent click from immediately triggering document click
                e.stopPropagation();
                popupLogout.classList.toggle('show');
                userProfileToggle.classList.toggle('active');
            });
            
            // Close popup when clicking outside
            document.addEventListener('click', function(e) {
                if (!userProfileToggle.contains(e.target)) {
                    popupLogout.classList.remove('show');
                    userProfileToggle.classList.remove('active');
                }
            });
            
            // Prevent popup from closing when clicking inside it
            popupLogout.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
