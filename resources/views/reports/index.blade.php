{{-- ============================================
     REPORTS PAGE
     Location: resources/views/reports/index.blade.php
     Purpose: Show test reports with stats and records
     ============================================ --}}

@extends('layouts.app')

@section('title', 'Test Reports - SRS Lab Automation')

@push('styles')
<style>
/* ==========================================
   PAGE WRAPPER & GENERAL
========================================== */
.reports-page {
    padding: 28px;
    background: #F8F8FB;
    min-height: 100vh;
}

/* ==========================================
   PAGE HEADER
========================================== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 25px;
}

.page-header h1 {
    font-size: 24px;
    font-weight: 700;
    color: #26215C;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}

.header-actions {
    display: flex;
    gap: 10px;
}

/* ==========================================
   BUTTONS
========================================== */
.btn {
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: .3s;
    display: inline-block;
}

.btn-success {
    background: #198754;
    color: #fff;
}

.btn-success:hover {
    background: #157347;
    color: #fff;
}

/* ==========================================
   YEAR FILTER
========================================== */
.year-filter {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.year-filter strong {
    color: #26215C;
    font-size: 14px;
}

.year-filter a {
    display: inline-block;
    padding: 7px 15px;
    border-radius: 20px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #555;
    font-size: 13px;
    transition: .3s;
    background: #fff;
}

.year-filter a.active {
    background: #534AB7;
    color: white;
    border-color: #534AB7;
}

.year-filter a:hover:not(.active) {
    background: #EEEAFE;
    color: #534AB7;
    border-color: #534AB7;
}

/* ==========================================
   SUMMARY CARDS
========================================== */
.summary-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.summary-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
}

.summary-card h2 {
    font-size: 28px;
    font-weight: 700;
    color: #26215C;
    margin: 0 0 6px 0;
}

.summary-card p {
    margin: 0;
    color: #777;
    font-size: 13px;
    font-weight: 500;
}

/* ==========================================
   RECORDS TABLE
========================================== */
.records-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
    overflow: hidden;
}

.records-header {
    padding: 18px 20px;
    background: #fff;
    border-bottom: 1px solid #EDEDF5;
    font-weight: 700;
    color: #26215C;
    font-size: 16px;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    background: #534AB7;
    color: #fff;
    padding: 14px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
}

.data-table td {
    padding: 14px;
    border-bottom: 1px solid #EDEDF5;
    color: #495057;
    font-size: 13px;
}

/* ==========================================
   BADGES
========================================== */
.badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}

.badge-pass {
    background: #E7F7E7;
    color: #0F7D2E;
}

.badge-fail {
    background: #FFE8E8;
    color: #B42318;
}

.badge-pending {
    background: #FFF1DD;
    color: #B54708;
}

/* ==========================================
   PRINT STYLES
========================================== */
@media print {
    .sidebar,
    .logo-bar,
    .footer,
    .header-actions,
    .year-filter {
        display: none !important;
    }
    .reports-page {
        padding: 0;
        background: #fff;
    }
    .main-content {
        margin: 0;
        padding: 0;
        width: 100%;
    }
    .summary-card, .records-card {
        box-shadow: none;
        border: 1px solid #ccc;
    }
}
</style>
@endpush

@section('content')
<div class="reports-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <h1>Test Reports - {{ $year }}</h1>
        <div class="header-actions">
            <a href="{{ route('reports.print', ['year' => $year]) }}" class="btn btn-success" target="_blank">
                Print Report
            </a>
        </div>
    </div>

    {{-- YEAR FILTER --}}
    <div class="year-filter">
        <strong>Select Year:</strong>
        @foreach($availableYears as $y)
            <a href="{{ route('reports.index', ['year' => $y]) }}" class="{{ $year == $y ? 'active' : '' }}">
                {{ $y }}
            </a>
        @endforeach
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="summary-row">
        <div class="summary-card">
            <h2>{{ $totalTests }}</h2>
            <p>Total Tests</p>
        </div>

        <div class="summary-card">
            <h2>{{ $passedTests }}</h2>
            <p>Passed Tests</p>
        </div>

        <div class="summary-card">
            <h2>{{ $failedTests }}</h2>
            <p>Failed Tests</p>
        </div>

        <div class="summary-card">
            <h2>{{ $pendingTests }}</h2>
            <p>Pending Tests</p>
        </div>

        <div class="summary-card">
            <h2>{{ $passRate }}%</h2>
            <p>Pass Rate</p>
        </div>
    </div>

    {{-- TEST RECORDS --}}
    <div class="records-card">
        <div class="records-header">
            All Test Records
        </div>

        @if($tests->count() > 0)
            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Test ID</th>
                            <th>Test Type</th>
                            <th>Tester Name</th>
                            <th>Date</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $key => $test)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $test->product_id }}</td>
                                <td>{{ $test->test_id }}</td>
                                <td>{{ ucfirst($test->test_type) }}</td>
                                <td>{{ $test->tester_name }}</td>
                                <td>
                                    {{ $test->test_date ? date('d-m-Y', strtotime($test->test_date)) : '-' }}
                                </td>
                                <td>
                                    @if($test->result == 'pass')
                                        <span class="badge badge-pass">PASS</span>
                                    @elseif($test->result == 'fail')
                                        <span class="badge badge-fail">FAIL</span>
                                    @else
                                        <span class="badge badge-pending">PENDING</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding:40px; text-align:center;">
                <h3 style="color: #777; margin: 0;">No Test Records Found.</h3>
            </div>
        @endif
    </div>

</div>
@endsection