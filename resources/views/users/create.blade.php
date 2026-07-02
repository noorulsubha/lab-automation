{{-- ==========================================================
| FILE : resources/views/users/create.blade.php
| MODULE : User Management
| PAGE : Add New User
| PURPOSE : Create New User Form
| AUTHOR : Noor Project
========================================================== --}}

@extends('layouts.app')

@section('title', 'Add New User | SRS Lab Automation')

@push('styles')

<style>

/* ==========================================================
   PAGE WRAPPER
========================================================== */

.create-page{
    max-width:1100px;
    margin:auto;
    padding:30px;
}

/* ==========================================================
   PAGE HEADER
========================================================== */

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
}

.page-header h1{
    font-size:28px;
    color:#26215C;
    font-weight:700;
}

.page-header p{
    color:#777;
    margin-top:5px;
}

/* ==========================================================
   BACK BUTTON
========================================================== */

.btn-back{

    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:10px 18px;

    background:#fff;

    border:1px solid #534AB7;

    color:#534AB7;

    text-decoration:none;

    border-radius:8px;

    transition:.3s;

}

.btn-back:hover{

    background:#534AB7;

    color:#fff;

}

/* ==========================================================
   FORM CARD
========================================================== */

.form-card{

    background:#fff;

    border-radius:15px;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    overflow:hidden;

}

/* ==========================================================
   CARD HEADER
========================================================== */

.card-header{

    background:#534AB7;

    color:#fff;

    padding:18px 25px;

}

.card-header h2{

    margin:0;

    font-size:20px;

}

/* ==========================================================
   CARD BODY
========================================================== */

.card-body{

    padding:30px;

}

/* ==========================================================
   GRID
========================================================== */

.form-grid{

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:20px;

}

/* ==========================================================
   FORM GROUP
========================================================== */

.form-group{

    display:flex;

    flex-direction:column;

}

.form-group.full{

    grid-column:1/-1;

}

.form-group label{

    margin-bottom:8px;

    color:#333;

    font-weight:600;

}

.form-group input,
.form-group select,
.form-group textarea{

    padding:12px;

    border:1px solid #ccc;

    border-radius:8px;

    font-size:14px;

    outline:none;

    transition:.3s;

}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{

    border-color:#534AB7;

    box-shadow:0 0 8px rgba(83,74,183,.25);

}

/* ==========================================================
   AUTO USER ID
========================================================== */

.auto-id{

    background:#F3F1FF;

    border-left:5px solid #534AB7;

    padding:18px;

    margin-bottom:25px;

    border-radius:10px;

}

.auto-id h3{

    margin:0;

    color:#534AB7;

}

.auto-id p{

    margin-top:5px;

    color:#555;

}

/* ==========================================================
   RESPONSIVE
========================================================== */

@media(max-width:768px){

.form-grid{

grid-template-columns:1fr;

}

.page-header{

flex-direction:column;

align-items:flex-start;

gap:15px;

}

.card-body{

padding:20px;

}

}

</style>

@endpush

@section('content')

<div class="create-page">

    <!-- ==========================================
         PAGE HEADER
    =========================================== -->

    <div class="page-header">

        <div>

            <h1>
                <i class="ti ti-user-plus"></i>
                Add New User
            </h1>

            <p>
                Create a new system user account.
            </p>

        </div>

        <a href="{{ route('users.index') }}" class="btn-back">

            <i class="ti ti-arrow-left"></i>

            Back

        </a>

    </div>

    <!-- ==========================================
         FORM CARD
    =========================================== -->

    <div class="form-card">

        <div class="card-header">

            <h2>

                <i class="ti ti-user-circle"></i>

                User Information

            </h2>

        </div>

        <div class="card-body">

            <!-- Auto Generated User ID -->

            <div class="auto-id">

                <h3 id="userId">

                    USR-00001

                </h3>

                <p>

                    User ID will be generated automatically.

                </p>

            </div>

            <!-- User Form -->

            <form
                action="{{ route('users.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="form-grid">
                    {{-- ==========================================================
     SECTION 1 : PERSONAL INFORMATION
========================================================== --}}

