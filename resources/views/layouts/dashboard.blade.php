<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'QHSE Report') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- UBS Global Variables & Utilities -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    
    <style>
        /* ========== FLUID REM ARCHITECTURE ========== */
        /* Master Scale: 1rem = 16px at 1280px viewport */
        html {
            font-size: 1.25vw; /* 16px / 1280px = 1.25% */
        }
        
        body {
            font-family: 'Public Sans', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #F9FAFB;
            padding: 0;
            margin: 0;
            overflow: hidden;
            font-size: 1rem;
        }
        
        a { 
            text-decoration: none; 
        }

        /* ========== SIDEBAR (16.25rem Fluid Width) ========== */
        .sidebar {
            width: 16.25rem; /* 260px ÷ 16 */
            background-color: #ffffff;
            border-right: 0.0625rem solid var(--ubs-light-grey); /* 1px ÷ 16 */
            box-shadow: 0.125rem 0 0.5rem rgba(0, 0, 0, 0.05); /* 2px 0 8px */
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar-logo {
            padding: 1.25rem; /* 20px ÷ 16 */
            display: flex;
            min-height: 6.25rem; /* 100px ÷ 16 */
        }
        
        .sidebar-logo img { 
            height: 3.75rem; /* 60px ÷ 16 */
            width: auto; 
        }
        
        /* Sidebar Section Labels */
        .sidebar-label {
            padding: 1rem 1.25rem 0.5rem 1.25rem; /* 16px 20px 8px 20px */
            font-size: 0.6875rem; /* 11px ÷ 16 */
            color: #98A2B3;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03125rem; /* 0.5px ÷ 16 */
            font-family: 'Public Sans', sans-serif;
        }
        
        /* Sidebar Links - Fluid REM Scale */
        .sidebar-link {
            padding: 0.75rem 1.25rem; /* 12px 20px */
            display: flex;
            align-items: center;
            color: var(--ubs-dark-grey);
            font-weight: 500;
            font-size: 1rem; /* 16px ÷ 16 */
            border-left: 0.1875rem solid transparent; /* 3px ÷ 16 */
            transition: all 0.2s ease;
            font-family: 'Public Sans', sans-serif;
            text-decoration: none;
        }
        
        .sidebar-link:hover,
        .sidebar-link.active { 
            background-color: #F9FAFB; 
            color: var(--ubs-blue); 
        }
        
        .sidebar-link.active { 
            border-left-color: var(--ubs-blue); 
        }
        
        /* SVG Icons - Fluid 1.25rem */
        .sidebar-link svg { 
            width: 1.25rem; /* 20px ÷ 16 */
            height: 1.25rem; 
            margin-right: 0.75rem; /* 12px ÷ 16 */
            flex-shrink: 0; 
        }
        
        .sidebar-link.active svg path { 
            stroke: var(--ubs-blue); 
        }
        
        .sidebar-link.active svg path[fill="black"] { 
            fill: var(--ubs-blue); 
        }
        
        /* Chevron for Collapse */
        .sidebar-link .bi-chevron-down { 
            font-size: 0.75rem; /* 12px ÷ 16 */
            margin-left: auto; 
            transition: transform 0.3s; 
        }
        
        .sidebar-link[aria-expanded="true"] .bi-chevron-down { 
            transform: rotate(180deg); 
        }
        
        /* Submenu Links */
        .submenu-link {
            padding: 0.625rem 1.25rem 0.625rem 1.5625rem; /* 10px 20px 10px 25px */
            display: flex;
            align-items: center;
            color: var(--ubs-dark-grey);
            font-size: 0.875rem; /* 14px ÷ 16 */
            transition: all 0.2s ease;
            font-family: 'Public Sans', sans-serif;
            text-decoration: none;
        }
        
        .submenu-link:hover { 
            color: var(--ubs-blue); 
            background-color: #F9FAFB; 
        }
        
        .submenu-link i { 
            font-size: 0.9375rem; /* 15px ÷ 16 */
            margin-right: 0.75rem; /* 12px ÷ 16 */
        }

        /* ========== MAIN CONTENT WRAPPER ========== */
        .main-wrapper {
            margin-left: 16.25rem; /* 260px ÷ 16 */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: #F9FAFB;
            padding: 1.25rem; /* 20px ÷ 16 */
            height: 100vh;
            overflow-y: auto;
        }

        /* ========== FLOATING HEADER CARD ========== */
        .floating-header-card {
            background-color: #ffffff;
            border-radius: 0.5rem; /* 8px ÷ 16 */
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05); /* 0 4px 12px */
            padding: 1.25rem 1.5rem; /* 20px 24px */
            margin-bottom: 1.25rem; /* 20px ÷ 16 */
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1.25rem; /* 20px ÷ 16 */
            height: 4.375rem; /* 70px ÷ 16 */
        }

        /* Home Icon */
        .header-home-link {
            display: flex;
            align-items: center;
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }
        
        .header-home-link:hover { 
            opacity: 1; 
        }
        
        .header-home-link svg { 
            width: 1.5rem; /* 24px ÷ 16 */
            height: 1.5rem;
        }

        /* User Profile Section */
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem; /* 16px ÷ 16 */
        }
        
        .user-profile { 
            display: flex; 
            align-items: center; 
            gap: 0.75rem; /* 12px ÷ 16 */
            cursor: pointer; 
        }
        
        .user-avatar { 
            width: 2rem; /* 32px ÷ 16 */
            height: 2rem; 
            border-radius: 50%; 
            object-fit: cover;
            border: 0.0625rem solid var(--ubs-light-grey); /* 1px ÷ 16 */
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name { 
            font-size: 0.875rem; /* 14px ÷ 16 */
            font-weight: 600; 
            color: var(--ubs-dark-blue); 
        }
        
        .user-role { 
            font-size: 0.75rem; /* 12px ÷ 16 */
            color: #667085; 
        }

        /* ========== CONTENT AREA (White Cards) ========== */
        .content-area {
            flex: 1;
            background-color: #F9FAFB;
        }

        /* ========== RESPONSIVE BREAKPOINTS ========== */
        @media (max-width: 61.9375rem) { /* 991px ÷ 16 */
            html { 
                font-size: 2vw; /* Larger base for smaller viewports */
            }
            
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active { 
                transform: translateX(0); 
            }
            
            .main-wrapper { 
                margin-left: 0; 
            }
        }
        
        @media (min-width: 93.75rem) { /* 1500px ÷ 16 */
            html { 
                font-size: 1.2vw; /* Slightly smaller scale for ultra-wide */
            }
        }

        /* ========== DROPDOWN MENU ========== */
        .dropdown-menu { 
            font-size: 0.875rem; /* 14px ÷ 16 */
            border-radius: 0.5rem; /* 8px ÷ 16 */
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1); /* 0 4px 12px */
            border: 0.0625rem solid var(--ubs-light-grey); /* 1px ÷ 16 */
            padding: 0.5rem; /* 8px ÷ 16 */
        }
        
        .dropdown-item { 
            padding: 0.5rem 0.75rem; /* 8px 12px */
            border-radius: 0.375rem; /* 6px ÷ 16 */
            transition: all 0.2s ease; 
        }
        
        .dropdown-item:hover { 
            background-color: #F9FAFB; 
            color: var(--ubs-blue); 
        }
        
        .dropdown-item i { 
            margin-right: 0.625rem; /* 10px ÷ 16 */
            font-size: 0.875rem; /* 14px ÷ 16 */
        }

        /* ========== MAIN PAGE CONTENT AREA ========== */
        .main-content {
            flex-grow: 1;
            /* Content goes here - transparent background shows grey wrapper */
        }
    </style>
