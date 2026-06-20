{{-- ============================================
     ADD NEW TEST PAGE - Page 4
     Location: resources/views/tests/create.blade.php
     Purpose: Form to add new test record
     Extends: layouts/app.blade.php
     Submits to: TestController@store
     ============================================ --}}

@extends('layouts.app')

@section('title', 'Add New Test — SRS Lab Automation')

@push('styles')
<style>

    /* ==========================================
       PAGE WRAPPER
       Responsive padding for all screens
    ========================================== */
    .create-page {
        padding: 28px;
        max-width: 900px;
        margin: 0 auto;
    }

    /* ==========================================
       PAGE HEADER
       Title and back button row
    ========================================== */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .page-header h1 {
        font-size: 22px;
        font-weight: 700;
        color: #26215C;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Back button */
    .btn-back {
        padding: 9px 18px;
        background: white;
        color: #534AB7;
        border: 1.5px solid #534AB7;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background 0.2s;
    }

    .btn-back:hover {
        background: #EEEDFE;
    }

    /* ==========================================
       FORM CARD
       White card wrapping the form
    ========================================== */
    .form-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 20px;
    }

    /* Form section header */
    .form-section-header {
        background: linear-gradient(90deg, #26215C, #534AB7);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-header h2 {
        font-size: 15px;
        font-weight: 600;
        color: white;
    }

    .form-section-header i {
        font-size: 20px;
        color: #CECBF6;
    }

    /* Form body padding */
    .form-body {
        padding: 24px;
    }

    /* ==========================================
       FORM GRID - 2 columns on desktop
       1 column on mobile
    ========================================== */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
    }

    /* Full width - spans both columns */
    .form-grid .full-width {
        grid-column: 1 / -1;
    }

    /* ==========================================
       FORM FIELDS
    ========================================== */
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    /* Field label */
    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #26215C;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Required star */
    .form-group label span.req {
        color: #C0392B;
        font-size: 14px;
    }

    /* Input and select fields */
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 11px 14px;
        font-size: 14px;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 9px;
        background: #FAFAFA;
        color: #2C2C2A;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Focus state - purple border */
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #534AB7;
        box-shadow: 0 0 0 3px rgba(83,74,183,0.10);
        background: white;
    }

    /* Readonly field - auto generated */
    .form-group input[readonly] {
        background: #EEEDFE;
        color: #3C3489;
        font-weight: 600;
        cursor: not-allowed;
        border-color: #AFA9EC;
    }

    /* Textarea height */
    .form-group textarea {
        height: 110px;
        resize: vertical;
    }

    /* Field helper text */
    .field-hint {
        font-size: 11px;
        color: #888780;
        margin-top: 2px;
    }

    /* Validation error message */
    .field-error {
        font-size: 12px;
        color: #C0392B;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 2px;
    }

    /* ==========================================
       AUTO GENERATED TEST ID BOX
    ========================================== */
    .auto-id-box {
        background: #EEEDFE;
        border: 1.5px dashed #AFA9EC;
        border-radius: 9px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .auto-id-box i {
        font-size: 24px;
        color: #534AB7;
        flex-shrink: 0;
    }

    .auto-id-box .id-text {
        flex: 1;
    }

    .auto-id-box .id-label {
        font-size: 11px;
        color: #7F77DD;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 3px;
    }

    .auto-id-box .id-value {
        font-size: 20px;
        font-weight: 700;
        color: #26215C;
        letter-spacing: 1px;
        font-family: monospace;
    }

    /* Auto badge */
    .badge-auto-inline {
        background: #534AB7;
        color: white;
        font-size: 10px;
        padding: 3px 8px;
        border-radius: 20px;
        font-weight: 600;
        margin-left: 8px;
    }

    /* ==========================================
       RESULT SELECTOR
       Visual buttons for Pass/Fail/Pending
    ========================================== */
    .result-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .result-option input[type="radio"] {
        display: none;
    }

    .result-option label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        border-radius: 9px;
        border: 2px solid rgba(0,0,0,0.10);
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
        background: #FAFAFA;
    }

    /* Pass option - green when selected */
    .result-option.pass input:checked + label {
        background: #EAF3DE;
        border-color: #27500A;
        color: #27500A;
    }

    /* Fail option - red when selected */
    .result-option.fail input:checked + label {
        background: #FCEBEB;
        border-color: #791F1F;
        color: #791F1F;
    }

    /* Pending option - orange when selected */
    .result-option.pending input:checked + label {
        background: #FAEEDA;
        border-color: #633806;
        color: #633806;
    }

    .result-option label:hover {
        border-color: #534AB7;
        background: #EEEDFE;
    }

    /* ==========================================
       SUCCESS AND ERROR ALERTS
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

    .alert-error {
        background: #FCEBEB;
        border: 1px solid #F5C6C6;
        border-radius: 9px;
        padding: 14px 18px;
        font-size: 13px;
        color: #791F1F;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ==========================================
       SUBMIT BUTTON ROW
    ========================================== */
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        flex-wrap: wrap;
        padding-top: 8px;
        border-top: 1px solid rgba(0,0,0,0.07);
        margin-top: 8px;
    }

    /* Save button */
    .btn-save {
        padding: 12px 28px;
        background: #534AB7;
        color: white;
        border: none;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-save:hover {
        background: #3C3489;
    }

    /* Reset button */
    .btn-reset {
        padding: 12px 22px;
        background: white;
        color: #888780;
        border: 1.5px solid rgba(0,0,0,0.12);
        border-radius: 9px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-reset:hover {
        background: #F1EFE8;
    }

    /* ==========================================
       IMAGE UPLOAD PREVIEW
       📸 IMAGE: Product image upload preview
    ========================================== */
    .img-upload-wrap {
        border: 2px dashed rgba(0,0,0,0.12);
        border-radius: 9px;
        padding: 20px;
        text-align: center;
        background: #FAFAFA;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .img-upload-wrap:hover {
        border-color: #534AB7;
        background: #EEEDFE;
    }

    .img-upload-wrap i {
        font-size: 32px;
        color: #534AB7;
        display: block;
        margin-bottom: 8px;
    }

    .img-upload-wrap p {
        font-size: 13px;
        color: #888780;
    }

    /* Image preview box */
    #imagePreview {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 8px;
        display: none;
        margin-top: 10px;
    }

    /* ==========================================
       RESPONSIVE - Mobile styles
       Screen width less than 768px
    ========================================== */
    @media (max-width: 768px) {

        /* Single column on mobile */
        .form-grid {
            grid-template-columns: 1fr;
        }

        /* Result options stack on mobile */
        .result-options {
            grid-template-columns: 1fr;
        }

        /* Full width buttons on mobile */
        .form-actions {
            flex-direction: column;
        }

        .btn-save,
        .btn-reset {
            width: 100%;
            justify-content: center;
        }

        /* Smaller padding on mobile */
        .create-page {
            padding: 16px;
        }

        .form-body {
            padding: 16px;
        }

        /* Page header stacks on mobile */
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* Tablet styles - 768px to 1024px */
    @media (max-width: 1024px) and (min-width: 769px) {
        .form-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

</style>
@endpush

@section('content')

<div class="sidebar-layout">

    {{-- ======================================
         SIDEBAR - Left navigation
    ====================================== --}}
    <aside class="sidebar">

        <div class="sidebar-label">Main Menu</div>

        <a href="{{ route('dashboard') }}"
           class="sidebar-item">
            <i class="ti ti-layout-dashboard"></i>
            Dashboard
        </a>

        <div class="sidebar-label">Tests</div>

        {{-- Add Test - currently active --}}
        <a href="{{ route('tests.create') }}"
           class="sidebar-item active">
            <i class="ti ti-plus"></i>
            Add New Test
        </a>

        <a href="{{ route('tests.search') }}"
           class="sidebar-item">
            <i class="ti ti-search"></i>
            Search Records
        </a>

        <a href="{{ route('tests.index') }}"
           class="sidebar-item">
            <i class="ti ti-table"></i>
            All Records
        </a>

        <div class="sidebar-label">Reports</div>

        <a href="#" class="sidebar-item">
            <i class="ti ti-file-report"></i>
            Test Reports
        </a>

        <div class="sidebar-label">Account</div>

        <a href="{{ route('logout') }}"
           class="sidebar-item">
            <i class="ti ti-logout"></i>
            Logout
        </a>

    </aside>

    {{-- ======================================
         MAIN CONTENT
    ====================================== --}}
    <div class="main-content">
        <div class="create-page">

            {{-- Page header --}}
            <div class="page-header">
                <h1>
                    <i class="ti ti-plus"
                       style="color:#534AB7;"></i>
                    Add New Test Record
                </h1>
                <a href="{{ route('tests.index') }}"
                   class="btn-back">
                    <i class="ti ti-arrow-left"></i>
                    Back to Records
                </a>
            </div>

            {{-- Success message after save --}}
            @if(session('success'))
                <div class="alert-success">
                    <i class="ti ti-circle-check"
                       style="font-size:20px;"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation error summary --}}
            @if($errors->any())
                <div class="alert-error">
                    <i class="ti ti-alert-circle"
                       style="font-size:20px;"></i>
                    <div>
                        Please fix the errors below:
                        <ul style="margin-top:6px;
                                   padding-left:16px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- ====================================
                 AUTO GENERATED TEST ID BOX
                 Shows what ID will be generated
            ==================================== --}}
            <div class="auto-id-box">
                <i class="ti ti-id-badge"></i>
                <div class="id-text">
                    <div class="id-label">
                        Test ID
                        <span class="badge-auto-inline">
                            Auto Generated
                        </span>
                    </div>
                    <div class="id-value" id="previewId">
                        TST--000-2024
                    </div>
                </div>
            </div>

            {{-- ====================================
                 MAIN FORM
                 POST to TestController@store
            ==================================== --}}
            <form action="{{ route('tests.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="testForm">

                {{-- CSRF security token --}}
                @csrf

                {{-- ================================
                     SECTION 1: PRODUCT INFO
                ================================ --}}
                <div class="form-card">
                    <div class="form-section-header">
                        <i class="ti ti-box"></i>
                        <h2>Product Information</h2>
                    </div>
                    <div class="form-body">
                        <div class="form-grid">

                            {{-- Product ID --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-hash"></i>
                                    Product ID
                                    <span class="req">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="product_id"
                                    id="productId"
                                    placeholder="e.g. SRS2024001A"
                                    maxlength="10"
                                    value="{{ old('product_id') }}"
                                    oninput="updatePreview()">
                                <span class="field-hint">
                                    Enter 10 digit product code
                                </span>
                                @error('product_id')
                                    <div class="field-error">
                                        <i class="ti ti-alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Product Type --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-category"></i>
                                    Product Type
                                    <span class="req">*</span>
                                </label>
                                <select name="product_type">
                                    <option value="">
                                        Select product type
                                    </option>
                                    <option value="switchgear"
                                        {{ old('product_type') == 'switchgear' ? 'selected' : '' }}>
                                        Switch Gear
                                    </option>
                                    <option value="fuse"
                                        {{ old('product_type') == 'fuse' ? 'selected' : '' }}>
                                        Fuse
                                    </option>
                                    <option value="capacitor"
                                        {{ old('product_type') == 'capacitor' ? 'selected' : '' }}>
                                        Capacitor
                                    </option>
                                    <option value="resistor"
                                        {{ old('product_type') == 'resistor' ? 'selected' : '' }}>
                                        Resistor
                                    </option>
                                </select>
                            </div>

                            {{-- Product Revision --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-versions"></i>
                                    Product Revision
                                </label>
                                <input
                                    type="text"
                                    name="revision"
                                    placeholder="e.g. R1, R2, V1"
                                    value="{{ old('revision') }}">
                                <span class="field-hint">
                                    Optional revision number
                                </span>
                            </div>

                            {{-- Product Image Upload --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-photo"></i>
                                    Product Image
                                </label>
                                {{-- ==========================================
                                     IMAGE UPLOAD
                                     📸 Uploaded images saved to:
                                     public/images/products/
                                ========================================== --}}
                                <div class="img-upload-wrap"
                                     onclick="document.getElementById('productImage').click()">
                                    <i class="ti ti-upload"></i>
                                    <p>Click to upload product image</p>
                                    <p style="font-size:11px;
                                              margin-top:4px;">
                                        JPG, PNG — Max 2MB
                                    </p>
                                </div>
                                <input
                                    type="file"
                                    name="product_image"
                                    id="productImage"
                                    accept="image/*"
                                    style="display:none;"
                                    onchange="previewImage(this)">
                                <img id="imagePreview"
                                     alt="Product preview">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================================
                     SECTION 2: TEST INFO
                ================================ --}}
                <div class="form-card">
                    <div class="form-section-header">
                        <i class="ti ti-flask"></i>
                        <h2>Test Information</h2>
                    </div>
                    <div class="form-body">
                        <div class="form-grid">

                            {{-- Test Type --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-test-pipe"></i>
                                    Test Type
                                    <span class="req">*</span>
                                </label>
                                <select
                                    name="test_type"
                                    id="testType"
                                    onchange="updatePreview()">
                                    <option value="">
                                        Select test type
                                    </option>
                                    <option value="electrical"
                                        {{ old('test_type') == 'electrical' ? 'selected' : '' }}>
                                        Electrical Test
                                    </option>
                                    <option value="load"
                                        {{ old('test_type') == 'load' ? 'selected' : '' }}>
                                        Load Test
                                    </option>
                                    <option value="thermal"
                                        {{ old('test_type') == 'thermal' ? 'selected' : '' }}>
                                        Thermal Test
                                    </option>
                                    <option value="safety"
                                        {{ old('test_type') == 'safety' ? 'selected' : '' }}>
                                        Safety Test
                                    </option>
                                    <option value="mechanical"
                                        {{ old('test_type') == 'mechanical' ? 'selected' : '' }}>
                                        Mechanical Test
                                    </option>
                                </select>
                                @error('test_type')
                                    <div class="field-error">
                                        <i class="ti ti-alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Test Date --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-calendar"></i>
                                    Test Date
                                    <span class="req">*</span>
                                </label>
                                <input
                                    type="date"
                                    name="test_date"
                                    value="{{ old('test_date', date('Y-m-d')) }}">
                                @error('test_date')
                                    <div class="field-error">
                                        <i class="ti ti-alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Tester Name --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-user-check"></i>
                                    Tester Name
                                    <span class="req">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="tester_name"
                                    placeholder="Enter technician name"
                                    value="{{ old('tester_name') }}">
                                @error('tester_name')
                                    <div class="field-error">
                                        <i class="ti ti-alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Testing Criteria --}}
                            <div class="form-group">
                                <label>
                                    <i class="ti ti-list-check"></i>
                                    Testing Criteria
                                </label>
                                <input
                                    type="text"
                                    name="criteria"
                                    placeholder="e.g. IEC 60947, IS 13947"
                                    value="{{ old('criteria') }}">
                                <span class="field-hint">
                                    Standard used for testing
                                </span>
                            </div>

                            {{-- Detailed Remarks --}}
                            <div class="form-group full-width">
                                <label>
                                    <i class="ti ti-notes"></i>
                                    Detailed Remarks
                                    <span class="req">*</span>
                                </label>
                                <textarea
                                    name="remarks"
                                    placeholder="Enter detailed remarks about the test — what was tested, how it was tested, what output was observed, any issues found...">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="field-error">
                                        <i class="ti ti-alert-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================================
                     SECTION 3: TEST RESULT
                ================================ --}}
                <div class="form-card">
                    <div class="form-section-header">
                        <i class="ti ti-chart-bar"></i>
                        <h2>Test Result</h2>
                    </div>
                    <div class="form-body">

                        <div class="form-group">
                            <label>
                                <i class="ti ti-circle-check"></i>
                                Select Result
                                <span class="req">*</span>
                            </label>

                            {{-- Visual result selector --}}
                            <div class="result-options">

                                {{-- Pass option --}}
                                <div class="result-option pass">
                                    <input
                                        type="radio"
                                        name="result"
                                        id="pass"
                                        value="pass"
                                        {{ old('result') == 'pass' ? 'checked' : '' }}>
                                    <label for="pass">
                                        <i class="ti ti-circle-check"></i>
                                        Pass
                                    </label>
                                </div>

                                {{-- Fail option --}}
                                <div class="result-option fail">
                                    <input
                                        type="radio"
                                        name="result"
                                        id="fail"
                                        value="fail"
                                        {{ old('result') == 'fail' ? 'checked' : '' }}>
                                    <label for="fail">
                                        <i class="ti ti-circle-x"></i>
                                        Fail
                                    </label>
                                </div>

                                {{-- Pending option --}}
                                <div class="result-option pending">
                                    <input
                                        type="radio"
                                        name="result"
                                        id="pending"
                                        value="pending"
                                        {{ old('result') == 'pending' ? 'checked' : '' }}>
                                    <label for="pending">
                                        <i class="ti ti-clock"></i>
                                        Pending
                                    </label>
                                </div>

                            </div>

                            @error('result')
                                <div class="field-error"
                                     style="margin-top:8px;">
                                    <i class="ti ti-alert-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Form action buttons --}}
                        <div class="form-actions"
                             style="margin-top:20px;">

                            {{-- Reset form --}}
                            <button type="reset"
                                    class="btn-reset">
                                <i class="ti ti-refresh"></i>
                                Reset Form
                            </button>

                            {{-- Save record --}}
                            <button type="submit"
                                    class="btn-save">
                                <i class="ti ti-device-floppy"></i>
                                Save Test Record
                            </button>

                        </div>

                    </div>
                </div>

            </form>
            {{-- end form --}}

        </div>
        {{-- end create-page --}}
    </div>
    {{-- end main-content --}}

</div>
{{-- end sidebar-layout --}}

@endsection

{{-- ==========================================
     JAVASCRIPT
     Auto generate test ID preview
     Image upload preview
========================================== --}}
@push('scripts')
<script>

    // ==========================================
    // updatePreview()
    // Purpose: Show preview of test ID
    // Runs when product ID or test type changes
    // ==========================================
    function updatePreview() {

        // Get product ID value
        const productId = document
            .getElementById('productId').value;

        // Get selected test type
        const testType = document
            .getElementById('testType').value;

        // Short codes for each test type
        const typeCodes = {
            'electrical': 'EL',
            'load':       'LD',
            'thermal':    'TH',
            'safety':     'SF',
            'mechanical': 'MC',
        };

        // Get type code or XX if not selected
        const typeCode = typeCodes[testType] || '--';

        // Get current year
        const year = new Date().getFullYear();

        // Build preview ID
        const preview = 'TST' + typeCode + '000' + year;

        // Show preview in box
        document.getElementById('previewId').textContent =
            preview.substring(0, 12);
    }

    // ==========================================
    // previewImage()
    // Purpose: Show image preview before upload
    // Runs when user selects an image file
    // ==========================================
    function previewImage(input) {
        if (input.files && input.files[0]) {

            const reader = new FileReader();

            // When file is read show it
            reader.onload = function(e) {
                const preview = document
                    .getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            // Read the image file
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endpush