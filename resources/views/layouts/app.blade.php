<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Page title - each page sets its own title --}}
    <title>SRS LabAuto — @yield('title', 'Lab Automation System')</title>

    {{-- Tabler Icons CDN - for all icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>

        /* ==========================================
           GLOBAL RESET
           Applied to all elements
        ========================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            color: #2C2C2A;
            background: #ffffff;
        }

        /* ==========================================
           LOGO BAR
           Shows on every page at top
           Purple gradient background
        ========================================== */
        .logo-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 32px;
            background: linear-gradient(90deg, #26215C 0%, #534AB7 100%);
        }

        /* Logo left side wrapper */
        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* White box behind logo image */
        .logo-icon {
            width: 46px;
            height: 46px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* ==========================================
           IMAGE 1 - LOGO
           File: public/images/logo.png
           Size: 40x40px recommended
           Shows: Top left on every page
        ========================================== */
        .logo-icon img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        /* Company name next to logo */
        .logo-text h2 {
            font-size: 18px;
            font-weight: 700;
            color: white;
            letter-spacing: 0.3px;
        }

        .logo-text p {
            font-size: 11px;
            color: #CECBF6;
            margin-top: 1px;
        }

        /* ==========================================
           NAVBAR LINKS
           Right side of logo bar
        ========================================== */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links a {
            font-size: 13px;
            color: #CECBF6;
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: white;
        }

        /* Login button style in navbar */
        .btn-nav-login {
            padding: 8px 18px;
            background: white;
            color: #534AB7 !important;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-nav-login:hover {
            background: #EEEDFE !important;
        }

        /* ==========================================
           GLOBAL BUTTONS
           Used on all pages
        ========================================== */

        /* Purple filled button */
        .btn-primary {
            padding: 11px 24px;
            background: #534AB7;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #3C3489;
        }

        /* White outline button */
        .btn-secondary {
            padding: 11px 24px;
            background: white;
            color: #534AB7;
            border: 1.5px solid #534AB7;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-secondary:hover {
            background: #EEEDFE;
        }

        /* ==========================================
           SIDEBAR LAYOUT
           Used in dashboard and inner pages
        ========================================== */
        .sidebar-layout {
            display: flex;
            min-height: calc(100vh - 74px);
        }

        /* Left sidebar - dark purple */
        .sidebar {
            width: 220px;
            flex-shrink: 0;
            background: #26215C;
            padding: 20px 0;
        }

        /* Sidebar section label */
        .sidebar-label {
            font-size: 10px;
            color: #7F77DD;
            padding: 14px 24px 5px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
        }

        /* Single sidebar menu item */
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 24px;
            font-size: 13px;
            color: #CECBF6;
            text-decoration: none;
            transition: background 0.2s;
            border-left: 3px solid transparent;
        }

        /* Hover and active state */
        .sidebar-item:hover,
        .sidebar-item.active {
            background: #3C3489;
            color: white;
            border-left-color: #AFA9EC;
        }

        .sidebar-item i {
            font-size: 17px;
        }

        /* Main content area right of sidebar */
        .main-content {
            flex: 1;
            padding: 28px;
            background: #F8F8F6;
            overflow-x: hidden;
        }

        /* Page heading style */
        .page-heading {
            font-size: 20px;
            font-weight: 700;
            color: #26215C;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ==========================================
           BADGE STYLES
           Used for Pass / Fail / Pending labels
        ========================================== */
        .badge {
            display: inline-block;
            padding: 3px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Green - test passed */
        .badge-pass    { background: #EAF3DE; color: #27500A; }

        /* Red - test failed */
        .badge-fail    { background: #FCEBEB; color: #791F1F; }

        /* Orange - test pending */
        .badge-pending { background: #FAEEDA; color: #633806; }

        /* Purple - auto generated ID */
        .badge-auto    { background: #EEEDFE; color: #3C3489; }

        /* ==========================================
           FOOTER
           Shows on every page at bottom
        ========================================== */
        .footer {
            background: #26215C;
            color: #CECBF6;
            padding: 40px 32px 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin-bottom: 28px;
        }

        .footer h4 {
            color: white;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .footer p {
            font-size: 12px;
            line-height: 2.2;
            color: #CECBF6;
        }

        .footer ul {
            list-style: none;
        }

        .footer ul li a {
            font-size: 12px;
            color: #CECBF6;
            text-decoration: none;
            line-height: 2.4;
            display: block;
        }

        .footer ul li a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #534AB7;
            padding-top: 18px;
            font-size: 12px;
            text-align: center;
            color: #CECBF6;
        }

    </style>

    {{-- Child pages add their own CSS here --}}
    @stack('styles')

</head>
<body>

{{-- ==========================================
     LOGO BAR + NAVBAR
     Shows on every page automatically
========================================== --}}
<header class="logo-bar">

    {{-- Left side: Logo + Company name --}}
    <div class="logo-area">
        <div class="logo-icon">
            {{-- IMAGE 1: public/images/logo.png --}}
            <img src="{{ asset('images/logo.png') }}"
                 alt="SRS Lab Logo">
        </div>
        <div class="logo-text">
            <h2>SRS LabAuto</h2>
            <p>Lab Automation System</p>
        </div>
    </div>

    {{-- Right side: Navigation links --}}
    <nav class="nav-links">

        {{-- Home link --}}
        <a href="{{ route('home') }}"
           class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="ti ti-home"></i> Home
        </a>

        {{-- Contact link --}}
        <a href="{{ route('contact') }}"
           class="{{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="ti ti-mail"></i> Contact
        </a>

        {{-- Show dashboard and logout if logged in --}}
        @auth
            <a href="{{ route('dashboard') }}">
                <i class="ti ti-layout-dashboard"></i> Dashboard
            </a>
            <a href="{{ route('logout') }}">
                <i class="ti ti-logout"></i> Logout
            </a>
        @else
            {{-- Show login button if not logged in --}}
            <a href="{{ route('login') }}"
               class="btn-nav-login">
                <i class="ti ti-login"></i> Login
            </a>
        @endauth

    </nav>

</header>

{{-- ==========================================
     MAIN CONTENT AREA
     Each page puts its content here
     using @section('content')
========================================== --}}
<main>
    @yield('content')
</main>

{{-- ==========================================
     FOOTER
     Shows on every page automatically
========================================== --}}
<footer class="footer">
    <div class="footer-grid">

        {{-- Column 1: About --}}
        <div>
            <h4><i class="ti ti-flask"></i> SRS LabAuto</h4>
            <p>
                Electrical product testing<br>
                management system for<br>
                SRS Electrical Appliances.<br>
                CPRI approved process.
            </p>
        </div>

        {{-- Column 2: Quick links --}}
        <div>
            <h4>Quick Links</h4>
            <ul>
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">
                        Contact
                    </a>
                </li>
                <li>
                    <a href="https://www.cpri.in"
                       target="_blank">
                        CPRI Website
                    </a>
                </li>
            </ul>
        </div>

        {{-- Column 3: Contact info --}}
        <div>
            <h4>Contact Info</h4>
            <p>
                <i class="ti ti-mail"></i>
                info@srselectrical.com
            </p>
            <p>
                <i class="ti ti-phone"></i>
                +91 98765 43210
            </p>
            <p>
                <i class="ti ti-map-pin"></i>
                Industrial Area, India
            </p>
            <p>
                <i class="ti ti-world"></i>
                www.srselectrical.com
            </p>
        </div>

    </div>

    {{-- Copyright line --}}
    <div class="footer-bottom">
        © {{ date('Y') }} SRS Electrical Appliances.
        All rights reserved.
    </div>

</footer>

{{-- Child pages add their own JS here --}}
@stack('scripts')

</body>
</html>