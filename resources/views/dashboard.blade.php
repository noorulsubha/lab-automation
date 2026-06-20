{{-- ============================================
     DASHBOARD PAGE - Page 3
     Location: resources/views/dashboard.blade.php
     Purpose: Main dashboard with stats and charts
     Extends: layouts/app.blade.php
     Data from: DashboardController@index
     ============================================ --}}

@extends('layouts.app')

@section('title', 'Dashboard — SRS Lab Automation')

@push('styles')
<style>

    /* ==========================================
       WELCOME BAR - Top purple banner
    ========================================== */
    .welcome-bar {
        background: linear-gradient(90deg, #26215C 0%, #534AB7 100%);
        border-radius: 14px;
        padding: 22px 26px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .welcome-bar h2 {
        font-size: 20px;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
    }

    .welcome-bar p {
        font-size: 13px;
        color: #CECBF6;
    }

    /* ==========================================
       IMAGE 8
       Location: public/images/dashboard-banner.jpg
       Size: 200x200px recommended
       Place: Welcome bar right side circle image
    ========================================== */
    .welcome-img {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255,255,255,0.25);
        opacity: 0.85;
    }

    /* ==========================================
       QUICK ACTION BUTTONS ROW
    ========================================== */
    .quick-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .quick-btn {
        padding: 10px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: none;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .quick-btn:hover  { opacity: 0.85; }
    .quick-btn.purple { background: #534AB7; color: white; }
    .quick-btn.green  { background: #EAF3DE; color: #27500A; }
    .quick-btn.orange { background: #FAEEDA; color: #633806; }

    /* ==========================================
       STATS CARDS GRID
    ========================================== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(155px, 1fr));
        gap: 16px;
        margin-bottom: 26px;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid rgba(0,0,0,0.07);
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition: box-shadow 0.2s;
    }

    .stat-card:hover {
        box-shadow: 0 4px 20px rgba(83,74,183,0.12);
    }

    /* Colored icon box */
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    /* Icon background colors */
    .stat-icon.purple { background: #EEEDFE; color: #534AB7; }
    .stat-icon.green  { background: #EAF3DE; color: #27500A; }
    .stat-icon.red    { background: #FCEBEB; color: #791F1F; }
    .stat-icon.orange { background: #FAEEDA; color: #633806; }
    .stat-icon.blue   { background: #E3F2FD; color: #1565C0; }

    /* Big number */
    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #26215C;
        line-height: 1;
    }

    /* Label below number */
    .stat-label {
        font-size: 12px;
        color: #888780;
        font-weight: 500;
    }

    /* ==========================================
       CHARTS ROW
       Left: Pie Chart (1 part)
       Right: Bar Chart (2 parts)
    ========================================== */
    .charts-row {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 16px;
        margin-bottom: 26px;
    }

    .chart-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid rgba(0,0,0,0.07);
    }

    .chart-title {
        font-size: 14px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Canvas wrapper for chart */
    .chart-wrap {
        position: relative;
        height: 210px;
    }

    /* ==========================================
       RECENT TESTS TABLE CARD
    ========================================== */
    .table-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid rgba(0,0,0,0.07);
        margin-bottom: 16px;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .table-title {
        font-size: 14px;
        font-weight: 600;
        color: #26215C;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Data table */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    /* Table header row */
    .data-table th {
        background: #F1EFE8;
        text-align: left;
        padding: 10px 14px;
        font-weight: 600;
        font-size: 11px;
        color: #3C3489;
        border-bottom: 1px solid rgba(0,0,0,0.07);
    }

    /* Table data cells */
    .data-table td {
        padding: 12px 14px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        color: #2C2C2A;
        vertical-align: middle;
    }

    /* Remove border from last row */
    .data-table tr:last-child td {
        border-bottom: none;
    }

    /* Hover effect on rows */
    .data-table tr:hover td {
        background: #F8F8F6;
    }

    /* ==========================================
       RESPONSIVE - Mobile styles
       Screen less than 768px
    ========================================== */
    @media (max-width: 768px) {

        /* Charts stack on mobile */
        .charts-row {
            grid-template-columns: 1fr;
        }

        /* Smaller welcome bar on mobile */
        .welcome-bar {
            padding: 16px;
        }

        .welcome-bar h2 {
            font-size: 16px;
        }

        /* Hide welcome image on mobile */
        .welcome-img {
            display: none;
        }

        /* Smaller padding on mobile */
        .main-content {
            padding: 16px;
        }

        /* Table scroll on mobile */
        .table-card {
            overflow-x: auto;
        }

        /* Stats 2 columns on mobile */
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

</style>
@endpush

@section('content')

<div class="sidebar-layout">

    {{-- ======================================
         SIDEBAR
         Left side dark purple navigation
    ====================================== --}}
    <aside class="sidebar">

        <div class="sidebar-label">Main Menu</div>

        {{-- Dashboard - currently active page --}}
        <a href="{{ route('dashboard') }}"
           class="sidebar-item active">
            <i class="ti ti-layout-dashboard"></i>
            Dashboard
        </a>

        <div class="sidebar-label">Tests</div>

        {{-- Add New Test - Page 4 --}}
        <a href="{{ route('tests.create') }}"
           class="sidebar-item">
            <i class="ti ti-plus"></i>
            Add New Test
        </a>

        {{-- Search Records - Page 5 --}}
        <a href="{{ route('tests.search') }}"
           class="sidebar-item">
            <i class="ti ti-search"></i>
            Search Records
        </a>

        {{-- All Records - Page 6 --}}
        <a href="{{ route('tests.index') }}"
           class="sidebar-item">
            <i class="ti ti-table"></i>
            All Records
        </a>

        <div class="sidebar-label">Reports</div>

        {{-- Test Reports - Page 7 --}}
        <a href="#"
           class="sidebar-item">
            <i class="ti ti-file-report"></i>
            Test Reports
        </a>

        <div class="sidebar-label">Account</div>

        {{-- Logout --}}
        <a href="{{ route('logout') }}"
           class="sidebar-item">
            <i class="ti ti-logout"></i>
            Logout
        </a>

    </aside>

    {{-- ======================================
         MAIN CONTENT
         Right side content area
    ====================================== --}}
    <div class="main-content">

        {{-- ====================================
             WELCOME BAR
             Shows logged in user name and date
        ==================================== --}}
        <div class="welcome-bar">
            <div>
                {{-- Logged in user name from Auth --}}
                <h2>
                    Welcome back, {{ Auth::user()->name }}!
                </h2>
                <p>
                    <i class="ti ti-calendar"></i>
                    {{ date('l, d F Y') }}
                    &nbsp;|&nbsp;
                    Role: {{ ucfirst(Auth::user()->role) }}
                </p>
            </div>

            {{-- IMAGE 8: public/images/dashboard-banner.jpg
                 Size: 200x200px - circle crop
                 Lab or factory image recommended --}}
            <img src="{{ asset('images/dashboard-banner.jpg') }}"
                 alt="Lab Dashboard"
                 class="welcome-img">
        </div>

        {{-- ====================================
             QUICK ACTION BUTTONS
             Shortcut links to main features
        ==================================== --}}
        <div class="quick-actions">

            {{-- Add new test shortcut --}}
            <a href="{{ route('tests.create') }}"
               class="quick-btn purple">
                <i class="ti ti-plus"></i>
                Add New Test
            </a>

            {{-- Search records shortcut --}}
            <a href="{{ route('tests.search') }}"
               class="quick-btn green">
                <i class="ti ti-search"></i>
                Search Records
            </a>

            {{-- View reports shortcut --}}
            <a href="#"
               class="quick-btn orange">
                <i class="ti ti-file-report"></i>
                View Reports
            </a>

        </div>

        {{-- ====================================
             STATISTICS CARDS
             All numbers from DashboardController
        ==================================== --}}
        <div class="stats-grid">

            {{-- Card 1: Total Tests --}}
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="ti ti-flask"></i>
                </div>
                <div class="stat-number">
                    {{ $totalTests }}
                </div>
                <div class="stat-label">Total Tests</div>
            </div>

            {{-- Card 2: Tests Passed --}}
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="ti ti-circle-check"></i>
                </div>
                <div class="stat-number">
                    {{ $passedTests }}
                </div>
                <div class="stat-label">Tests Passed</div>
            </div>

            {{-- Card 3: Tests Failed --}}
            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="ti ti-circle-x"></i>
                </div>
                <div class="stat-number">
                    {{ $failedTests }}
                </div>
                <div class="stat-label">Tests Failed</div>
            </div>

            {{-- Card 4: Tests Pending --}}
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="ti ti-clock"></i>
                </div>
                <div class="stat-number">
                    {{ $pendingTests }}
                </div>
                <div class="stat-label">Tests Pending</div>
            </div>

            {{-- Card 5: Total Products --}}
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="ti ti-box"></i>
                </div>
                <div class="stat-number">
                    {{ $totalProducts }}
                </div>
                <div class="stat-label">Total Products</div>
            </div>

        </div>
        {{-- end stats-grid --}}

        {{-- ====================================
             CHARTS ROW
             Left: Pie Chart - Pass/Fail/Pending
             Right: Bar Chart - Monthly tests
        ==================================== --}}
        <div class="charts-row">

            {{-- Pie Chart card --}}
            <div class="chart-card">
                <div class="chart-title">
                    <i class="ti ti-chart-pie"
                       style="color:#534AB7;"></i>
                    Test Results
                </div>
                <div class="chart-wrap">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

            {{-- Bar Chart card --}}
            <div class="chart-card">
                <div class="chart-title">
                    <i class="ti ti-chart-bar"
                       style="color:#534AB7;"></i>
                    Monthly Tests — {{ date('Y') }}
                </div>
                <div class="chart-wrap">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

        </div>
        {{-- end charts-row --}}

        {{-- ====================================
             RECENT TESTS TABLE
             Last 5 tests from database
             Data from DashboardController
        ==================================== --}}
        <div class="table-card">

            <div class="table-header">
                <div class="table-title">
                    <i class="ti ti-clock"
                       style="color:#534AB7;"></i>
                    Recent Tests
                </div>
                {{-- Link to all records page --}}
                <a href="{{ route('tests.index') }}"
                   class="quick-btn purple"
                   style="padding:7px 14px;font-size:12px;">
                    <i class="ti ti-table"></i>
                    View All Records
                </a>
            </div>

            {{-- Scrollable table on mobile --}}
            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Test ID</th>
                            <th>Test Type</th>
                            <th>Tester Name</th>
                            <th>Test Date</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- Loop through recent 5 tests --}}
                        @forelse($recentTests as $test)
                            <tr>
                                {{-- Product ID --}}
                                <td>
                                    <strong>
                                        {{ $test->product_id }}
                                    </strong>
                                </td>

                                {{-- Test ID with purple badge --}}
                                <td>
                                    <span class="badge badge-auto">
                                        {{ $test->test_id }}
                                    </span>
                                </td>

                                {{-- Test type capitalized --}}
                                <td>
                                    {{ ucfirst($test->test_type) }}
                                </td>

                                {{-- Tester name --}}
                                <td>{{ $test->tester_name }}</td>

                                {{-- Date formatted --}}
                                <td>
                                    {{ date('d M Y',
                                       strtotime($test->test_date)) }}
                                </td>

                                {{-- Result with color badge --}}
                                <td>
                                    @if($test->result == 'pass')
                                        <span class="badge badge-pass">
                                            Pass
                                        </span>
                                    @elseif($test->result == 'fail')
                                        <span class="badge badge-fail">
                                            Fail
                                        </span>
                                    @else
                                        <span class="badge badge-pending">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            </tr>

                        {{-- Show if no test records yet --}}
                        @empty
                            <tr>
                                <td colspan="6"
                                    style="text-align:center;
                                           padding:40px;
                                           color:#888780;">
                                    <i class="ti ti-database-off"
                                       style="font-size:40px;
                                              display:block;
                                              margin-bottom:12px;
                                              color:#AFA9EC;">
                                    </i>
                                    No test records found yet.
                                    <br>
                                    <a href="{{ route('tests.create') }}"
                                       style="color:#534AB7;
                                              font-weight:600;
                                              margin-top:8px;
                                              display:inline-block;">
                                        Add your first test record
                                    </a>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            {{-- end overflow wrapper --}}

        </div>
        {{-- end table-card --}}

    </div>
    {{-- end main-content --}}

</div>
{{-- end sidebar-layout --}}

@endsection

{{-- ==========================================
     JAVASCRIPT
     Chart.js for pie and bar charts
     Loaded at bottom of page
========================================== --}}
@push('scripts')

{{-- Chart.js CDN library --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // ==========================================
    // PIE CHART
    // Shows Pass / Fail / Pending ratio
    // Data from $chartData in DashboardController
    // ==========================================
    const pieCtx = document
                   .getElementById('pieChart')
                   .getContext('2d');

    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Passed', 'Failed', 'Pending'],
            datasets: [{
                // PHP variables passed to JavaScript
                data: [
                    {{ $chartData['pass'] }},
                    {{ $chartData['fail'] }},
                    {{ $chartData['pending'] }}
                ],
                backgroundColor: [
                    '#27500A',  // Dark green - passed
                    '#791F1F',  // Dark red - failed
                    '#633806',  // Dark orange - pending
                ],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 11 },
                        padding: 16
                    }
                }
            }
        }
    });

    // ==========================================
    // BAR CHART
    // Shows tests count per month this year
    // Data from $monthlyData in DashboardController
    // ==========================================
    const barCtx = document
                   .getElementById('barChart')
                   .getContext('2d');

    // Short month names for x-axis labels
    const months = [
        'Jan', 'Feb', 'Mar', 'Apr',
        'May', 'Jun', 'Jul', 'Aug',
        'Sep', 'Oct', 'Nov', 'Dec'
    ];

    // Convert PHP collection to JavaScript
    const monthlyRaw = @json($monthlyData);

    // Start with 0 for all 12 months
    const monthlyValues = Array(12).fill(0);

    // Fill in real values from database
    monthlyRaw.forEach(item => {
        // DB month is 1-12, array is 0-11
        monthlyValues[item.month - 1] = item.total;
    });

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Tests Done',
                data: monthlyValues,
                backgroundColor: '#534AB7',  // Purple bars
                borderRadius: 6,
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

</script>

@endpush