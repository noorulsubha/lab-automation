{{-- ==========================================
    SIDEBAR MENU
    File: resources/views/partials/sidebar.blade.php
    Purpose: Common Sidebar for All Dashboards
========================================== --}}

<aside class="sidebar">

    {{-- ================= MAIN MENU ================= --}}
    <div class="sidebar-label">
        Main Menu
    </div>

    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}"
       class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="ti ti-layout-dashboard"></i>
        Dashboard
    </a>

    {{-- ================= TESTS ================= --}}
    <div class="sidebar-label">
        Tests
    </div>

    <a href="{{ route('tests.create') }}"
       class="sidebar-item {{ request()->routeIs('tests.create') ? 'active' : '' }}">
        <i class="ti ti-plus"></i>
        Add New Test
    </a>

    <a href="{{ route('tests.search') }}"
       class="sidebar-item {{ request()->routeIs('tests.search') ? 'active' : '' }}">
        <i class="ti ti-search"></i>
        Search Records
    </a>

    <a href="{{ route('tests.index') }}"
       class="sidebar-item {{ request()->routeIs('tests.index') ? 'active' : '' }}">
        <i class="ti ti-table"></i>
        All Records
    </a>

    {{-- ================= REPORTS ================= --}}
    <div class="sidebar-label">
        Reports
    </div>

    <a href="{{ route('reports.index') }}"
       class="sidebar-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
        <i class="ti ti-file-report"></i>
        Test Reports
    </a>

    {{-- ================= ACCOUNT ================= --}}
    <div class="sidebar-label">
        Account
    </div>

    <a href="{{ route('logout') }}"
       class="sidebar-item"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="ti ti-logout"></i>
        Logout
    </a>

    {{-- Hidden Logout Form --}}
    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display:none;">
        @csrf
    </form>

    <a href="{{ route('profile') }}"
   class="sidebar-item {{ request()->routeIs('profile') ? 'active' : '' }}">
    <i class="ti ti-user"></i>
    My Profile
    </a>

</aside>