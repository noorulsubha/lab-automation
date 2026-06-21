{{-- ============================================
     HOME PAGE - Page 1
     Location: resources/views/home.blade.php
     Purpose: Main landing page
     Extends: layouts/app.blade.php
     Data from: HomeController@index
     ============================================ --}}

@extends('layouts.app')

@section('title', 'Home — SRS Lab Automation')

@push('styles')
<style>

    /* ==========================================
       HERO SECTION
       Main banner at top of home page
    ========================================== */
    .hero {
        background: #F1EFE8;
        padding: 50px 40px;
        display: flex;
        gap: 40px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Left side text */
    .hero-text {
        flex: 1;
        min-width: 280px;
    }

    .hero-text h1 {
        font-size: 32px;
        font-weight: 700;
        color: #26215C;
        line-height: 1.35;
        margin-bottom: 14px;
    }

    .hero-text p {
        font-size: 15px;
        color: #888780;
        line-height: 1.8;
        margin-bottom: 26px;
        max-width: 460px;
    }

    /* Button row */
    .hero-btns {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* ==========================================
       HERO IMAGE
       📸 IMAGE: public/images/hero-lab.jpg
       Size: 600x400px recommended
    ========================================== */
    .hero-img-box {
        width: 700px;
        height: 300px;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 8px 32px rgba(83,74,183,0.15);
        flex-shrink: 0;
    }

    .hero-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    /* ==========================================
       STATS BAR - 4 numbers below hero
    ========================================== */
    .stats-bar {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: white;
        border-top: 1px solid rgba(0,0,0,0.07);
        border-bottom: 1px solid rgba(0,0,0,0.07);
    }

    .stat-item {
        padding: 28px 16px;
        text-align: center;
        border-right: 1px solid rgba(0,0,0,0.07);
    }

    .stat-item:last-child { border-right: none; }

    .stat-item .num {
        font-size: 30px;
        font-weight: 700;
        color: #534AB7;
    }

    .stat-item .lbl {
        font-size: 12px;
        color: #888780;
        margin-top: 5px;
        font-weight: 500;
    }

    /* ==========================================
       SECTIONS - Common styles
    ========================================== */
    .section { padding: 48px 40px; }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #26215C;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ==========================================
       FEATURES CARDS
    ========================================== */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 18px;
    }

    .feat-card {
        background: white;
        border: 1px solid rgba(0,0,0,0.07);
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .feat-card:hover {
        box-shadow: 0 6px 24px rgba(83,74,183,0.14);
        transform: translateY(-3px);
    }

    /* Colored icon circle */
    .feat-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 26px;
    }

    .feat-icon.purple { background: #EEEDFE; color: #534AB7; }
    .feat-icon.green  { background: #EAF3DE; color: #27500A; }
    .feat-icon.blue   { background: #E3F2FD; color: #1565C0; }
    .feat-icon.orange { background: #FAEEDA; color: #633806; }
    .feat-icon.red    { background: #FCEBEB; color: #791F1F; }
    .feat-icon.teal   { background: #E0F7F4; color: #006B5E; }

    .feat-card h3 {
        font-size: 15px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 8px;
    }

    .feat-card p {
        font-size: 13px;
        color: #888780;
        line-height: 1.65;
    }

    /* ==========================================
       PRODUCTS SECTION
    ========================================== */
    .products-section {
        background: #F1EFE8;
        padding: 48px 40px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 18px;
    }

    .product-card {
        background: white;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.07);
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .product-card:hover {
        box-shadow: 0 6px 20px rgba(83,74,183,0.12);
        transform: translateY(-3px);
    }

    /* ==========================================
       PRODUCT IMAGES
       Fixed height - all same size
       📸 public/images/switchgear.jpg 400x250px
       📸 public/images/fuse.jpg       400x250px
       📸 public/images/capacitor.jpg  400x250px
       📸 public/images/resistor.jpg   400x250px
    ========================================== */
    .product-img-wrap {
        width: 100%;
        height: 160px;
        overflow: hidden;
        position: relative;
    }

    .product-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.3s;
    }

    /* Zoom effect on hover */
    .product-card:hover .product-img-wrap img {
        transform: scale(1.05);
    }

    /* Dark gradient overlay on image bottom */
    .product-img-wrap::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(
            to top,
            rgba(38,33,92,0.25),
            transparent
        );
        pointer-events: none;
    }

    /* Product info below image */
    .product-info {
        padding: 14px 16px;
        border-top: 1px solid rgba(0,0,0,0.06);
    }

    .product-info h3 {
        font-size: 14px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 3px;
    }

    .product-info p {
        font-size: 12px;
        color: #888780;
        margin-bottom: 6px;
    }

    /* Color tag on product card */
    .product-tag {
        display: inline-block;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .tag-purple { background: #EEEDFE; color: #534AB7; }
    .tag-green  { background: #EAF3DE; color: #27500A; }
    .tag-blue   { background: #E3F2FD; color: #1565C0; }
    .tag-orange { background: #FAEEDA; color: #633806; }

    /* ==========================================
       HOW IT WORKS SECTION
    ========================================== */
    .steps-section {
        background: white;
        padding: 48px 40px;
    }

    .steps-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0;
        position: relative;
    }

    .step-item {
        text-align: center;
        padding: 20px 16px;
        position: relative;
    }

    /* Arrow between steps */
    .step-item:not(:last-child)::after {
        content: '→';
        position: absolute;
        right: -6px;
        top: 26px;
        font-size: 22px;
        color: #AFA9EC;
        font-weight: 700;
    }

    /* Step number purple circle */
    .step-num {
        width: 50px;
        height: 50px;
        background: #534AB7;
        color: white;
        border-radius: 50%;
        font-size: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        box-shadow: 0 4px 14px rgba(83,74,183,0.30);
    }

    .step-item h3 {
        font-size: 14px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 8px;
    }

    .step-item p {
        font-size: 12px;
        color: #888780;
        line-height: 1.6;
    }

    /* ==========================================
       RESPONSIVE STYLES
    ========================================== */

    /* Tablet max 1024px */
    @media (max-width: 1024px) {

        .hero { padding: 40px 28px; }

        .hero-img-box {
            width: 260px;
            height: 180px;
        }

        .stats-bar {
            grid-template-columns: repeat(2, 1fr);
        }

        .stat-item:nth-child(2) { border-right: none; }
        .stat-item:nth-child(3),
        .stat-item:nth-child(4) {
            border-top: 1px solid rgba(0,0,0,0.07);
        }

        .steps-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .step-item:nth-child(2)::after { display: none; }
    }

    /* Mobile max 768px */
    @media (max-width: 768px) {

        /* Hero stacks on mobile */
        .hero {
            flex-direction: column;
            padding: 28px 20px;
            gap: 24px;
        }

        .hero-text h1 { font-size: 24px; }

        /* Hero image full width on mobile */
        .hero-img-box {
            width: 100%;
            height: 200px;
        }

        /* Buttons full width */
        .hero-btns { flex-direction: column; }
        .hero-btns a { width: 100%; justify-content: center; }

        /* Stats 2x2 */
        .stats-bar {
            grid-template-columns: repeat(2, 1fr);
        }

        /* Sections smaller padding */
        .section,
        .products-section,
        .steps-section {
            padding: 28px 20px;
        }

        /* 2 columns on mobile */
        .cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        /* Steps hide arrows */
        .step-item::after { display: none; }

        .steps-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Small mobile max 480px */
    @media (max-width: 480px) {

        .hero-text h1 { font-size: 20px; }

        .cards-grid    { grid-template-columns: 1fr; }
        .products-grid { grid-template-columns: 1fr; }
        .steps-grid    { grid-template-columns: 1fr; }
    }

</style>
@endpush

@section('content')

{{-- ==========================================
     1. HERO SECTION
========================================== --}}
<section class="hero">

    {{-- Left: Text + Buttons --}}
    <div class="hero-text">
        <h1>
            Smart Lab Testing<br>
            Management System
        </h1>
        <p>
            Track, manage and automate your electrical
            product testing process. No more paper records
            — everything stored digitally with auto-generated
            unique Test IDs.
        </p>
        <div class="hero-btns">
          {{-- CHANGED: Login removed → Learn More added --}}
            <a href="{{ route('about') }}"
               class="btn-primary">
                <i class="ti ti-info-circle"></i>
                Learn More
            </a>
            {{-- About page link --}}
            <a href="{{ route('about') }}"
               class="btn-secondary">
                <i class="ti ti-info-circle"></i>
                About Us
            </a>
        </div>
    </div>

    {{-- Right: Hero Image --}}
    {{-- 📸 IMAGE: public/images/hero-lab.jpg Size: 600x400px --}}
    <div class="hero-img-box">
        <img src="{{ asset('images/hero-lab.jpg') }}"
             alt="Lab Testing Facility">
    </div>

</section>

{{-- ==========================================
     2. STATS BAR
     Data from HomeController@index $stats
========================================== --}}
<div class="stats-bar">

    <div class="stat-item">
        <div class="num">{{ $stats['total_tested'] }}+</div>
        <div class="lbl">Products Tested</div>
    </div>

    <div class="stat-item">
        <div class="num">{{ $stats['test_types'] }}</div>
        <div class="lbl">Test Types</div>
    </div>

    <div class="stat-item">
        <div class="num">{{ $stats['pass_rate'] }}%</div>
        <div class="lbl">Pass Rate</div>
    </div>

    <div class="stat-item">
        <div class="num">CPRI</div>
        <div class="lbl">Approved System</div>
    </div>

</div>

{{-- ==========================================
     3. FEATURES SECTION
========================================== --}}
<section class="section" id="features">

    <div class="section-title">
        <i class="ti ti-star" style="color:#534AB7;"></i>
        Main Features
    </div>

    <div class="cards-grid">

        <div class="feat-card">
            <div class="feat-icon purple">
                <i class="ti ti-id-badge"></i>
            </div>
            <h3>Auto Test ID</h3>
            <p>12-digit unique test ID automatically generated for every record</p>
        </div>

        <div class="feat-card">
            <div class="feat-icon green">
                <i class="ti ti-search"></i>
            </div>
            <h3>Search System</h3>
            <p>Find any record instantly by Product ID, Test ID or date range</p>
        </div>

        <div class="feat-card">
            <div class="feat-icon blue">
                <i class="ti ti-chart-bar"></i>
            </div>
            <h3>Status Tracking</h3>
            <p>Real-time Pass, Fail or Pending status for every product test</p>
        </div>

        <div class="feat-card">
            <div class="feat-icon orange">
                <i class="ti ti-file-report"></i>
            </div>
            <h3>Reports</h3>
            <p>Detailed test reports ready for CPRI submission and approval</p>
        </div>

        <div class="feat-card">
            <div class="feat-icon teal">
                <i class="ti ti-certificate"></i>
            </div>
            <h3>CPRI Ready</h3>
            <p>Export reports in format accepted by CPRI for product approval</p>
        </div>

        <div class="feat-card">
            <div class="feat-icon red">
                <i class="ti ti-users"></i>
            </div>
            <h3>Multi User</h3>
            <p>Separate access levels for Technician, Manager and Admin</p>
        </div>

    </div>

</section>

{{-- ==========================================
     4. PRODUCTS WE TEST
========================================== --}}
<section class="products-section">

    <div class="section-title">
        <i class="ti ti-bolt" style="color:#534AB7;"></i>
        Products We Test
    </div>

    <div class="products-grid">

        {{-- 📸 IMAGE: public/images/switchgear.jpg --}}
        <div class="product-card">
            <div class="product-img-wrap">
                <img src="{{ asset('images/switchgear.jpg') }}"
                     alt="Switch Gear">
            </div>
            <div class="product-info">
                <h3>Switch Gears</h3>
                <p>Electrical switching equipment</p>
                <span class="product-tag tag-purple">High Voltage</span>
            </div>
        </div>

        {{-- 📸 IMAGE: public/images/fuse.jpg --}}
        <div class="product-card">
            <div class="product-img-wrap">
                <img src="{{ asset('images/fuse.jpg') }}"
                     alt="Fuse">
            </div>
            <div class="product-info">
                <h3>Fuses</h3>
                <p>Circuit protection devices</p>
                <span class="product-tag tag-green">Protection</span>
            </div>
        </div>

        {{-- 📸 IMAGE: public/images/capacitor.jpg --}}
        <div class="product-card">
            <div class="product-img-wrap">
                <img src="{{ asset('images/capacitor.jpg') }}"
                     alt="Capacitor">
            </div>
            <div class="product-info">
                <h3>Capacitors</h3>
                <p>Energy storage components</p>
                <span class="product-tag tag-blue">Storage</span>
            </div>
        </div>

        {{-- 📸 IMAGE: public/images/resistor.jpg --}}
        <div class="product-card">
            <div class="product-img-wrap">
                <img src="{{ asset('images/resistor.jpg') }}"
                     alt="Resistor">
            </div>
            <div class="product-info">
                <h3>Resistors</h3>
                <p>Current limiting components</p>
                <span class="product-tag tag-orange">Control</span>
            </div>
        </div>

    </div>

</section>

{{-- ==========================================
     5. HOW IT WORKS
========================================== --}}
<section class="steps-section">

    <div class="section-title">
        <i class="ti ti-list-check" style="color:#534AB7;"></i>
        How It Works
    </div>

    <div class="steps-grid">

        <div class="step-item">
            <div class="step-num">1</div>
            <h3>Product Manufactured</h3>
            <p>SRS Electrical manufactures product and assigns unique 10-digit Product ID</p>
        </div>

        <div class="step-item">
            <div class="step-num">2</div>
            <h3>Lab Testing</h3>
            <p>Testing department runs different tests and records all results digitally</p>
        </div>

        <div class="step-item">
            <div class="step-num">3</div>
            <h3>Result Check</h3>
            <p>Pass → Send to CPRI. Fail → Send back to manufacturing for rework</p>
        </div>

        <div class="step-item">
            <div class="step-num">4</div>
            <h3>CPRI Approval</h3>
            <p>CPRI gives final approval and product is released to the market</p>
        </div>

    </div>

</section>

@endsection