</head>
<body>
    <!-- GIANT SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('img/hse-logo-sidebar.png') }}" alt="HSE Logo">
        </div>
        
        <div class="sidebar-menu">
            <!-- Dashboard Link -->
            <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <svg viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 17.6667V9.33333H11V17.6667M1 6.83333L8.5 1L16 6.83333V16C16 16.442 15.8244 16.866 15.5118 17.1785C15.1993 17.4911 14.7754 17.6667 14.3333 17.6667H2.66667C2.22464 17.6667 1.80072 17.4911 1.48816 17.1785C1.17559 16.866 1 16.442 1 16V6.83333Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Home</span>
            </a>
            
            <!-- Master Section -->
            <div class="sidebar-label">MASTER PAGES</div>
            <a href="#masterMenu" class="sidebar-link" data-bs-toggle="collapse" aria-expanded="false">
                <svg viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.66666 0.833252H0.833328V6.66659H6.66666V0.833252Z" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.8333 0.833252H9.99999V6.66659H15.8333V0.833252Z" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.8333 9.99992H9.99999V15.8333H15.8333V9.99992Z" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.66666 9.99992H0.833328V15.8333H6.66666V9.99992Z" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Master</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="masterMenu">
                <a href="{{ route('master.role') }}" class="submenu-link {{ request()->routeIs('master.role') ? 'active' : '' }}"><i class="bi bi-circle"></i><span>Role</span></a>
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>User</span></a>
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Inspector</span></a>
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Departemen</span></a>
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Lokasi</span></a>
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Kategori</span></a>
            </div>
            
            <!-- Transaction Section -->
            <div class="sidebar-label">TRANSACTION PAGES</div>
            <a href="#transactionMenu" class="sidebar-link" data-bs-toggle="collapse" aria-expanded="false">
                <svg viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.5 2.76778H2.66667C2.22464 2.76778 1.80072 2.94338 1.48816 3.25594C1.17559 3.5685 1 3.99242 1 4.43445V16.1011C1 16.5431 1.17559 16.9671 1.48816 17.2796C1.80072 17.5922 2.22464 17.7678 2.66667 17.7678H14.3333C14.7754 17.7678 15.1993 17.5922 15.5118 17.2796C15.8244 16.9671 16 16.5431 16 16.1011V10.2678M14.75 1.51777C15.0815 1.18625 15.5312 1 16 1C16.4688 1 16.9185 1.18625 17.25 1.51777C17.5815 1.84929 17.7678 2.29893 17.7678 2.76777C17.7678 3.23661 17.5815 3.68625 17.25 4.01777L9.33333 11.9344L6 12.7678L6.83333 9.43443L14.75 1.51777Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Transaction</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="transactionMenu">
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Inspeksi</span></a>
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Perbaikan</span></a>
            </div>
            
            <!-- Report Section -->
            <div class="sidebar-label">REPORT PAGES</div>
            <a href="#reportMenu" class="sidebar-link" data-bs-toggle="collapse" aria-expanded="false">
                <svg viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.66699 0.5H6.45996L7.97949 2.02051L8.12598 2.16699H15C15.6404 2.16699 16.1668 2.69263 16.167 3.33301V11.667C16.1668 12.3074 15.6404 12.833 15 12.833H1.66699C1.02658 12.833 0.500179 12.3074 0.5 11.667L0.508789 1.66699L0.514648 1.54785C0.574069 0.959773 1.06944 0.5 1.66699 0.5ZM1.16699 12.167H15.5V2.83301H1.16699V12.167Z" fill="black" stroke="#344054"/>
                </svg>
                <span>Report</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="reportMenu">
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Hasil Inspeksi</span></a>
            </div>
        </div>
    </div>

    <!-- MAIN WRAPPER (Grey Background) -->
    <div class="main-wrapper">
        <!-- FLOATING HEADER CARD -->
        <div class="floating-header-card">
            @yield('page-title')
            
            <div class="header-right">
                <a href="{{ route('home') }}" class="header-home-link">
                    <svg viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.9964 26.0917V17.7583H18.6631V26.0917C18.6631 27.0083 19.4131 27.7583 20.3298 27.7583H25.3298C26.2464 27.7583 26.9964 27.0083 26.9964 26.0917V14.425H29.8298C30.5964 14.425 30.9631 13.475 30.3798 12.975L16.4464 0.425C15.8131 -0.141667 14.8464 -0.141667 14.2131 0.425L0.279753 12.975C-0.286913 13.475 0.0630865 14.425 0.829753 14.425H3.66309V26.0917C3.66309 27.0083 4.41309 27.7583 5.32975 27.7583H10.3298C11.2464 27.7583 11.9964 27.0083 11.9964 26.0917Z" fill="#0B4A6F"/>
                    </svg>
                </a>
                
                <div class="dropdown">
                    <div class="user-profile" data-bs-toggle="dropdown">
                        <img src="{{ asset('img/user-avatar-default.jpg') }}" class="user-avatar" alt="User">
                        <span class="user-name">{{ auth()->user()->nama ?? 'John Doe' }}</span>
                        <i class="bi bi-chevron-down" style="font-size: 14px;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- MAIN PAGE CONTENT -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