<!-- Full Name -->
<div class="form-group">

    <label>
        <i class="ti ti-user"></i>
        Full Name
        <span style="color:red;">*</span>
    </label>

    <input
        type="text"
        name="full_name"
        value="{{ old('full_name') }}"
        placeholder="Enter full name"
        required>

    @error('full_name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


<!-- Email Address -->
<div class="form-group">

    <label>
        <i class="ti ti-mail"></i>
        Email Address
        <span style="color:red;">*</span>
    </label>

    <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="example@gmail.com"
        required>

    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


<!-- Username -->
<div class="form-group">

    <label>
        <i class="ti ti-at"></i>
        Username
        <span style="color:red;">*</span>
    </label>

    <input
        type="text"
        name="username"
        value="{{ old('username') }}"
        placeholder="Enter username"
        required>

    @error('username')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


<!-- Phone Number -->
<div class="form-group">

    <label>
        <i class="ti ti-phone"></i>
        Phone Number
    </label>

    <input
        type="text"
        name="phone"
        value="{{ old('phone') }}"
        placeholder="+92 300 1234567">

</div>


<!-- Password -->
<div class="form-group">

    <label>
        <i class="ti ti-lock"></i>
        Password
        <span style="color:red;">*</span>
    </label>

    <input
        type="password"
        name="password"
        placeholder="Enter password"
        required>

    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


<!-- Confirm Password -->
<div class="form-group">

    <label>
        <i class="ti ti-lock-check"></i>
        Confirm Password
        <span style="color:red;">*</span>
    </label>

    <input
        type="password"
        name="password_confirmation"
        placeholder="Confirm password"
        required>

</div>


{{-- ==========================================================
     SECTION 2 : USER ROLE
========================================================== --}}

<!-- User Role -->
<div class="form-group">

    <label>

        <i class="ti ti-user-star"></i>

        User Role

        <span style="color:red;">*</span>

    </label>

    <select
        name="role"
        required>

        <option value="">Select Role</option>

        <option value="Administrator">
            Administrator
        </option>

        <option value="Lab Manager">
            Lab Manager
        </option>

        <option value="Technician">
            Technician
        </option>

        <option value="Operator">
            Operator
        </option>

    </select>

</div>


<!-- Status -->
<div class="form-group">

    <label>

        <i class="ti ti-check"></i>

        Status

    </label>

    <select
        name="status">

        <option value="Active">
            Active
        </option>

        <option value="Inactive">
            Inactive
        </option>

    </select>

</div>
{{-- ==========================================================
     SECTION 3 : PROFILE IMAGE
========================================================== --}}

<!-- Profile Image -->
<div class="form-group full">

    <label>
        <i class="ti ti-photo"></i>
        Profile Image
    </label>

    <input
        type="file"
        name="profile_image"
        id="profileImage"
        accept="image/*"
        onchange="previewImage(event)">

    <br><br>

    <img id="preview"
         src=""
         alt="Profile Preview"
         style="display:none;
                width:150px;
                height:150px;
                object-fit:cover;
                border-radius:10px;
                border:2px solid #534AB7;">

</div>

{{-- ==========================================================
     ADDRESS
========================================================== --}}

<div class="form-group full">

    <label>

        <i class="ti ti-map-pin"></i>

        Address

    </label>

    <textarea
        name="address"
        rows="4"
        placeholder="Enter complete address">{{ old('address') }}</textarea>

</div>

{{-- ==========================================================
     NOTES
========================================================== --}}

<div class="form-group full">

    <label>

        <i class="ti ti-notes"></i>

        Notes

    </label>

    <textarea
        name="notes"
        rows="4"
        placeholder="Additional remarks">{{ old('notes') }}</textarea>

</div>

</div>
<!-- End Form Grid -->


<hr style="margin:30px 0;">

<!-- ======================================================
     FORM BUTTONS
======================================================= -->

<div
style="display:flex;
justify-content:flex-end;
gap:15px;
flex-wrap:wrap;">

    <!-- Reset -->

    <button
        type="reset"
        class="btn-back">

        <i class="ti ti-refresh"></i>

        Reset

    </button>

    <!-- Save -->

    <button

        type="submit"

        style="background:#534AB7;
        color:#fff;
        border:none;
        padding:12px 28px;
        border-radius:8px;
        cursor:pointer;
        font-size:15px;">

        <i class="ti ti-device-floppy"></i>

        Save User

    </button>

</div>

</form>

</div>

</div>

</div>

@endsection

@push('scripts')

<script>

/* ==========================================================
   IMAGE PREVIEW
========================================================== */

function previewImage(event){

    let reader = new FileReader();

    reader.onload = function(){

        let output = document.getElementById('preview');

        output.src = reader.result;

        output.style.display = "block";

    };

    reader.readAsDataURL(event.target.files[0]);

}

/* ==========================================================
   AUTO USER ID
========================================================== */

window.onload = function(){

    let random = Math.floor(Math.random()*9000)+1000;

    document.getElementById("userId").innerHTML =
    "USR-" + random;

};

</script>

@endpush