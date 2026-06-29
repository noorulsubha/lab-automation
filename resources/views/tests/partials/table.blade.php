{{-- =========================================
    TEST RECORDS TABLE
    File: table.blade.php
    Purpose: Display all lab test records
========================================= --}}

<div class="table-card">

    {{-- ================= TABLE HEADER ================= --}}
    <div class="table-card-header">

        <div class="table-card-title">
            <i class="ti ti-list" style="color:#534AB7;"></i>
            Test Records

            {{-- Total Records Count --}}
            <span class="records-count">
                {{ $tests->total() }} Total
            </span>
        </div>

    </div>

    {{-- ================= CHECK IF DATA EXISTS ================= --}}
    @if($tests->count() > 0)

        {{-- Horizontal scroll for responsive table --}}
        <div class="table-scroll">

            <table class="data-table">

                {{-- ================= TABLE HEAD ================= --}}
                <thead>
                    <tr>
                        <th>#</th>
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

                {{-- ================= TABLE BODY ================= --}}
                <tbody>

                    {{-- Loop through all test records --}}
                    @foreach($tests as $index => $test)

                        <tr>

                            {{-- Row Number --}}
                            <td>
                                {{ $tests->firstItem() + $index }}
                            </td>

                            {{-- Product Image --}}
                            <td>
                                @if($test->product_image)

                                    {{-- Show uploaded product image --}}
                                    <img src="{{ asset($test->product_image) }}"
                                         alt="Product Image"
                                         style="width:45px;height:45px;object-fit:cover;border-radius:6px;">

                                @else

                                    {{-- Placeholder icon if no image --}}
                                    <i class="ti ti-photo" style="color:#AFA9EC;"></i>

                                @endif
                            </td>

                            {{-- Product ID --}}
                            <td>
                                <strong>{{ $test->product_id }}</strong>
                            </td>

                            {{-- Auto Generated Test ID --}}
                            <td>
                                <span class="badge badge-auto">
                                    {{ $test->test_id }}
                                </span>
                            </td>

                            {{-- Test Type --}}
                            <td>
                                {{ ucfirst($test->test_type) }}
                            </td>

                            {{-- Tester Name --}}
                            <td>
                                {{ $test->tester_name }}
                            </td>

                            {{-- Test Date --}}
                            <td style="white-space:nowrap;">

                                {{-- Calendar icon --}}
                                <i class="ti ti-calendar" style="color:#AFA9EC;"></i>

                                {{-- Formatted date --}}
                                {{ date('d M Y', strtotime($test->test_date)) }}

                            </td>

                            {{-- Remarks (with tooltip for long text) --}}
                            <td>
                                <div class="remarks-cell"
                                     title="{{ $test->remarks }}">
                                    {{ $test->remarks }}
                                </div>
                            </td>

                            {{-- Test Result with badge --}}
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

                            {{-- ================= ACTION BUTTONS ================= --}}
                            <td>

<div class="action-btns">
{{-- Print Button --}}

<a href="{{ route('tests.printSingle', $test->id) }}"
   target="_blank"
   class="btn-search-link">
    <i class="ti ti-printer"></i>
    Print
</a>

<!-- {{-- Edit Button --}}
<a href="{{ route('tests.edit', $test->id) }}"
class="btn-add">
<i class="ti ti-edit"></i>
 Edit
</a> -->

{{-- Delete Button --}}
   <form action="{{ route('tests.destroy', $test->id) }}"
    method="POST"
    onsubmit="return confirm('Delete this test record?')">
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

    {{-- ================= PAGINATION ================= --}}
    @if($tests->hasPages())

    <div class="pagination-wrap">

                {{-- Pagination info --}}
                <div class="pagination-info">
                    Showing {{ $tests->firstItem() }}
                    to {{ $tests->lastItem() }}
                    of {{ $tests->total() }} records
                </div>

                {{-- Laravel pagination links --}}
                {{ $tests->links() }}

            </div>

        @endif

    @else

        {{-- ================= EMPTY STATE ================= --}}
        <div class="empty-state">

            <i class="ti ti-database-off"></i>

            <h3>No Test Records Found</h3>

            <p>
                No records available yet.
                Please add your first test record.
            </p>

            <a href="{{ route('tests.create') }}"
               class="btn-add">
                <i class="ti ti-plus"></i>
                Add New Test
            </a>

        </div>

    @endif

</div>