{{-- ============================================
     ABOUT PAGE
     Location: resources/views/about.blade.php
     Purpose: Information about SRS Lab Automation
     Extends: layouts/app.blade.php
     Data from: HomeController@about
     ============================================ --}}

@extends('layouts.app')

@section('title', 'About — SRS Lab Automation')

@push('styles')
<style>

    /* ==========================================
       ABOUT HERO BANNER
       Top purple gradient banner
    ========================================== */
    .about-hero {
        background: linear-gradient(135deg, #26215C 0%, #534AB7 100%);
        padding: 60px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* Background pattern dots */
    .about-hero::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -40px;
        width: 250px;
        height: 250px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .about-hero h1 {
        font-size: 36px;
        font-weight: 700;
        color: white;
        margin-bottom: 14px;
        position: relative;
        z-index: 1;
    }

    .about-hero p {
        font-size: 16px;
        color: #CECBF6;
        max-width: 580px;
        margin: 0 auto;
        line-height: 1.8;
        position: relative;
        z-index: 1;
    }

    /* ==========================================
       ABOUT SECTIONS - Common padding
    ========================================== */
    .about-section {
        padding: 56px 40px;
    }

    .about-section.cream {
        background: #F1EFE8;
    }

    .about-section.white {
        background: white;
    }

    /* Section heading */
    .about-heading {
        font-size: 24px;
        font-weight: 700;
        color: #26215C;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Section subtext */
    .about-sub {
        font-size: 15px;
        color: #888780;
        line-height: 1.8;
        margin-bottom: 32px;
        max-width: 680px;
    }

    /* ==========================================
       WHO WE ARE SECTION
       Text left - image right
    ========================================== */
    .who-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: center;
    }

    .who-text h2 {
        font-size: 26px;
        font-weight: 700;
        color: #26215C;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .who-text p {
        font-size: 14px;
        color: #888780;
        line-height: 1.9;
        margin-bottom: 14px;
    }

    /* Key points list */
    .who-points {
        list-style: none;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .who-points li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 14px;
        color: #2C2C2A;
    }

    .who-points li i {
        color: #534AB7;
        font-size: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ==========================================
       WHO WE ARE IMAGE
       📸 IMAGE: public/images/about-lab.jpg
       Size: 600x450px recommended
       Lab facility or team photo
    ========================================== */
    .who-img-box {
        width: 100%;
        height: 340px;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 8px 32px rgba(83,74,183,0.15);
    }

    .who-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    /* ==========================================
       ACHIEVEMENTS GRID
       6 stat cards
    ========================================== */
    .achieve-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .achieve-card {
        background: white;
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        border: 1px solid rgba(0,0,0,0.07);
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .achieve-card:hover {
        box-shadow: 0 6px 24px rgba(83,74,183,0.12);
        transform: translateY(-3px);
    }

    /* Big number */
    .achieve-num {
        font-size: 36px;
        font-weight: 700;
        color: #534AB7;
        line-height: 1;
        margin-bottom: 8px;
    }

    /* Label */
    .achieve-lbl {
        font-size: 13px;
        color: #888780;
        font-weight: 500;
    }

    /* ==========================================
       MISSION VISION SECTION
       2 cards side by side
    ========================================== */
    .mv-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
    }

    .mv-card {
        border-radius: 16px;
        padding: 32px 28px;
        border: 1px solid rgba(0,0,0,0.07);
    }

    /* Mission card - purple */
    .mv-card.mission {
        background: linear-gradient(135deg, #26215C, #534AB7);
    }

    .mv-card.mission h3 {
        color: white;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mv-card.mission p {
        color: #CECBF6;
        font-size: 14px;
        line-height: 1.8;
    }

    /* Vision card - cream */
    .mv-card.vision {
        background: #F1EFE8;
    }

    .mv-card.vision h3 {
        color: #26215C;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mv-card.vision p {
        color: #888780;
        font-size: 14px;
        line-height: 1.8;
    }

    /* Values list below mission/vision */
    .values-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .value-item {
        background: white;
        border-radius: 12px;
        padding: 20px 16px;
        text-align: center;
        border: 1px solid rgba(0,0,0,0.07);
    }

    .value-item i {
        font-size: 28px;
        color: #534AB7;
        display: block;
        margin-bottom: 10px;
    }

    .value-item h4 {
        font-size: 13px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 5px;
    }

    .value-item p {
        font-size: 12px;
        color: #888780;
        line-height: 1.6;
    }

    /* ==========================================
       TESTING PROCESS SECTION
       Detailed steps
    ========================================== */
    .process-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .process-item {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        background: white;
        border-radius: 12px;
        padding: 20px 24px;
        border: 1px solid rgba(0,0,0,0.07);
        transition: box-shadow 0.2s;
    }

    .process-item:hover {
        box-shadow: 0 4px 16px rgba(83,74,183,0.10);
    }

    /* Step number circle */
    .process-num {
        width: 44px;
        height: 44px;
        background: #534AB7;
        color: white;
        border-radius: 50%;
        font-size: 18px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .process-info h4 {
        font-size: 15px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 5px;
    }

    .process-info p {
        font-size: 13px;
        color: #888780;
        line-height: 1.7;
    }

    /* ==========================================
       TEAM SECTION
       Team member cards
    ========================================== */
    .team-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .team-card {
        background: white;
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        border: 1px solid rgba(0,0,0,0.07);
        transition: box-shadow 0.2s;
    }

    .team-card:hover {
        box-shadow: 0 6px 20px rgba(83,74,183,0.12);
    }

    /* ==========================================
       TEAM MEMBER AVATAR
       📸 IMAGE: public/images/team/
       team1.jpg, team2.jpg, team3.jpg
       Size: 200x200px recommended - square
    ========================================== */
    .team-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #EEEDFE;
        margin: 0 auto 14px;
        display: block;
    }

    /* Fallback avatar if no image */
    .team-avatar-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #EEEDFE;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        font-size: 32px;
        color: #534AB7;
    }

    .team-card h4 {
        font-size: 15px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 4px;
    }

    .team-card .role {
        font-size: 12px;
        color: #534AB7;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .team-card .email {
        font-size: 12px;
        color: #888780;
    }

    /* ==========================================
       CPRI SECTION
       Certification info
    ========================================== */
    .cpri-box {
        background: linear-gradient(135deg, #26215C, #534AB7);
        border-radius: 16px;
        padding: 40px;
        display: flex;
        gap: 32px;
        align-items: center;
        flex-wrap: wrap;
    }

    .cpri-icon {
        font-size: 64px;
        color: #CECBF6;
        flex-shrink: 0;
    }

    .cpri-text h3 {
        font-size: 22px;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
    }

    .cpri-text p {
        font-size: 14px;
        color: #CECBF6;
        line-height: 1.8;
        margin-bottom: 16px;
    }

    .cpri-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 20px;
        background: white;
        color: #534AB7;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }

    .cpri-link:hover {
        background: #EEEDFE;
    }

    /* ==========================================
       RESPONSIVE STYLES
    ========================================== */

    /* Tablet max 1024px */
    @media (max-width: 1024px) {

        .about-section { padding: 40px 28px; }
        .about-hero    { padding: 48px 28px; }

        .achieve-grid  { grid-template-columns: repeat(2, 1fr); }
        .values-grid   { grid-template-columns: repeat(2, 1fr); }
        .team-grid     { grid-template-columns: repeat(2, 1fr); }
    }

    /* Mobile max 768px */
    @media (max-width: 768px) {

        .about-hero { padding: 36px 20px; }
        .about-hero h1 { font-size: 26px; }

        .about-section { padding: 32px 20px; }

        /* Stack who we are section */
        .who-grid { grid-template-columns: 1fr; }
        .who-img-box { height: 220px; }

        /* 2 columns */
        .achieve-grid  { grid-template-columns: repeat(2, 1fr); }
        .values-grid   { grid-template-columns: repeat(2, 1fr); }
        .team-grid     { grid-template-columns: repeat(2, 1fr); }

        /* Stack mission vision */
        .mv-grid { grid-template-columns: 1fr; }
    }

    /* Small mobile max 480px */
    @media (max-width: 480px) {

        .about-hero h1 { font-size: 22px; }

        .achieve-grid { grid-template-columns: repeat(2, 1fr); }
        .values-grid  { grid-template-columns: 1fr 1fr; }
        .team-grid    { grid-template-columns: 1fr; }
    }

</style>
@endpush

@section('content')

{{-- ==========================================
     1. ABOUT HERO BANNER
========================================== --}}
<div class="about-hero">
    <h1>About SRS Lab Automation</h1>
    <p>
        We are a dedicated electrical product testing laboratory
        committed to quality, accuracy and CPRI-approved processes
        for over 15 years.
    </p>
</div>

{{-- ==========================================
     2. WHO WE ARE
========================================== --}}
<section class="about-section white">

    <div class="who-grid">

        {{-- Left: Text content --}}
        <div class="who-text">
            <h2>Who We Are</h2>
            <p>
                SRS Electrical Appliances is a leading manufacturer
                of electrical products including switch gears, fuses,
                capacitors, and resistors. Our in-house testing
                laboratory ensures every product meets the highest
                quality standards before reaching the market.
            </p>
            <p>
                Our Lab Automation System was built to replace
                manual paper-based record keeping with a modern
                digital solution that saves time, reduces errors,
                and provides real-time visibility into testing status.
            </p>

            <ul class="who-points">
                <li>
                    <i class="ti ti-circle-check"></i>
                    ISO certified testing procedures
                </li>
                <li>
                    <i class="ti ti-circle-check"></i>
                    CPRI approved lab and processes
                </li>
                <li>
                    <i class="ti ti-circle-check"></i>
                    Over 500 products tested successfully
                </li>
                <li>
                    <i class="ti ti-circle-check"></i>
                    Real-time digital record management
                </li>
                <li>
                    <i class="ti ti-circle-check"></i>
                    Multiple test types supported
                </li>
                <li>
                    <i class="ti ti-circle-check"></i>
                    Detailed remarks and reporting system
                </li>
            </ul>
        </div>

        {{-- Right: Lab image --}}
        {{-- 📸 IMAGE: public/images/lab.jpeg
             Size: 600x450px - Lab facility photo --}}
        <div class="who-img-box">
            <img src="{{ asset('images/lab.jpeg') }}"
                 alt="SRS Lab Facility">
        </div>

    </div>

</section>

{{-- ==========================================
     3. ACHIEVEMENTS - 6 stat cards
     Data from HomeController@about
========================================== --}}
<section class="about-section cream">

    <div class="about-heading">
        <i class="ti ti-trophy" style="color:#534AB7;"></i>
        Our Achievements
    </div>
    <p class="about-sub">
        Numbers that reflect our commitment to quality and excellence
        in electrical product testing.
    </p>

    <div class="achieve-grid">

        {{-- Loop through achievements array --}}
        @foreach($achievements as $item)
            <div class="achieve-card">
                <div class="achieve-num">{{ $item['num'] }}</div>
                <div class="achieve-lbl">{{ $item['label'] }}</div>
            </div>
        @endforeach

    </div>

</section>

{{-- ==========================================
     4. MISSION AND VISION
========================================== --}}
<section class="about-section white">

    <div class="about-heading">
        <i class="ti ti-target" style="color:#534AB7;"></i>
        Mission & Vision
    </div>

    <div class="mv-grid">

        {{-- Mission card - purple --}}
        <div class="mv-card mission">
            <h3>
                <i class="ti ti-rocket"></i>
                Our Mission
            </h3>
            <p>
                To provide the most accurate, reliable and efficient
                electrical product testing services. We aim to ensure
                every product that leaves our lab meets international
                quality standards and is fully ready for CPRI approval
                and market release.
            </p>
        </div>

        {{-- Vision card - cream --}}
        <div class="mv-card vision">
            <h3>
                <i class="ti ti-eye"></i>
                Our Vision
            </h3>
            <p>
                To become the most trusted and technologically
                advanced electrical product testing laboratory
                in the region. We envision a fully digital,
                paperless testing process that is fast, transparent
                and accessible to all stakeholders.
            </p>
        </div>

    </div>

    {{-- Core values --}}
    <div class="values-grid">

        <div class="value-item">
            <i class="ti ti-shield-check"></i>
            <h4>Quality</h4>
            <p>Every test done with highest accuracy and precision</p>
        </div>

        <div class="value-item">
            <i class="ti ti-clock"></i>
            <h4>Speed</h4>
            <p>Fast testing turnaround without compromising quality</p>
        </div>

        <div class="value-item">
            <i class="ti ti-eye"></i>
            <h4>Transparency</h4>
            <p>Clear and honest reporting of all test results</p>
        </div>

        <div class="value-item">
            <i class="ti ti-refresh"></i>
            <h4>Innovation</h4>
            <p>Always improving our processes and technology</p>
        </div>

    </div>

</section>

{{-- ==========================================
     5. TESTING PROCESS - Detailed steps
========================================== --}}
<section class="about-section cream">

    <div class="about-heading">
        <i class="ti ti-list-check" style="color:#534AB7;"></i>
        Our Testing Process
    </div>
    <p class="about-sub">
        A structured step-by-step process ensures every product
        is tested thoroughly before market release.
    </p>

    <div class="process-list">

        <div class="process-item">
            <div class="process-num">1</div>
            <div class="process-info">
                <h4>Product Receipt and Registration</h4>
                <p>
                    Manufactured product arrives at testing lab.
                    A unique 10-digit Product ID is assigned which
                    includes product code, revision number and
                    manufacturing number for tracking.
                </p>
            </div>
        </div>

        <div class="process-item">
            <div class="process-num">2</div>
            <div class="process-info">
                <h4>Test Type Assignment</h4>
                <p>
                    Based on the product type, appropriate tests
                    are assigned. Different products require different
                    combinations of electrical, load, thermal, safety
                    and mechanical tests.
                </p>
            </div>
        </div>

        <div class="process-item">
            <div class="process-num">3</div>
            <div class="process-info">
                <h4>Testing and Auto ID Generation</h4>
                <p>
                    Each test is conducted by certified technicians.
                    A unique 12-digit Test ID is automatically generated
                    including product code, revision, test code and roll
                    number. Detailed remarks are recorded for each test.
                </p>
            </div>
        </div>

        <div class="process-item">
            <div class="process-num">4</div>
            <div class="process-info">
                <h4>Result Recording</h4>
                <p>
                    Test results are recorded as Pass, Fail or Pending.
                    All test criteria, observed outputs, technician name
                    and date are stored digitally in the system for
                    complete traceability.
                </p>
            </div>
        </div>

        <div class="process-item">
            <div class="process-num">5</div>
            <div class="process-info">
                <h4>Pass or Fail Decision</h4>
                <p>
                    If product passes all tests it is sent to CPRI
                    for final government approval. If product fails
                    it is sent back to manufacturing department for
                    rework and then re-tested.
                </p>
            </div>
        </div>

        <div class="process-item">
            <div class="process-num">6</div>
            <div class="process-info">
                <h4>CPRI Approval and Market Release</h4>
                <p>
                    After CPRI approval the product gets government
                    certification and is officially released to the
                    market. All test records remain stored in the
                    system for future reference and audit.
                </p>
            </div>
        </div>

    </div>

</section>

{{-- ==========================================
     6. OUR TEAM
     Data from HomeController@about $team
========================================== --}}
<section class="about-section white">

    <div class="about-heading">
        <i class="ti ti-users" style="color:#534AB7;"></i>
        Our Team
    </div>
    <p class="about-sub">
        Experienced professionals dedicated to accurate
        and reliable electrical product testing.
    </p>

    <div class="team-grid">

        {{-- Loop through team array --}}
        @foreach($team as $index => $member)
            <div class="team-card">

                {{-- Team member avatar --}}
                {{-- 📸 IMAGE: public/images/team/team1.jpg etc --}}
                <div class="team-avatar-placeholder">
                    <i class="ti ti-user"></i>
                </div>

                <h4>{{ $member['name'] }}</h4>
                <div class="role">{{ $member['role'] }}</div>
                <div class="email">
                    <i class="ti ti-mail"
                       style="font-size:12px;"></i>
                    {{ $member['email'] }}
                </div>
            </div>
        @endforeach

    </div>

</section>

{{-- ==========================================
     7. CPRI CERTIFICATION BOX
========================================== --}}
<section class="about-section cream">

    <div class="cpri-box">

        <div class="cpri-icon">
            <i class="ti ti-certificate"></i>
        </div>

        <div class="cpri-text">
            <h3>CPRI Approved Testing Laboratory</h3>
            <p>
                Our laboratory is fully approved and recognized by the
                Central Power Research Institute (CPRI), the premier
                national laboratory for testing electrical equipment
                in Pakistan. All our test procedures meet CPRI standards
                and our test reports are accepted for product certification.
            </p>
            <a href="https://www.scribd.com/document/421086769/Research-and-Testing-Facilities-27-6-2016"
               target="_blank"
               class="cpri-link">
                <i class="ti ti-external-link"></i>
                Visit CPRI Website
            </a>
        </div>

    </div>

</section>

@endsection