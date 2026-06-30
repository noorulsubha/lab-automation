@extends('layouts.app')

@section('title', 'Login - SRS Lab Automation')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="login-page">
    <div class="login-box">
        
        <div class="login-banner">
            <div class="banner-content">
                <h1>SRS Lab<br>Automation<br>System</h1>
                <p class="subtitle">A complete digital solution for electrical product testing. All records in one place.</p>
                
                <ul class="features-list">
                    <li><i class="fa-solid fa-calculator"></i> Auto 12-digit Test ID generation</li>
                    <li><i class="fa-solid fa-magnifying-glass"></i> Advanced product search</li>
                    <li><i class="fa-solid fa-chart-line"></i> Real-time status tracking</li>
                    <li><i class="fa-solid fa-square-check"></i> CPRI approved process</li>
                    <li><i class="fa-solid fa-shield-halved"></i> Secure multi-user access</li>
                </ul>
            </div>
        </div>

        <div class="login-form-container">
            
            <div class="logo-area">
                <div class="logo-box">SRS</div>
                <div>
                    <h2>SRS LabAuto</h2>
                    <p>Lab Automation System</p>
                </div>
            </div>

            <div class="login-form-header">
                <h2 class="login-form-title">Welcome Login Page</h2>
                <p style="color: #757575; font-size: 14px; margin: 0;">Please enter your username and password</p>
            </div>

            @if ($errors->any())
                <div class="alert-error" style="background: #fce8e6; color: #a94442; border: 1px solid #f5c6cb; padding: 12px 15px; margin-bottom: 20px; border-radius: 8px; font-size: 14px;">
                    <ul style="margin: 0; padding-left: 20px; font-weight: 500;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="fa-regular fa-user"></i> Username
                    </label>
                    <input 
                        id="username" 
                        type="text" 
                        name="username" 
                        value="{{ old('username') }}" 
                        required 
                        autofocus 
                        class="form-control"
                        placeholder="Enter your username"
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fa-solid fa-lock"></i> Password
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        class="form-control"
                        placeholder="Enter your password"
                    >
                </div>

                <div class="form-group">
                    <label for="role" class="form-label">
                        <i class="fa-solid fa-user-shield"></i> Login As
                    </label>
                    <select id="role" name="role" class="form-control">
                        <option value="technician">Lab Technician</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i> Login to System
                </button>
            </form>

            <div class="credentials-box">
                <h4><i class="fa-solid fa-circle-info"></i> Test Credentials:</h4>
                <p><strong>Admin:</strong> admin / admin123</p>
                <p><strong>Manager:</strong> manager / manager123</p>
                <p><strong>Technician:</strong> technician / tech123</p>
            </div>

        </div>

    </div>
</div>
@endsection