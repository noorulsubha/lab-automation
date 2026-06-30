
@extends('layouts.app')

@section('title', 'Dashboard - SRS Lab Automation')

{{-- =========================================
     Dashboard Page CSS
     Loads dashboard specific styles
========================================= --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush


@section('content')
<div class="container-fluid">

    <!-- 1. WELCOME BAR (Sab ke liye common, lekin role name ke sath) -->
    <div class="welcome-bar">
        <div>
            <h2>Welcome Back, {{ Auth::user()->name }}!</h2>
            <p>You are logged in as a <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>
        </div>
    </div>

    <!-- 2. QUICK ACTIONS (Role ke mutabiq badalna) -->
    <div class="quick-actions">
        {{-- Admin & Manager Actions --}}
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
            <a href="/users/create" class="quick-btn purple">
                <i class="fas fa-user-plus"></i> Add New User
            </a>
            <a href="/products/create" class="quick-btn orange">
                <i class="fas fa-plus"></i> Add New Product
            </a>
        @endif

        {{-- Admin & Technician Actions --}}
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'technician')
            <a href="/tests/create" class="quick-btn green">
                <i class="fas fa-flask"></i> Create New Test
            </a>
        @endif
    </div>

    <!-- 3. STATS CARDS SECTION -->
    <div class="row mb-4">
        {{-- Total Tests Card (Sab roles dekh sakte hain) --}}
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
                <small class="text-muted">Total Tests</small>
                <h3>{{ $totalTests ?? 0 }}</h3>
            </div>
        </div>

        {{-- Admin aur Manager ke liye exclusive cards --}}
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
            <div class="col-md-3">
                <div class="card p-3 shadow-sm border-0">
                    <small class="text-muted">Total Products</small>
                    <h3>{{ $totalProducts ?? 0 }}</h3>
                </div>
            </div>
        @endif
        
        {{-- Passed / Failed stats --}}
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 bg-success-light">
                <small class="text-success">Tests Passed</small>
                <h3>{{ $testsPassed ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 bg-danger-light">
                <small class="text-danger">Tests Failed</small>
                <h3>{{ $testsFailed ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- 4. CHARTS & RECENT TABLES SECTION -->
    <div class="row">
        {{-- Admin aur Manager ko Charts aur Poori list dikhegi --}}
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
            <div class="col-md-6 mb-4">
                <!-- Aapka Test Results Chart yahan aayega -->
                <div class="card p-4 shadow-sm border-0">
                    <h5>Test Results Overview</h5>
                    <!-- Chart Code -->
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <!-- Aapka Monthly Tests Chart yahan aayega -->
                <div class="card p-4 shadow-sm border-0">
                    <h5>Monthly Tests — 2026</h5>
                    <!-- Chart Code -->
                </div>
            </div>
        @endif

        {{-- Recent Tests Table --}}
        <div class="col-md-12">
            <div class="card p-4 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>
                        @if(Auth::user()->role == 'technician')
                            My Recent Tests (Technician View)
                        @else
                            All Recent Tests (Admin/Manager View)
                        @endif
                    </h5>
                    <a href="/tests" class="btn btn-primary btn-sm rounded-pill px-3">View All Records</a>
                </div>

                {{-- Table Design --}}
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Test ID</th>
                                <th>Test Type</th>
                                <th>Tester Name</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Controller se data pass kar ke loop chalayen --}}
                            @forelse($recentTests as $test)
                                <tr>
                                    <td>{{ $test->product_id }}</td>
                                    <td>{{ $test->test_id }}</td>
                                    <td>{{ $test->type }}</td>
                                    <td>{{ $test->tester_name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $test->result == 'Passed' ? 'success' : 'danger' }}">
                                            {{ $test->result }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted mb-1">No test records found yet.</p>
                                        @if(Auth::user()->role == 'technician' || Auth::user()->role == 'admin')
                                            <a href="/tests/create">Add your first test record</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection