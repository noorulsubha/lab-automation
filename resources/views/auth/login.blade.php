{{-- ============================================
     LOGIN PAGE — Page 2
     Location: resources/views/auth/login.blade.php
     Task: User login form
     Extends: layouts/app.blade.php
     ============================================ --}}

@extends('layouts.app')

@section('title', 'Login — SRS Lab Automation')

{{-- Extra CSS for login page --}}
@push('styles')
<style>

    /* ==========================================
        LOGIN PAGE WRAPPER
        Pure page cream background
    ========================================== */
    .login-page {
        min-height: calc(100vh - 160px);
        background: #F1EFE8;        /* Cream background */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    /* ==========================================
        LOGIN BOX — Centered white card
    ========================================== */
    .login-box {
        display: flex;
        gap: 0;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(83,74,183,0.18);
        width: 100%;
        max-width: 860px;
    }

    /* ==========================================
        LEFT SIDE — Purple background with image
    ========================================== */
    .login-left {
        flex: 1;
        background: linear-gradient(160deg, #26215C 0%, #534AB7 100%);
        padding: 48px 36px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* ==========================================
        LOGIN LEFT IMAGE
        📸 IMAGE 7: public/images/login-lab.jpg
        Size: 500x600 px recommended
        Professional lab or factory photo
    ========================================== */
    .login-left-img {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.18;      /* Faint visibility in background */
    }

    /* Left side text — overlaid on image */
    .login-left-content {
        position: relative;
        z-index: 1;
    }

    .login-left h2 {
        font-size: 26px;
        font-weight: 700;
        color: white;
        margin-bottom: 14px;
        line-height: 1.35;
    }

    .login-left p {
        font-size: 14px;
        color: #CECBF6;
        line-height: 1.8;
        margin-bottom: 28px;
    }

    /* Feature list on left side */
    .login-features {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .login-features li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #CECBF6;
    }

    .login-features li i {
        font-size: 18px;
        color: #AFA9EC;
    }

    /* ==========================================
        RIGHT SIDE — Login Form
    ========================================== */
    .login-right {
        flex: 1;
        padding: 48px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Logo at top of form */
    .login-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 32px;
    }

    .login-logo-icon {
        width: 40px;
        height: 40px;
        background: #EEEDFE;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* 📸 IMAGE 1: public/images/logo.png (same logo) */
    .login-logo-icon img {
        width: 32px;
        height: 32px;
        object-fit: contain;
    }

    .login-logo-text h3 {
        font-size: 16px;
        font-weight: 700;
        color: #26215C;
    }

    .login-logo-text p {
        font-size: 11px;
        color: #888780;
    }

    /* Heading */
    .login-right h2 {
        font-size: 22px;
        font-weight: 700;
        color: #26215C;
        margin-bottom: 6px;
    }

    .login-right .subtitle {
        font-size: 13px;
        color: #888780;
        margin-bottom: 28px;
    }

    /* ==========================================
        FORM ELEMENTS
    ========================================== */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #26215C;
        margin-bottom: 7px;
    }

    /* Input fields */
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 11px 14px;
        font-size: 14px;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 9px;
        background: #FAFAFA;
        color: #2C2C2A;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }

    /* Focus state */
    .form-group input:focus,
    .form-group select:focus {
        border-color: #534AB7;
        box-shadow: 0 0 0 3px rgba(83,74,183,0.12);
        background: white;
    }

    /* Input with icon */
    .input-wrap {
        position: relative;
    }

    .input-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 17px;
        color: #888780;
    }

    .input-wrap input {
        padding-left: 38px;     /* Space for icon */
    }

    /* Submit button */
    .btn-login {
        width: 100%;
        padding: 13px;
        background: #534AB7;
        color: white;
        border: none;
        border-radius: 9px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 6px;
        transition: background 0.2s;
    }

    .btn-login:hover {
        background: #3C3489;
    }

    /* ==========================================
        ALERTS — Error and Success messages
    ========================================== */

    /* Error alert — red */
    .alert-error {
        background: #FCEBEB;
        border: 1px solid #F5C6C6;
        border-radius: 9px;
        padding: 12px 16px;
        font-size: 13px;
        color: #791F1F;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Success alert — green */
    .alert-success {
        background: #EAF3DE;
        border: 1px solid #C3E0A0;
        border-radius: 9px;
        padding: 12px 16px;
        font-size: 13px;
        color: #27500A;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Validation error — under input */
    .field-error {
        font-size: 12px;
        color: #C0392B;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* ==========================================
        TEST CREDENTIALS BOX
        For development assistance
    ========================================== */
    .test-creds {
        background: #EEEDFE;
        border-radius: 9px;
        padding: 14px;
        margin-top: 20px;
        font-size: 12px;
        color: #3C3489;
    }

    .test-creds strong {
        display: block;
        margin-bottom: 6px;
        color: #26215C;
    }

    .test-creds span {
        display: block;
        line-height: 1.9;
    }

</style>
@endpush

@section('content')

{{-- ==========================================
     LOGIN PAGE WRAPPER
========================================== --}}
<div class="login-page">
    <div class="login-box">

        {{-- ======================================
             LEFT SIDE — Purple with info
        ====================================== --}}
        <div class="login-left">

            {{-- 📸 IMAGE 7: public/images/login-lab.jpg
                 Faintly visible in the background --}}
            <img src="{{ asset('images/login-lab.jpg') }}"
                 alt="Lab"
                 class="login-left-img">

            {{-- Content over image --}}
            <div class="login-left-content">
                <h2>
                    SRS Lab<br>
                    Automation<br>
                    System
                </h2>
                <p>
                    A complete digital solution for electrical 
                    product testing. All records in one place.
                </p>

                {{-- Feature list --}}
                <ul class="login-features">
                    <li>
                        <i class="ti ti-id-badge"></i>
                        Auto 12-digit Test ID generation
                    </li>
                    <li>
                        <i class="ti ti-search"></i>
                        Advanced product search
                    </li>
                    <li>
                        <i class="ti ti-chart-bar"></i>
                        Real-time status tracking
                    </li>
                    <li>
                        <i class="ti ti-certificate"></i>
                        CPRI approved process
                    </li>
                    <li>
                        <i class="ti ti-shield-check"></i>
                        Secure multi-user access
                    </li>
                </ul>
            </div>
        </div>

        {{-- ======================================
             RIGHT SIDE — Login Form
        ====================================== --}}
        <div class="login-right">

            {{-- Mini logo at top --}}
            <div class="login-logo">
                <div class="login-logo-icon">
                    {{-- 📸 IMAGE 1: public/images/logo.png --}}
                    <img src="{{ asset('images/logo.png') }}"
                         alt="Logo">
                </div>
                <div class="login-logo-text">
                    <h3>SRS LabAuto</h3>
                    <p>Lab Automation System</p>
                </div>
            </div>

            <h2>Welcome Back</h2>
            <p class="subtitle">
                Please enter your username and password
            </p>

            {{-- ======================================
                 ERROR MESSAGE
                 Sent from AuthController
            ====================================== --}}
            @if(session('error'))
                <div class="alert-error">
                    <i class="ti ti-alert-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert-success">
                    <i class="ti ti-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ======================================
                 LOGIN FORM
                 POST /login → AuthController@login
            ====================================== --}}
            <form action="{{ route('login.submit') }}"
                  method="POST">

                {{-- CSRF Token — Essential for Laravel security --}}
                @csrf

                {{-- USERNAME FIELD --}}
                <div class="form-group">
                    <label for="username">
                        <i class="ti ti-user"></i> Username
                    </label>
                    <div class="input-wrap">
                        <i class="ti ti-user"></i>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Enter your username"
                            value="{{ old('username') }}"
                            autocomplete="username">
                    </div>
                    {{-- Validation error --}}
                    @error('username')
                        <div class="field-error">
                            <i class="ti ti-alert-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- PASSWORD FIELD --}}
                <div class="form-group">
                    <label for="password">
                        <i class="ti ti-lock"></i> Password
                    </label>
                    <div class="input-wrap">
                        <i class="ti ti-lock"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password">
                    </div>
                    {{-- Validation error --}}
                    @error('password')
                        <div class="field-error">
                            <i class="ti ti-alert-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- ROLE SELECT --}}
                <div class="form-group">
                    <label for="role">
                        <i class="ti ti-shield"></i> Login As
                    </label>
                    <select id="role" name="role">
                        <option value="technician">Lab Technician</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                {{-- LOGIN BUTTON --}}
                <button type="submit" class="btn-login">
                    <i class="ti ti-login"></i>
                    Login to System
                </button>

            </form>

            {{-- ======================================
                 TEST CREDENTIALS
                 Only visible in development mode
                 Automatically hidden in production
            ====================================== --}}
            @if(config('app.debug'))
                <div class="test-creds">
                    <strong>
                        <i class="ti ti-info-circle"></i>
                        Test Credentials:
                    </strong>
                    <span>Admin: admin / admin123</span>
                    <span>Manager: manager / manager123</span>
                    <span>Technician: technician / tech123</span>
                </div>
            @endif

        </div>
        {{-- end login-right --}}

    </div>
    {{-- end login-box --}}

</div>
{{-- end login-page --}}

@endsection