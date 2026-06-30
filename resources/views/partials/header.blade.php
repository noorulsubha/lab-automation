
{{-- ============================================
     HEADER
     Location: resources/views/partials/header.blade.php
     Purpose: Global Navigation Header
     Project: SRS Lab Automation
============================================ --}}

<header class="logo-bar">

    {{-- =====================================
         LEFT SIDE - LOGO
    ====================================== --}}
    <div class="logo-area">

        <a href="{{ route('home') }}" style="text-decoration:none; display:flex; align-items:center; gap:12px;">

            <div class="logo-icon">
                <img src="{{ asset('images/logo.jpeg') }}"
                     alt="SRS LabAuto Logo">
            </div>

            <div class="logo-text">
                <h2>SRS LabAuto</h2>
                <p>Electrical Testing Management System</p>
            </div>

        </a>

    </div>

    {{-- =====================================
         CENTER - NAVIGATION MENU
    ====================================== --}}
    <nav class="nav-links">

        <a href="{{ route('home') }}"
           class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="ti ti-home"></i>
            Home
        </a>

        <a href="{{ route('about') }}"
           class="{{ request()->routeIs('about') ? 'active' : '' }}">
            <i class="ti ti-info-circle"></i>
            About
        </a>

        <a href="{{ route('contact') }}"
           class="{{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="ti ti-phone"></i>
            Contact
        </a>

        @auth

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="ti ti-layout-dashboard"></i>
            Dashboard
        </a>

        @endauth

    </nav>

    {{-- =====================================
         RIGHT SIDE - LOGIN / USER
    ====================================== --}}
    <div style="display:flex; align-items:center; gap:12px;">

        @guest

            <a href="{{ route('login') }}" class="btn-nav-login">
                <i class="ti ti-login"></i>
                Login
            </a>

        @else

            <span style="color:white; font-size:14px;">
                <i class="ti ti-user-circle"></i>
                {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button type="submit"
                        class="btn-nav-login"
                        style="border:none;cursor:pointer;">
                    <i class="ti ti-logout"></i>
                    Logout
                </button>

            </form>

        @endguest

    </div>

</header>