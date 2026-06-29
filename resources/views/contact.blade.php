{{-- ============================================
     CONTACT PAGE - Page 8
     Location: resources/views/contact.blade.php
     Purpose: Contact form and company info
     Extends: layouts/app.blade.php
     Submits to: ContactController@store
     ============================================ --}}

@extends('layouts.app')

@section('title', 'Contact — SRS Lab Automation')

@push('styles')
<style>

    /* ==========================================
       CONTACT PAGE WRAPPER
       Cream background full page
    ========================================== */
    .contact-page {
        background: #F1EFE8;
        min-height: calc(100vh - 74px);
        padding: 48px 40px;
    }

    /* Page heading */
    .contact-heading {
        text-align: center;
        margin-bottom: 40px;
    }

    .contact-heading h1 {
        font-size: 30px;
        font-weight: 700;
        color: #26215C;
        margin-bottom: 10px;
    }

    .contact-heading p {
        font-size: 15px;
        color: #888780;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ==========================================
       MAIN GRID
       Left: Form | Right: Info
    ========================================== */
    .contact-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 28px;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* ==========================================
       CONTACT FORM CARD
    ========================================== */
    .form-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.07);
        box-shadow: 0 4px 20px rgba(83,74,183,0.08);
    }

    /* Purple header bar */
    .form-card-header {
        background: linear-gradient(90deg, #26215C, #534AB7);
        padding: 20px 28px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header h2 {
        font-size: 16px;
        font-weight: 600;
        color: white;
    }

    .form-card-header i {
        font-size: 22px;
        color: #CECBF6;
    }

    /* Form body */
    .form-card-body {
        padding: 28px;
    }

    /* ==========================================
       FORM FIELDS
    ========================================== */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Required star */
    .req { color: #C0392B; }

    /* Input fields */
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 11px 14px;
        font-size: 14px;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 9px;
        background: #FAFAFA;
        color: #2C2C2A;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Focus state */
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #534AB7;
        box-shadow: 0 0 0 3px rgba(83,74,183,0.10);
        background: white;
    }

    /* Textarea */
    .form-group textarea {
        height: 120px;
        resize: vertical;
    }

    /* Two column row */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* Validation error message */
    .field-error {
        font-size: 12px;
        color: #C0392B;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Submit button */
    .btn-submit {
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

    .btn-submit:hover { background: #3C3489; }

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
       CONTACT INFO CARD - Right side
    ========================================== */
    .info-card {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* Single info box */
    .info-box {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid rgba(0,0,0,0.07);
        box-shadow: 0 4px 16px rgba(83,74,183,0.06);
    }

    /* Info box title */
    .info-box h3 {
        font-size: 14px;
        font-weight: 600;
        color: #26215C;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-box h3 i {
        font-size: 18px;
        color: #534AB7;
    }

    /* Single contact detail row */
    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 14px;
    }

    .info-row:last-child { margin-bottom: 0; }

    /* Icon circle */
    .info-icon {
        width: 36px;
        height: 36px;
        background: #EEEDFE;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #534AB7;
        flex-shrink: 0;
    }

    .info-detail {
        flex: 1;
    }

    .info-detail .lbl {
        font-size: 11px;
        color: #888780;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-detail .val {
        font-size: 13px;
        color: #2C2C2A;
        font-weight: 500;
    }

    .info-detail a {
        color: #534AB7;
        text-decoration: none;
    }

    .info-detail a:hover { text-decoration: underline; }

    /* ==========================================
       OFFICE HOURS BOX
    ========================================== */
    .hours-grid {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .hours-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        padding: 6px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .hours-row:last-child { border-bottom: none; }

    .hours-row .day { color: #888780; }

    .hours-row .time {
        color: #26215C;
        font-weight: 600;
    }

    /* Open badge */
    .badge-open {
        background: #EAF3DE;
        color: #27500A;
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* ==========================================
       MAP BOX PLACEHOLDER
       📸 IMAGE: public/images/map.jpg
       Or use Google Maps embed
    ========================================== */
    .map-box {
        background: #EEEDFE;
        border-radius: 12px;
        height: 140px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #534AB7;
        border: 1px solid rgba(83,74,183,0.15);
        overflow: hidden;
    }

    .map-box i { font-size: 32px; }
    .map-box p { font-size: 13px; font-weight: 500; }

    /* ==========================================
       SOCIAL LINKS
    ========================================== */
    .social-links {
        display: flex;
        gap: 10px;
        margin-top: 4px;
    }

    .social-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #EEEDFE;
        color: #534AB7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        text-decoration: none;
        transition: background 0.2s;
    }

    .social-btn:hover {
        background: #534AB7;
        color: white;
    }

    /* ==========================================
       RESPONSIVE STYLES
    ========================================== */

    /* Tablet max 1024px */
    @media (max-width: 1024px) {

        .contact-page { padding: 36px 28px; }

        .contact-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    /* Mobile max 768px */
    @media (max-width: 768px) {

        .contact-page { padding: 24px 16px; }

        .contact-heading h1 { font-size: 24px; }

        /* Stack on mobile */
        .contact-grid {
            grid-template-columns: 1fr;
        }

        /* Form row single column */
        .form-row {
            grid-template-columns: 1fr;
        }

        .form-card-body { padding: 20px; }
    }

</style>
@endpush

@section('content')

<div class="contact-page">

    {{-- Page heading --}}
    <div class="contact-heading">
        <h1>
            <i class="ti ti-mail"
               style="color:#534AB7;"></i>
            Contact Us
        </h1>
        <p>
            Send us your message or service request.
            Our team will get back to you as soon as possible.
        </p>
    </div>

    <div class="contact-grid">

        {{-- ======================================
             LEFT: CONTACT FORM
        ====================================== --}}
        <div class="form-card">

            {{-- Purple header --}}
            <div class="form-card-header">
                <i class="ti ti-send"></i>
                <h2>Send Us a Message</h2>
            </div>

            <div class="form-card-body">

                {{-- Success message after submit --}}
                @if(session('success'))
                    <div class="alert-success">
                        <i class="ti ti-circle-check"
                           style="font-size:20px;"></i>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ==============================
                     CONTACT FORM
                     POST to ContactController@store
                     Saves to contacts table in DB
                ============================== --}}
                <form action="{{ route('contact.store') }}"
                      method="POST">

                    {{-- CSRF security token --}}
                    @csrf

                    {{-- Name and Company row --}}
                    <div class="form-row">

                        {{-- Full name --}}
                        <div class="form-group">
                            <label>
                                <i class="ti ti-user"></i>
                                Full Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                placeholder="Your full name"
                                value="{{ old('name') }}">
                        </div>

                        {{-- Company or Location --}}
                        <div class="form-group">
                            <label>
                                <i class="ti ti-building"></i>
                                Company / Location
                            </label>
                            <input
                                type="text"
                                name="company_or_location"
                                placeholder="Company or city"
                                value="{{ old('company_or_location') }}">
                        </div>

                    </div>

                    {{-- Contact number - required --}}
                    <div class="form-group">
                        <label>
                            <i class="ti ti-phone"></i>
                            Contact Number
                            <span class="req">*</span>
                        </label>
                        <input
                            type="text"
                            name="contact_number"
                            placeholder="e.g. +92 300 1234567"
                            value="{{ old('contact_number') }}"
                            maxlength="25">
                        @error('contact_number')
                            <div class="field-error">
                                <i class="ti ti-alert-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Service message - required --}}
                    <div class="form-group">
                        <label>
                            <i class="ti ti-notes"></i>
                            Service Details / Message
                            <span class="req">*</span>
                        </label>
                        <textarea
                            name="message"
                            placeholder="Describe your service request, query or message in detail...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="field-error">
                                <i class="ti ti-alert-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Submit button --}}
                    <button type="submit"
                            class="btn-submit">
                        <i class="ti ti-send"></i>
                        Send Message
                    </button>

                </form>

            </div>

        </div>

        {{-- ======================================
             RIGHT: CONTACT INFO
        ====================================== --}}
        <div class="info-card">

            {{-- Contact details box --}}
            <div class="info-box">
                <h3>
                    <i class="ti ti-info-circle"></i>
                    Contact Information
                </h3>

                {{-- Phone --}}
                <div class="info-row">
                    <div class="info-icon">
                        <i class="ti ti-phone"></i>
                    </div>
                    <div class="info-detail">
                        <div class="lbl">Phone</div>
                        <div class="val">+92 021 3222510688</div>
                    </div>
                </div>

                {{-- Email --}}
                <div class="info-row">
                    <div class="info-icon">
                        <i class="ti ti-mail"></i>
                    </div>
                    <div class="info-detail">
                        <div class="lbl">Email</div>
                        <div class="val">
                            <a href="mailto:info@srselectrical.com">
                                info@srselectrical.com
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Address --}}
                <div class="info-row">
                    <div class="info-icon">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div class="info-detail">
                        <div class="lbl">Address</div>
                        <div class="val">
                            Industrial Area,<br>
                            Karachi, Pakistan
                        </div>
                    </div>
                </div>

                {{-- Website --}}
                <div class="info-row">
                    <div class="info-icon">
                        <i class="ti ti-world"></i>
                    </div>
                    <div class="info-detail">
                        <div class="lbl">Website</div>
                        <div class="val">
                            <a href="https://srselectricalenterprises.com/About.html"
                               target="_blank">
                                www.srselectricalenterprises.com
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Social links --}}
                <div class="social-links">
                    <a href="#" class="social-btn"
                       title="LinkedIn">
                        <i class="ti ti-brand-linkedin"></i>
                    </a>
                    <a href="#" class="social-btn"
                       title="Twitter">
                        <i class="ti ti-brand-twitter"></i>
                    </a>
                    <a href="#" class="social-btn"
                       title="Facebook">
                        <i class="ti ti-brand-facebook"></i>
                    </a>
                </div>

            </div>

            {{-- Office hours box --}}
            <div class="info-box">
                <h3>
                    <i class="ti ti-clock"></i>
                    Office Hours
                </h3>

                <div class="hours-grid">

                    <div class="hours-row">
                        <span class="day">Monday — Friday</span>
                        <span class="time">
                            9:00 AM — 6:00 PM
                            <span class="badge-open">Open</span>
                        </span>
                    </div>

                    <div class="hours-row">
                        <span class="day">Saturday</span>
                        <span class="time">9:00 AM — 2:00 PM</span>
                    </div>

                    <div class="hours-row">
                        <span class="day">Sunday</span>
                        <span class="time"
                              style="color:#888780;">
                            Closed
                        </span>
                    </div>

                </div>
            </div>

            {{-- Map placeholder --}}
            {{-- ==========================================
                 MAP IMAGE OR EMBED
                 📸 Option 1: Image
                 File: public/images/map.jpg
                 OR
                 Option 2: Google Maps embed iframe
            ========================================== --}}
            <div class="info-box" style="padding:0;overflow:hidden;">
                <div class="map-box">
                    <i class="ti ti-map-pin"></i>
                    <p>Industrial Area, Karachi, Pakistan</p>
                    <a href="https://maps.google.com"
                       target="_blank"
                       style="font-size:12px;
                              color:#534AB7;
                              text-decoration:none;">
                        <i class="ti ti-external-link"></i>
                        View on Google Maps
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection