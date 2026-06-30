@extends('layouts.app')

@section('title', 'All Test Records')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')

<div class="container">

    <!-- Page Header -->
    <div class="welcome-bar">
        <div>
            <h2>All Test Records</h2>
            <p>View and manage all laboratory test records.</p>
        </div>

        <a href="{{ route('tests.create') }}" class="quick-btn green">
            + Add New Test
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6>Total Tests</h6>
                <h2>{{ $totalTests }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6>Passed</h6>
                <h2>{{ $passedTests }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6>Failed</h6>
                <h2>{{ $failedTests }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h6>Pending</h6>
                <h2>{{ $pendingTests }}</h2>
            </div>
        </div>

    </div>

    <!-- Test Records Table -->

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Test Records</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                <tr>
                    <th>Test ID</th>
                    <th>Product ID</th>
                    <th>Test Type</th>
                    <th>Tester</th>
                    <th>Date</th>
                    <th>Result</th>
                    <th>Actions</th>
                </tr>

                </thead>

                <tbody>

                @forelse($tests as $test)

                    <tr>

                        <td>{{ $test->test_id }}</td>

                        <td>{{ $test->product_id }}</td>

                        <td>{{ ucfirst($test->test_type) }}</td>

                        <td>{{ $test->tester_name }}</td>

                        <td>{{ $test->test_date }}</td>

                        <td>{{ ucfirst($test->result) }}</td>

                        <td>

                            <a href="{{ route('tests.printSingle',$test->id) }}" class="btn btn-primary btn-sm">
                                Print
                            </a>

                            <form action="{{ route('tests.destroy',$test->id) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this record?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            No test records found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            {{ $tests->links() }}

        </div>

    </div>

</div>

@endsection