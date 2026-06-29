{{-- ============================================
     SEARCH RECORDS PAGE - Page 5
     Location: resources/views/tests/search.blade.php
     Purpose: Advanced search for test records
     Extends: layouts/app.blade.php
     Data from: TestController@search
     ============================================ --}}

@extends('layouts.app')

@section('title', 'Search Records — SRS Lab Automation')

@push('styles')
<style>

    /* ==========================================
       MAIN CONTENT PADDING
       Responsive padding for all screens
    ========================================== */
    .search-page {
        padding: 28px;
    }

    /* ==========================================
       PAGE HEADER ROW
       Title left - button right
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

    /* ==========================================
       SEARCH FILTER CARD
       White card with all filter fields
    ========================================== */
    .search-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 24px;
    }

    /* Purple header bar of card */
    .card-header {
        background: linear-gradient(90deg, #26215C, #534AB7);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header h2 {
        font-size: 15px;
        font-weight: 600;
        color: white;
    }

    .card-header i {
        font-size: 20px;
        color: #CECBF6;
    }

    /* Card body with padding */
    .card-body {
        padding: 24px;
    }

    /* ==========================================
       SEARCH FORM GRID
       3 columns on desktop
       2 columns on tablet
       1 column on mobile
    ========================================== */
    .search-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    /* ==========================================
       FORM FIELDS
    ========================================== */
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    /* Field label */
    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #26215C;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Input and select fields */
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px 14px;
        font-size: 14px;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 9px;
        background: #FAFAFA;
        color: #2C2C2A;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Focus state - purple border */
    .form-group input:focus,
    .form-group select:focus {
        border-color: #534AB7;
        box-shadow: 0 0 0 3px rgba(83,74,183,0.10);
        background: white;
    }

    /* ==========================================
       SEARCH ACTION BUTTONS
    ========================================== */
    .search-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    /* Main search button */
    .btn-search {
        padding: 11px 28px;
        background: #534AB7;
        color: white;
        border: none;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-search:hover {
        background: #3C3489;
    }

    /* Clear filters button */
    .btn-clear {
        padding: 11px 22px;
        background: white;
        color: #888780;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 9px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn-clear:hover {
        background: #F1EFE8;
        color: #2C2C2A;
    }

    /* ==========================================
       RESULTS INFO BAR
       Shows how many results found
    ========================================== */
    .results-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        background: #EEEDFE;
        border-radius: 9px;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .results-bar .count {
        font-size: 14px;
        font-weight: 600;
        color: #26215C;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .results-bar .export-btn {
        font-size: 13px;
        color: #534AB7;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    /* ==========================================
       RESULTS TABLE CARD
    ========================================== */
    .results-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 24px;
    }

    /* Scrollable table wrapper for mobile */
    .table-scroll {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Data table */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        min-width: 700px;
    }

    /* Table header */
    .data-table th {
        background: #F1EFE8;
        text-align: left;
        padding: 12px 16px;
        font-weight: 600;
        font-size: 11px;
        color: #3C3489;
        border-bottom: 1px solid rgba(0,0,0,0.07);
        white-space: nowrap;
    }

    /* Table data cells */
    .data-table td {
        padding: 13px 16px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        color: #2C2C2A;
        vertical-align: middle;
    }

    /* Remove border from last row */
    .data-table tr:last-child td {
        border-bottom: none;
    }

    /* Hover highlight on rows */
    .data-table tr:hover td {
        background: #F8F8F6;
    }

    /* ==========================================
       BADGES
    ========================================== */
    .badge {
        display: inline-block;
        padding: 3px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-pass    { background: #EAF3DE; color: #27500A; }
    .badge-fail    { background: #FCEBEB; color: #791F1F; }
    .badge-pending { background: #FAEEDA; color: #633806; }
    .badge-auto    { background: #EEEDFE; color: #3C3489; }

    /* ==========================================
       ACTION BUTTONS IN TABLE
    ========================================== */
    .action-btns {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    /* View details button */
    .btn-view {
        padding: 5px 12px;
        background: #EEEDFE;
        color: #534AB7;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn-view:hover {
        background: #534AB7;
        color: white;
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
        gap: 5px;
        transition: background 0.2s;
    }

    .btn-delete:hover {
        background: #791F1F;
        color: white;
    }

    /* ==========================================
       EMPTY STATE
       Shows when no results found
    ========================================== */
    .empty-state {
        text-align: center;
        padding: 56px 24px;
        color: #888780;
    }

    .empty-state i {
        font-size: 56px;
        color: #AFA9EC;
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
        margin-bottom: 20px;
    }

    /* ==========================================
       NO SEARCH YET STATE
       Shows before any search is done
    ========================================== */
    .no-search-state {
        text-align: center;
        padding: 56px 24px;
    }

    .no-search-state i {
        font-size: 64px;
        color: #CECBF6;
        display: block;
        margin-bottom: 16px;
    }

    .no-search-state h3 {
        font-size: 18px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 8px;
    }

    .no-search-state p {
        font-size: 14px;
        color: #888780;
    }

    /* ==========================================
       PAGINATION LINKS
    ========================================== */
    .pagination-wrap {
        padding: 16px 20px;
        border-top: 1px solid rgba(0,0,0,0.06);
        display: flex;
        justify-content: center;
    }

    .pagination-wrap .pagination {
        display: flex;
        gap: 6px;
        list-style: none;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination-wrap .page-item .page-link {
        padding: 7px 13px;
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

    /* ==========================================
       SUCCESS ALERT
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

    /* ==========================================
       REMARKS PREVIEW
       Short preview of remarks in table
    ========================================== */
    .remarks-preview {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #888780;
        font-size: 12px;
    }

    /* ==========================================
       RESPONSIVE STYLES
    ========================================== */

    /* Tablet - max 1024px */
    @media (max-width: 1024px) {
        .search-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Mobile - max 768px */
    @media (max-width: 768px) {

        /* Single column search on mobile */
        .search-grid {
            grid-template-columns: 1fr;
        }

        /* Full width buttons on mobile */
        .search-actions {
            flex-direction: column;
        }

        .btn-search,
        .btn-clear {
            width: 100%;
            justify-content: center;
        }

        /* Smaller padding on mobile */
        .search-page {
            padding: 16px;
        }

        .card-body {
            padding: 16px;
        }

        /* Page header stacks on mobile */
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        /* Results bar stacks on mobile */
        .results-bar {
            flex-direction: column;
            align-items: flex-start;
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

        {{-- Search - currently active --}}
        <a href="{{ route('tests.search') }}"
           class="sidebar-item active">
            <i class="ti ti-search"></i>
            Search Records
        </a>

        <a href="{{ route('tests.index') }}"
           class="sidebar-item">
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
         MAIN CONTENT
    ====================================== --}}
    <div class="main-content">
        <div class="search-page">

            {{-- Page header --}}
            <div class="page-header">
                <h1>
                    <i class="ti ti-search"
                       style="color:#534AB7;"></i>
                    Search Test Records
                </h1>
                <a href="{{ route('tests.create') }}"
                   style="padding:9px 18px;
                          background:#534AB7;
                          color:white;
                          border-radius:8px;
                          font-size:13px;
                          font-weight:500;
                          text-decoration:none;
                          display:inline-flex;
                          align-items:center;
                          gap:7px;">
                    <i class="ti ti-plus"></i>
                    Add New Test
                </a>
            </div>

            {{-- Success message --}}
            @if(session('success'))
                <div class="alert-success">
                    <i class="ti ti-circle-check"
                       style="font-size:20px;"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ====================================
                 SEARCH FILTER CARD
                 All filter fields here
            ==================================== --}}
            <div class="search-card">

                <div class="card-header">
                    <i class="ti ti-adjustments"></i>
                    <h2>Search Filters</h2>
                </div>

                <div class="card-body">

                    {{-- Search form --}}
                    {{-- GET method keeps filters in URL --}}
                    <form action="{{ route('tests.search') }}"
                          method="GET"
                          id="searchForm">

                        <div class="search-grid">

                            {{-- Filter 1: Product ID --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-hash"></i>
                                    Product ID
                                </label>
                                <input
                                    type="text"
                                    name="product_id"
                                    placeholder="Search by product ID"
                                    value="{{ request('product_id') }}">
                            </div>

                            {{-- Filter 2: Test ID --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-id-badge"></i>
                                    Test ID
                                </label>
                                <input
                                    type="text"
                                    name="test_id"
                                    placeholder="Search by test ID"
                                    value="{{ request('test_id') }}">
                            </div>

                            {{-- Filter 3: Tester Name --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-user"></i>
                                    Tester Name
                                </label>
                                <input
                                    type="text"
                                    name="tester_name"
                                    placeholder="Search by tester name"
                                    value="{{ request('tester_name') }}">
                            </div>

                            {{-- Filter 4: Test Type --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-test-pipe"></i>
                                    Test Type
                                </label>
                                <select name="test_type">
                                    <option value="">All Test Types</option>
                                    <option value="electrical"
                                        {{ request('test_type') == 'electrical' ? 'selected' : '' }}>
                                        Electrical Test
                                    </option>
                                    <option value="load"
                                        {{ request('test_type') == 'load' ? 'selected' : '' }}>
                                        Load Test
                                    </option>
                                    <option value="thermal"
                                        {{ request('test_type') == 'thermal' ? 'selected' : '' }}>
                                        Thermal Test
                                    </option>
                                    <option value="safety"
                                        {{ request('test_type') == 'safety' ? 'selected' : '' }}>
                                        Safety Test
                                    </option>
                                    <option value="mechanical"
                                        {{ request('test_type') == 'mechanical' ? 'selected' : '' }}>
                                        Mechanical Test
                                    </option>
                                </select>
                            </div>

                            {{-- Filter 5: Result --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-circle-check"></i>
                                    Result
                                </label>
                                <select name="result">
                                    <option value="">All Results</option>
                                    <option value="pass"
                                        {{ request('result') == 'pass' ? 'selected' : '' }}>
                                        Pass
                                    </option>
                                    <option value="fail"
                                        {{ request('result') == 'fail' ? 'selected' : '' }}>
                                        Fail
                                    </option>
                                    <option value="pending"
                                        {{ request('result') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                </select>
                            </div>

                            {{-- Filter 6: Date From --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-calendar"></i>
                                    Date From
                                </label>
                                <input
                                    type="date"
                                    name="date_from"
                                    value="{{ request('date_from') }}">
                            </div>

                            {{-- Filter 7: Date To --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-calendar-due"></i>
                                    Date To
                                </label>
                                <input
                                    type="date"
                                    name="date_to"
                                    value="{{ request('date_to') }}">
                            </div>

                        </div>
                        {{-- end search-grid --}}

                        {{-- Search and clear buttons --}}
                        <div class="search-actions">

                            {{-- Search button --}}
                            <button type="submit"
                                    class="btn-search">
                                <i class="ti ti-search"></i>
                                Search Records
                            </button>

                            {{-- Clear all filters --}}
                            <a href="{{ route('tests.search') }}"
                               class="btn-clear">
                                <i class="ti ti-x"></i>
                                Clear Filters
                            </a>

                        </div>

                    </form>
                    {{-- end search form --}}

                </div>
                {{-- end card-body --}}

            </div>
            {{-- end search-card --}}

            {{-- ====================================
                 SEARCH RESULTS SECTION
                 Shows after search is done
            ==================================== --}}
            @if($searched)

                {{-- Results count bar --}}
                <div class="results-bar">
                    <div class="count">
                        <i class="ti ti-list-search"
                           style="color:#534AB7;font-size:18px;"></i>
                        {{ $tests->total() }} records found
                    </div>
                    {{-- Export link placeholder --}}
                    <a href="#" class="export-btn">
                        <i class="ti ti-download"></i>
                        Export Results
                    </a>
                </div>

                {{-- Results table card --}}
                <div class="results-card">

                    @if($tests->count() > 0)

                        {{-- Scrollable table --}}
                        <div class="table-scroll">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product ID</th>
                                        <th>Test ID</th>
                                        <th>Test Type</th>
                                        <th>Tester Name</th>
                                        <th>Date</th>
                                        <th>Remarks</th>
                                        <th>Result</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- Loop through search results --}}
                                    @foreach($tests as $index => $test)
                                        <tr>

                                            {{-- Row number --}}
                                            <td style="color:#888780;
                                                       font-size:12px;">
                                                {{ $tests->firstItem() + $index }}
                                            </td>

                                            {{-- Product ID --}}
                                            <td>
                                                <strong style="color:#26215C;">
                                                    {{ $test->product_id }}
                                                </strong>
                                            </td>

                                            {{-- Test ID badge --}}
                                            <td>
                                                <span class="badge badge-auto">
                                                    {{ $test->test_id }}
                                                </span>
                                            </td>

                                            {{-- Test type --}}
                                            <td>
                                                {{ ucfirst($test->test_type) }}
                                            </td>

                                            {{-- Tester name --}}
                                            <td>{{ $test->tester_name }}</td>

                                            {{-- Test date formatted --}}
                                            <td style="white-space:nowrap;">
                                                {{ date('d M Y',
                                                   strtotime($test->test_date)) }}
                                            </td>

                                            {{-- Short remarks preview --}}
                                            <td>
                                                <div class="remarks-preview"
                                                     title="{{ $test->remarks }}">
                                                    {{ $test->remarks }}
                                                </div>
                                            </td>

                                            {{-- Result badge --}}
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

                                            {{-- Action buttons --}}
                                            <td>
                                                <div class="action-btns">

                                                    {{-- Delete button with confirm --}}
                                                    <form
                                                        action="{{ route('tests.destroy', $test->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this test record?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn-delete">
                                                            <i class="ti ti-trash"></i>
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

                        {{-- Pagination links --}}
                        @if($tests->hasPages())
                            <div class="pagination-wrap">
                                {{ $tests->links() }}
                            </div>
                        @endif

                    @else

                        {{-- No results found state --}}
                        <div class="empty-state">
                            <i class="ti ti-search-off"></i>
                            <h3>No Records Found</h3>
                            <p>
                                No test records match your search filters.
                                <br>Try different keywords or clear filters.
                            </p>
                            <a href="{{ route('tests.search') }}"
                               style="color:#534AB7;
                                      font-weight:600;
                                      font-size:14px;">
                                <i class="ti ti-refresh"></i>
                                Clear All Filters
                            </a>
                        </div>

                    @endif

                </div>
                {{-- end results-card --}}

            @else

                {{-- Show before any search --}}
                <div class="results-card">
                    <div class="no-search-state">
                        <i class="ti ti-search"></i>
                        <h3>Search Test Records</h3>
                        <p>
                            Use the filters above to search for
                            specific test records by Product ID,
                            Test ID, type, result, or date range.
                        </p>
                    </div>
                </div>

            @endif
            {{-- end if searched --}}

        </div>
        {{-- end search-page --}}
    </div>
    {{-- end main-content --}}

</div>
{{-- end sidebar-layout --}}

@endsection

@push('scripts')
<script>

    // ==========================================
    // AUTO SUBMIT on select change
    // When user changes a dropdown
    // form submits automatically
    // ==========================================
    document.querySelectorAll('select[name="test_type"],
                               select[name="result"]')
    .forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    });

</script>
@endpush