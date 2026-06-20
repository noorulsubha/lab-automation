{{-- ============================================
    HOME PAGE
    File: resources/views/home.blade.php
    Purpose: Main landing page of Lab Automation System
    Layout: layouts/app.blade.php
============================================ --}}

@extends('layouts.app')

@section('title', 'Home — SRS Lab Automation')

{{-- ============================================
    PAGE STYLES (Only for Home Page)
============================================ --}}
@push('styles')
<style>

/* ================= HERO SECTION ================= */
.hero {
    background: #F1EFE8;
    padding: 60px 32px;
    display: flex;
    gap: 48px;
    align-items: center;
}

/* Left side text content */
.hero-text {
    flex: 1;
}

.hero-text h1 {
    font-size: 34px;
    font-weight: 700;
    color: #26215C;
    margin-bottom: 16px;
    line-height: 1.35;
}

.hero-text p {
    font-size: 15px;
    color: #888780;
    line-height: 1.8;
    margin-bottom: 24px;
    max-width: 480px;
}

/* Buttons section */
.hero-btns {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
}

/* ================= HERO IMAGE ================= */
.hero-img-box {
    width: 300px;
    height: 220px;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.1);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.hero-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ================= STATS SECTION ================= */
.stats-bar {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    background: #fff;
    border-top: 1px solid rgba(0,0,0,0.08);
    border-bottom: 1px solid rgba(0,0,0,0.08);
}

.stat-item {
    padding: 28px 16px;
    text-align: center;
    border-right: 1px solid rgba(0,0,0,0.08);
}

.stat-item:last-child {
    border-right: none;
}

.stat-item .num {
    font-size: 30px;
    font-weight: 700;
    color: #534AB7;
}

.stat-item .lbl {
    font-size: 12px;
    color: #888780;
    margin-top: 5px;
}

/* ================= SECTION BASE STYLE ================= */
.section {
    padding: 48px 32px;
}

.section-title {
    font-size: 22px;
    font-weight: 700;
    color: #26215C;
    margin-bottom: 28px;
}

/* ================= GRID CARDS ================= */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 18px;
}

/* Feature card */
.feat-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 14px;
    padding: 24px;
    text-align: center;
}

/* ================= PRODUCTS SECTION ================= */
.products-section {
    background: #F1EFE8;
    padding: 48px 32px;
}

/* Product card */
.product-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.08);
    text-align: center;
}

.product-card img {
    width: 100%;
    height: 130px;
    object-fit: cover;
}

.product-card .prod-name {
    padding: 14px;
    font-size: 14px;
    font-weight: 600;
    color: #26215C;
}

.product-card .prod-sub {
    font-size: 12px;
    color: #888780;
    padding-bottom: 14px;
}

</style>
@endpush

{{-- ============================================
    PAGE CONTENT START
============================================ --}}
@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="hero">

    {{-- Left content --}}
    <div class="hero-text">
        <h1>Smart Lab Testing<br>Management System</h1>

        <p>
            This system helps manage electrical product testing,
            automate records, and generate unique Test IDs digitally.
        </p>

        <div class="hero-btns">
            <a href="{{ route('login') }}" class="btn-primary">
                Login
            </a>

            <a href="#features" class="btn-secondary">
                Learn More
            </a>
        </div>
    </div>

    {{-- Right image --}}
    <div class="hero-img-box">
        <img src="{{ asset('images/hero-lab.jpg') }}" alt="Lab Image">
    </div>

</section>

{{-- ================= STATS SECTION ================= --}}
<div class="stats-bar">

    <div class="stat-item">
        <div class="num">{{ $stats['total_tested'] ?? 0 }}</div>
        <div class="lbl">Products Tested</div>
    </div>

    <div class="stat-item">
        <div class="num">{{ $stats['test_types'] ?? 0 }}</div>
        <div class="lbl">Test Types</div>
    </div>

    <div class="stat-item">
        <div class="num">{{ $stats['pass_rate'] ?? 0 }}%</div>
        <div class="lbl">Pass Rate</div>
    </div>

    <div class="stat-item">
        <div class="num">CPRI</div>
        <div class="lbl">Approved System</div>
    </div>

</div>

{{-- ================= FEATURES ================= --}}
<section class="section" id="features">

    <div class="section-title">Main Features</div>

    <div class="cards-grid">

        <div class="feat-card">Auto Test ID</div>
        <div class="feat-card">Search System</div>
        <div class="feat-card">Status Tracking</div>
        <div class="feat-card">Reports</div>

    </div>

</section>

{{-- ================= PRODUCTS ================= --}}
<section class="products-section">

    <div class="section-title">Products We Test</div>

    <div class="cards-grid">

        <div class="product-card">
            <img src="{{ asset('images/switchgear.jpg') }}" alt="Switch Gear">
            <div class="prod-name">Switch Gear</div>
        </div>

    </div>

</section>

@endsection