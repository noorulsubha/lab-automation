{{-- ========================================================= --}}
{{-- TEST SUMMARY CARDS                                        --}}
{{-- File: resources/views/tests/partials/summary.blade.php     --}}
{{-- Purpose: Display summary statistics for all test records   --}}
{{-- ========================================================= --}}

<div class="summary-row">

    {{-- ================= TOTAL TESTS CARD ================= --}}
    <div class="summary-card">

        <div class="sum-icon purple">
            <i class="ti ti-report-analytics"></i>
        </div>

        <div class="summary-content">

            <h2>{{ $totalTests }}</h2>

            <p>Total Tests</p>

        </div>

    </div>

    {{-- ================= PASSED TESTS CARD ================= --}}
    <div class="summary-card">

        <div class="sum-icon green">
            <i class="ti ti-circle-check"></i>
        </div>

        <div class="summary-content">

            <h2>{{ $passedTests }}</h2>

            <p>Passed Tests</p>

        </div>

    </div>

    {{-- ================= FAILED TESTS CARD ================= --}}
    <div class="summary-card">

        <div class="sum-icon red">
            <i class="ti ti-circle-x"></i>
        </div>

        <div class="summary-content">

            <h2>{{ $failedTests }}</h2>

            <p>Failed Tests</p>

        </div>

    </div>

    {{-- ================= PENDING TESTS CARD ================= --}}
    <div class="summary-card">

        <div class="sum-icon orange">
            <i class="ti ti-clock-hour-4"></i>
        </div>

        <div class="summary-content">

            <h2>{{ $pendingTests }}</h2>

            <p>Pending Tests</p>

        </div>

    </div>

</div>