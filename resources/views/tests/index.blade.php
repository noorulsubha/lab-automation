{{-- ============================================
     ALL RECORDS PAGE - Page 6
     Location: resources/views/tests/index.blade.php
     Purpose: Show all test records with actions
     Extends: layouts/app.blade.php
     Data from: TestController@index
     ============================================ --}}

@extends('layouts.app')

@section('title', 'All Records — SRS Lab Automation')

@push('styles')
<style>

    /* ==========================================
        PAGE WRAPPER
        Adds padding around all content
    ========================================== */
    .records-page {
        padding: 28px;
    }

    /* ==========================================
        PAGE HEADER
        Title on left - Add button on right
    ========================================== */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .page-header h1 {
        font-size: 22px;
        font-weight: 700;
        color: #26215C;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Header right side buttons */
    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Purple add button */
    .btn-add {
        padding: 10px 20px;
        background: #534AB7;
        color: white;
        border: none;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background 0.2s;
    }

    .btn-add:hover {
        background: #3C3489;
    }

    /* Search shortcut button */
    .btn-search-link {
        padding: 10px 20px;
        background: white;
        color: #534AB7;
        border: 1.5px solid #534AB7;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background 0.2s;
    }

    .btn-search-link:hover {
        background: #EEEDFE;
    }

    /* ==========================================
        SUMMARY CARDS ROW
        Quick stats at top of page
    ========================================== */
    .summary-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .summary-card {
        background: white;
        border-radius: 12px;
        padding: 18px;
        border: 1px solid rgba(0,0,0,0.07);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: box-shadow 0.2s;
    }

    .summary-card:hover {
        box-shadow: 0 4px 16px rgba(83,74,183,0.10);
    }

    /* Icon box */
    .sum-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .sum-icon.purple { background: #EEEDFE; color: #534AB7; }
    .sum-icon.green  { background: #EAF3DE; color: #27500A; }
    .sum-icon.red    { background: #FCEBEB; color: #791F1F; }
    .sum-icon.orange { background: #FAEEDA; color: #633806; }

    .sum-info .num {
        font-size: 22px;
        font-weight: 700;
        color: #26215C;
        line-height: 1;
    }

    .sum-info .lbl {
        font-size: 11px;
        color: #888780;
        margin-top: 4px;
    }

    /* ==========================================
        QUICK FILTER BAR
        Filter by result type quickly
    ========================================== */
    .filter-bar {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-bar span {
        font-size: 13px;
        color: #888780;
        font-weight: 500;
    }

    /* Filter pill buttons */
    .filter-pill {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: 1.5px solid transparent;
        transition: all 0.2s;
        cursor: pointer;
    }

    .filter-pill.all {
        background: #534AB7;
        color: white;
        border-color: #534AB7;
    }

    .filter-pill.pass {
        background: #EAF3DE;
        color: #27500A;
        border-color: #C3E0A0;
    }

    .filter-pill.fail {
        background: #FCEBEB;
        color: #791F1F;
        border-color: #F5C6C6;
    }

    .filter-pill.pending {
        background: #FAEEDA;
        color: #633806;
        border-color: #F5D9A8;
    }

    .filter-pill:hover {
        opacity: 0.8;
    }

    /* ==========================================
        MAIN TABLE CARD
    ========================================== */
    .table-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 24px;
    }

    /* Table card header */
    .table-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-card-title {
        font-size: 15px;
        font-weight: 600;
        color: #26215C;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Records count badge */
    .records-count {
        background: #EEEDFE;
        color: #534AB7;
        font-size: 12px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
    }

    /* ==========================================
        DATA TABLE
        Horizontal scroll on mobile
    ========================================== */
    .table-scroll {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        min-width: 750px;
    }

    /* Header row */
    .data-table th {
        background: #F1EFE8;
        text-align: left;
        padding: 11px 16px;
        font-weight: 600;
        font-size: 11px;
        color: #3C3489;
        border-bottom: 1px solid rgba(0,0,0,0.07);
        white-space: nowrap;
    }

    /* Sortable header */
    .data-table th.sortable {
        cursor: pointer;
        user-select: none;
    }

    .data-table th.sortable:hover {
        background: #E8E4DC;
    }

    /* Data cells */
    .data-table td {
        padding: 13px 16px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        color: #2C2C2A;
        vertical-align: middle;
    }

    /* Last row no border */
    .data-table tr:last-child td {
        border-bottom: none;
    }

    /* Row hover */
    .data-table tr:hover td {
        background: #F8F8F6;
    }

    /* ==========================================
        BADGE STYLES
    ========================================== */
    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-pass    { background: #EAF3DE; color: #27500A; }
    .badge-fail    { background: #FCEBEB; color: #791F1F; }
    .badge-pending { background: #FAEEDA; color: #633806; }
    .badge-auto    { background: #EEEDFE; color: #3C3489;
                     font-family: monospace; font-size: 10px; }

    /* ==========================================
        REMARKS PREVIEW
        Truncated text with tooltip
    ========================================== */
    .remarks-cell {
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #888780;
        font-size: 12px;
        cursor: help;
    }

    /* ==========================================
        ACTION BUTTONS IN TABLE ROW
    ========================================== */
    .action-btns {
        display: flex;
        gap: 6px;
        align-items: center;
        flex-wrap: nowrap;
    }

    /* Delete button */
    .btn-delete {
        padding: 5px 10px;
        background: #FCEBEB;
        color: #791F1F;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-delete:hover {
        background: #791F1F;
        color: white;
    }

    /* ==========================================
        EMPTY STATE
        Shows when no records exist
    ========================================== */
    .empty-state {
        text-align: center;
        padding: 60px 24px;
    }

    .empty-state i {
        font-size: 60px;
        color: #CECBF6;
        display: block;
        margin-bottom: 16px;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: #888780;
        margin-bottom: 24px;
    }

    /* ==========================================
        SUCCESS AND ERROR ALERTS
    ========================================== */
    .alert-success {
        background: #EAF3DE;
        border: 1px solid #C3E0A0;
        border-radius: 9px;
        padding: 14px 18px;
        font-size: 13px;
        color: #27500A;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-error {
        background: #FCEBEB;
        border: 1px solid #F5C6C6;
        border-radius: 9px;
        padding: 14px 18px;
        font-size: 13px;
        color: #791F1F;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ==========================================
        PAGINATION
    ========================================== */
    .pagination-wrap {
        padding: 16px 20px;
        border-top: 1px solid rgba(0,0,0,0.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pagination-info {
        font-size: 12px;
        color: #888780;
    }

    /* Laravel default pagination override */
    .pagination-wrap nav {
        display: flex;
    }

    .pagination-wrap .pagination {
        display: flex;
        gap: 4px;
        list-style: none;
        flex-wrap: wrap;
    }

    .pagination-wrap .page-item .page-link {
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 13px;
        border: 1px solid rgba(0,0,0,0.10);
        color: #534AB7;
        text-decoration: none;
        display: block;
        transition: background 0.2s;
    }

    .pagination-wrap .page-item.active .page-link {
        background: #534AB7;
        color: white;
        border-color: #534AB7;
    }

    .pagination-wrap .page-item .page-link:hover {
        background: #EEEDFE;
    }

    .pagination-wrap .page-item.disabled .page-link {
        color: #CECBF6;
        cursor: not-allowed;
    }

    /* ==========================================
        RESPONSIVE STYLES
    ========================================== */

    /* Tablet max 1024px */
    @media (max-width: 1024px) {

        /* Summary cards 2 columns */
        .summary-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Mobile max 768px */
    @media (max-width: 768px) {

        /* Smaller padding */
        .records-page {
            padding: 16px;
        }

        /* Header stacks */
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        /* Buttons full width */
        .header-actions {
            width: 100%;
        }

        .btn-add,
        .btn-search-link {
            flex: 1;
            justify-content: center;
        }

        /* Summary 2 columns on mobile */
        .summary-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        /* Smaller summary cards */
        .summary-card {
            padding: 14px;
            gap: 10px;
        }

        .sum-info .num {
            font-size: 18px;
        }

        /* Filter bar wraps */
        .filter-bar {
            gap: 6px;
        }

        /* Pagination stacks */
        .pagination-wrap {
            flex-direction: column;
            align-items: center;
        }
    }

    /* Small mobile max 480px */
    @media (max-width: 480px) {

        /* Summary 1 column */
        .summary-row {
            grid-template-columns: 1fr 1fr;
        }
    }

</style>
@endpush

@section('content')

<div class="sidebar-layout">

    {{-- ======================================
         SIDEBAR - Left navigation
    ====================================== --}}
    <aside class="sidebar">

        <div class="sidebar-label">Main Menu</div>

        <a href="{{ route('dashboard') }}"
           class="sidebar-item">
            <i class="ti ti-layout-dashboard"></i>
            Dashboard
        </a>

        <div class="sidebar-label">Tests</div>

        <a href="{{ route('tests.create') }}"
           class="sidebar-item">
            <i class="ti ti-plus"></i>
            Add New Test
        </a>

        <a href="{{ route('tests.search') }}"
           class="sidebar-item">
            <i class="ti ti-search"></i>
            Search Records
        </a>

        {{-- All Records - currently active --}}
        <a href="{{ route('tests.index') }}"
           class="sidebar-item active">
            <i class="ti ti-table"></i>
            All Records
        </a>

        <div class="sidebar-label">Reports</div>

        <a href="#" class="sidebar-item">
            <i class="ti ti-file-report"></i>
            Test Reports
        </a>

        <div class="sidebar-label">Account</div>

        <a href="{{ route('logout') }}"
           class="sidebar-item">
            <i class="ti ti-logout"></i>
            Logout
        </a>

    </aside>

    {{-- ======================================
         MAIN CONTENT AREA
    ====================================== --}}
    <div class="main-content">
        <div class="records-page">

            {{-- Page header --}}
            <div class="page-header">
                <h1>
                    <i class="ti ti-table"
                       style="color:#534AB7;"></i>
                    All Test Records
                </h1>
                <div class="header-actions">
                    {{-- Search button --}}
                    <a href="{{ route('tests.search') }}"
                       class="btn-search-link">
                        <i class="ti ti-search"></i>
                        Search
                    </a>
                    {{-- Add new test button --}}
                    <a href="{{ route('tests.create') }}"
                       class="btn-add">
                        <i class="ti ti-plus"></i>
                        Add New Test
                    </a>
                </div>
            </div>

            {{-- Success message --}}
            @if(session('success'))
                <div class="alert-success">
                    <i class="ti ti-circle-check"
                       style="font-size:20px;"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error message --}}
            @if(session('error'))
                <div class="alert-error">
                    <i class="ti ti-alert-circle"
                       style="font-size:20px;"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- ====================================
                 SUMMARY CARDS
                 Quick count at top of page
                 Data from TestController@index
            ==================================== --}}
            <div class="summary-row">

                {{-- Total tests --}}
                <div class="summary-card">
                    <div class="sum-icon purple">
                        <i class="ti ti-flask"></i>
                    </div>
                    <div class="sum-info">
                        <div class="num">{{ $totalTests }}</div>
                        <div class="lbl">Total Tests</div>
                    </div>
                </div>

                {{-- Passed tests --}}
                <div class="summary-card">
                    <div class="sum-icon green">
                        <i class="ti ti-circle-check"></i>
                    </div>
                    <div class="sum-info">
                        <div class="num">{{ $passedTests }}</div>
                        <div class="lbl">Passed</div>
                    </div>
                </div>

                {{-- Failed tests --}}
                <div class="summary-card">
                    <div class="sum-icon red">
                        <i class="ti ti-circle-x"></i>
                    </div>
                    <div class="sum-info">
                        <div class="num">{{ $failedTests }}</div>
                        <div class="lbl">Failed</div>
                    </div>
                </div>

                {{-- Pending tests --}}
                <div class="summary-card">
                    <div class="sum-icon orange">
                        <i class="ti ti-clock"></i>
                    </div>
                    <div class="sum-info">
                        <div class="num">{{ $pendingTests }}</div>
                        <div class="lbl">Pending</div>
                    </div>
                </div>

            </div>
            {{-- end summary-row --}}

            {{-- ====================================
                 QUICK FILTER PILLS
                 Filter by result type
            ==================================== --}}
            <div class="filter-bar">
                <span>Filter:</span>

                {{-- Show all records --}}
                <a href="{{ route('tests.index') }}"
                   class="filter-pill all">
                    All Records
                </a>

                {{-- Show only passed --}}
                <a href="{{ route('tests.search') }}?result=pass"
                   class="filter-pill pass">
                    <i class="ti ti-circle-check"></i>
                    Passed
                </a>

                {{-- Show only failed --}}
                <a href="{{ route('tests.search') }}?result=fail"
                   class="filter-pill fail">
                    <i class="ti ti-circle-x"></i>
                    Failed
                </a>

                {{-- Show only pending --}}
                <a href="{{ route('tests.search') }}?result=pending"
                   class="filter-pill pending">
                    <i class="ti ti-clock"></i>
                    Pending
                </a>
            </div>

            {{-- ====================================
                 MAIN RECORDS TABLE
                 All test records paginated
            ==================================== --}}
            <div class="table-card">

                {{-- Table card header --}}
                <div class="table-card-header">
                    <div class="table-card-title">
                        <i class="ti ti-list"
                           style="color:#534AB7;"></i>
                        Test Records
                        <span class="records-count">
                            {{ $tests->total() }} total
                        </span>
                    </div>
                </div>

                @if($tests->count() > 0)

                    {{-- Horizontal scroll wrapper --}}
                    <div class="table-scroll">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    {{-- Image column header --}}
                                    <th>Image</th>
                                    <th>Product ID</th>
                                    <th>Test ID</th>
                                    <th>Test Type</th>
                                    <th>Tester Name</th>
                                    <th>Test Date</th>
                                    <th>Remarks</th>
                                    <th>Result</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- Loop through all test records --}}
                                @foreach($tests as $index => $test)
                                    <tr>

                                        {{-- Row number --}}
                                        <td style="color:#888780;
                                                   font-size:12px;
                                                   width:40px;">
                                            {{ $tests->firstItem() + $index }}
                                        </td>

                                        {{-- Product image --}}
                                        <td>
                                            @if($test->product_image)
                                                {{-- Show image if uploaded --}}
                                                <img src="{{ asset($test->product_image) }}"
                                                     alt="Product"
                                                     style="width:45px;
                                                            height:45px;
                                                            object-fit:cover;
                                                            border-radius:6px;
                                                            border:1px solid rgba(0,0,0,0.1);">
                                            @else
                                                {{-- Show placeholder if no image --}}
                                                <div style="width:45px;
                                                            height:45px;
                                                            background:#EEEDFE;
                                                            border-radius:6px;
                                                            display:flex;
                                                            align-items:center;
                                                            justify-content:center;">
                                                    <i class="ti ti-photo"
                                                       style="color:#AFA9EC;font-size:18px;"></i>
                                                </div>
                                            @endif
                                        </td>

                                        {{-- Product ID bold --}}
                                        <td>
                                            <strong style="color:#26215C;">
                                                {{ $test->product_id }}
                                            </strong>
                                        </td>

                                        {{-- Auto generated test ID --}}
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

                                        {{-- Date formatted nicely --}}
                                        <td style="white-space:nowrap;">
                                            <i class="ti ti-calendar"
                                               style="color:#AFA9EC;
                                                      font-size:13px;">
                                            </i>
                                            {{ date('d M Y',
                                               strtotime($test->test_date)) }}
                                        </td>

                                        {{-- Remarks preview with tooltip --}}
                                        <td>
                                            <div class="remarks-cell"
                                                 title="{{ $test->remarks }}">
                                                {{ $test->remarks }}
                                            </div>
                                        </td>

                                        {{-- Result with color badge --}}
                                        <td>
                                            @if($test->result == 'pass')
                                                <span class="badge badge-pass">
                                                    <i class="ti ti-check"></i>
                                                    Pass
                                                </span>
                                            @elseif($test->result == 'fail')
                                                <span class="badge badge-fail">
                                                    <i class="ti ti-x"></i>
                                                    Fail
                                                </span>
                                            @else
                                                <span class="badge badge-pending">
                                                    <i class="ti ti-clock"></i>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Action buttons --}}
                                        <td>
                                            <div class="action-btns">

                                                {{-- Delete with confirmation --}}
                                                <form
                                                    action="{{ route('tests.destroy', $test->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirmDelete('{{ $test->test_id }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn-delete">
                                                        <i class="ti ti-trash"></i>
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{-- end table-scroll --}}

                    {{-- Pagination --}}
                    @if($tests->hasPages())
                        <div class="pagination-wrap">
                            <div class="pagination-info">
                                Showing {{ $tests->firstItem() }}
                                to {{ $tests->lastItem() }}
                                of {{ $tests->total() }} records
                            </div>
                            {{ $tests->links() }}
                        </div>
                    @endif

                @else

                    {{-- Empty state - no records yet --}}
                    <div class="empty-state">
                        <i class="ti ti-database-off"></i>
                        <h3>No Test Records Found</h3>
                        <p>
                            No test records have been added yet.
                            <br>
                            Add your first test record to get started.
                        </p>
                        <a href="{{ route('tests.create') }}"
                           class="btn-add"
                           style="display:inline-flex;">
                            <i class="ti ti-plus"></i>
                            Add First Test Record
                        </a>
                    </div>

                @endif

            </div>
            {{-- end table-card --}}

        </div>
        {{-- end records-page --}}
    </div>
    {{-- end main-content --}}

</div>
{{-- end sidebar-layout --}}

@endsection

@push('scripts')
<script>

    // ==========================================
    // confirmDelete()
    // Purpose: Show confirm dialog before delete
    // Shows test ID in confirmation message
    // ==========================================
    function confirmDelete(testId) {
        return confirm(
            'Are you sure you want to delete test record: '
            + testId + '?\n\nThis action cannot be undone.'
        );
    }

</script>
@endpush