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
    <style>
        :root {
            --ubs-font-family: 'Poppins', sans-serif;
            --ubs-blue: #124477;
            --ubs-dark-grey: #344054;
            --ubs-light-grey: #EAECF0;
            --ubs-gold: #E3982F;
        }
        
        * { box-sizing: border-box; }
        
        body { 
            font-family: var(--ubs-font-family); 
            display: flex; 
            min-height: 100vh; 
            background-color: #F9FAFB; 
            padding: 0; 
            margin: 0; 
        }
        
        a { text-decoration: none; }

        /* ========== GIANT SIDEBAR (550px Fixed, Left Side) ========== */
        .sidebar {
            width: 950px;
            background-color: #ffffff;
            border-right: 3px solid var(--ubs-light-grey);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
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
            padding: 50px;
            display: flex;
            min-height: 230px;
        }
        
        .sidebar-logo img { 
            height: 230px; 
            width: auto; 
        }
        
        /* Sidebar Section Labels */
        .sidebar-label {
            padding: 40px 50px 15px 50px;
            font-size: 2.5rem;
            color: #98A2B3;
            font-weight: 100;
            text-transform: uppercase;
            font-family: 'Public Sans', sans-serif;
        }
        
        /* Sidebar Links - Giant Scale */
        .sidebar-link {
            padding: 35px 50px;
            display: flex;
            align-items: center;
            color: var(--ubs-dark-grey);
            font-weight: 500;
            font-size: 3.5rem;
            border-left: 12px solid transparent;
            transition: all 0.2s ease;
            font-family: 'Public Sans', sans-serif;
        }
        
        .sidebar-link:hover,
        .sidebar-link.active { 
            background-color: #F9FAFB; 
            color: var(--ubs-blue); 
        }
        
        .sidebar-link.active { 
            border-left-color: var(--ubs-blue); 
        }
        
        /* SVG Icons - Force 70px */
        .sidebar-link svg { 
            width: 70px; 
            height: 70px; 
            margin-right: 40px; 
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
            font-size: 2.5rem; 
            margin-left: auto; 
            transition: transform 0.3s; 
        }
        
        .sidebar-link[aria-expanded="true"] .bi-chevron-down { 
            transform: rotate(180deg); 
        }
        
        /* Submenu Links */
        .submenu-link {
            padding-left: 60px;
            padding-top: 30px;
            padding-bottom: 70px;
            display: flex;
            align-items: center;
            color: var(--ubs-dark-grey);
            font-size: 3.5rem;
            transition: all 0.2s ease;
            font-family: 'Public Sans', sans-serif;
        }
        
        .submenu-link:hover { 
            color: var(--ubs-blue); 
            background-color: #F9FAFB; 
        }
        
        .submenu-link i { 
            font-size: 3.5rem; 
            margin-right:50px; 
        }

        /* ========== MAIN CONTENT WRAPPER (Grey Background) ========== */
        .main-wrapper {
            margin-left: 550px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: #F9FAFB;
            padding: 60px;
            min-height: 100vh;
        }

        /* ========== FLOATING HEADER CARD ========== */
        .floating-header-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 60px rgba(0, 0, 0, 0.12);
            padding: 60px 60px;
            margin-bottom: 60px;
            margin-left: auto;
            width: 4000px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 60px;
        }

        /* Home Icon - Clean, No Box */
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
            width: 100px; 
            height: 100px; 
        }

        /* User Profile Section */
        .header-right {
            display: flex;
            align-items: center;
            gap: 60px;
        }
        
        .user-profile { 
            display: flex; 
            align-items: center; 
            gap: 30px; 
            cursor: pointer; 
        }
        
        .user-avatar { 
            width: 100px; 
            height: 100px; 
            border-radius: 50%; 
            object-fit: cover;
            border: 2px solid var(--ubs-light-grey);
        }
        
        .user-name { 
            font-size: 3.5rem; 
            font-weight: 600; 
            color: var(--ubs-dark-grey); 
        }

        /* Dropdown Menu - Giant Scale */
        .dropdown-menu { 
            font-size: 3rem; 
            padding: 20px 0; 
            min-width: 400px; 
        }
        
        .dropdown-item { 
            padding: 20px 50px; 
        }
        
        .dropdown-item:hover {
            background-color: #F9FAFB;
            color: var(--ubs-blue);
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
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 17.6667V9.33333H11V17.6667M1 6.83333L8.5 1L16 6.83333V16C16 16.442 15.8244 16.866 15.5118 17.1785C15.1993 17.4911 14.7754 17.6667 14.3333 17.6667H2.66667C2.22464 17.6667 1.80072 17.4911 1.48816 17.1785C1.17559 16.866 1 16.442 1 16V6.83333Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Dashboard</span>
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
                <a href="#" class="submenu-link"><i class="bi bi-circle"></i><span>Role</span></a>
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
            <a href="{{ route('home') }}" class="header-home-link">
                <svg viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.9964 26.0917V17.7583H18.6631V26.0917C18.6631 27.0083 19.4131 27.7583 20.3298 27.7583H25.3298C26.2464 27.7583 26.9964 27.0083 26.9964 26.0917V14.425H29.8298C30.5964 14.425 30.9631 13.475 30.3798 12.975L16.4464 0.425C15.8131 -0.141667 14.8464 -0.141667 14.2131 0.425L0.279753 12.975C-0.286913 13.475 0.0630865 14.425 0.829753 14.425H3.66309V26.0917C3.66309 27.0083 4.41309 27.7583 5.32975 27.7583H10.3298C11.2464 27.7583 11.9964 27.0083 11.9964 26.0917Z" fill="#0B4A6F"/>
                </svg>
            </a>
            
            <div class="dropdown">
                <div class="user-profile" data-bs-toggle="dropdown">
                    <img src="{{ asset('img/user-avatar-default.jpg') }}" class="user-avatar" alt="User">
                    <span class="user-name">{{ auth()->user()->name ?? 'John Doe' }}</span>
                    <i class="bi bi-chevron-down" style="font-size: 2rem;"></i>
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

        <!-- MAIN PAGE CONTENT -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
