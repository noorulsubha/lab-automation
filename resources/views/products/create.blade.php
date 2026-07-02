{{-- ==========================================================
| FILE : resources/views/products/create.blade.php
| MODULE : Product Management
| PAGE : Add New Product
| PURPOSE : Create new product form
========================================================== --}}

@extends('layouts.app')

@section('title', 'Add New Product | SRS Lab Automation')

@push('styles')
<style>
/* =========================================
   PAGE LAYOUT STYLES
========================================= */
.create-page{
    max-width:1100px;
    margin:auto;
    padding:30px;
}

/* =========================================
   HEADER SECTION
========================================= */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
}

.page-header h1{
    font-size:28px;
    font-weight:700;
    color:#26215C;
}

.page-header p{
    color:#777;
    margin-top:5px;
}

/* =========================================
   BACK BUTTON
========================================= */
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

/* =========================================
   CARD DESIGN
========================================= */
.form-card{
    background:#fff;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    overflow:hidden;
}

.card-header{
    background:#534AB7;
    padding:18px 25px;
    color:#fff;
}

.card-header h2{
    margin:0;
    font-size:20px;
}

.card-body{
    padding:30px;
}

/* =========================================
   AUTO ID BOX
========================================= */
.auto-id{
    background:#F3F1FF;
    padding:18px;
    border-left:5px solid #534AB7;
    border-radius:10px;
    margin-bottom:25px;
}

.auto-id h3{
    margin:0;
    color:#534AB7;
}

/* =========================================
   FORM GRID
========================================= */
.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group.full{
    grid-column:1/-1;
}

.form-group label{
    font-weight:600;
    margin-bottom:8px;
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

/* =========================================
   RESPONSIVE DESIGN
========================================= */
@media(max-width:768px){
    .form-grid{
        grid-template-columns:1fr;
    }

    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }
}
</style>
@endpush

@section('content')

<div class="create-page">

    <!-- ================= PAGE HEADER ================= -->
    <div class="page-header">
        <div>
            <h1><i class="ti ti-package"></i> Add New Product</h1>
            <p>Create a new laboratory product</p>
        </div>

        <a href="{{ route('products.index') }}" class="btn-back">
            <i class="ti ti-arrow-left"></i>
            Back
        </a>
    </div>

    <!-- ================= FORM CARD START ================= -->
    <div class="form-card">

        <div class="card-header">
            <h2><i class="ti ti-box"></i> Product Information</h2>
        </div>

        <div class="card-body">

            <!-- Auto Generated Product ID -->
            <div class="auto-id">
                <h3 id="productId">PRD-00000</h3>
                <p>Product ID will be generated automatically.</p>
            </div>

            <!-- FORM START -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                <!-- ================= PRODUCT NAME ================= -->
                <div class="form-group">
                    <label>Product Name <span style="color:red">*</span></label>
                    <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Enter product name" required>

                    @error('product_name')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- ================= CATEGORY ================= -->
                <div class="form-group">
                    <label>Category <span style="color:red">*</span></label>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <option value="Electrical">Electrical</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Safety">Safety Equipment</option>
                        <option value="Laboratory">Laboratory Equipment</option>
                    </select>

                    @error('category')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- ================= BRAND ================= -->
                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" placeholder="Enter brand name">
                </div>

                <!-- ================= MODEL ================= -->
                <div class="form-group">
                    <label>Model Number</label>
                    <input type="text" name="model" value="{{ old('model') }}" placeholder="Enter model number">
                </div>

                <!-- ================= UNIT ================= -->
                <div class="form-group">
                    <label>Unit</label>
                    <select name="unit">
                        <option value="Piece">Piece</option>
                        <option value="Box">Box</option>
                        <option value="Pack">Pack</option>
                        <option value="Set">Set</option>
                        <option value="Meter">Meter</option>
                        <option value="Kg">Kilogram</option>
                        <option value="Liter">Liter</option>
                    </select>
                </div>

                <!-- ================= QUANTITY ================= -->
                <div class="form-group">
                    <label>Quantity <span style="color:red">*</span></label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" min="0" placeholder="Enter quantity" required>

                    @error('quantity')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- ================= PRICE ================= -->
                <div class="form-group">
                    <label>Unit Price <span style="color:red">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" placeholder="Enter price" required>

                    @error('price')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- ================= STATUS ================= -->
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Discontinued">Discontinued</option>
                    </select>
                </div>

                <!-- ================= IMAGE ================= -->
                <div class="form-group full">
                    <label>Product Image</label>
                    <input type="file" name="product_image" id="productImage" accept="image/*">

                    <br><br>
                    <img id="preview" style="display:none;width:160px;height:160px;border-radius:10px;border:2px solid #534AB7;object-fit:cover;">
                </div>

                <!-- ================= DESCRIPTION ================= -->
                <div class="form-group full">
                    <label>Product Description</label>
                    <textarea name="description" rows="5" placeholder="Enter product description">{{ old('description') }}</textarea>
                </div>

            </div> <!-- form-grid end -->

            <hr style="margin:30px 0;">

            <!-- ================= BUTTONS ================= -->
            <div style="display:flex;justify-content:flex-end;gap:15px;flex-wrap:wrap;">

                <button type="reset" class="btn-back">
                    <i class="ti ti-refresh"></i>
                    Reset
                </button>

                <button type="submit" style="background:#534AB7;color:#fff;border:none;padding:12px 28px;border-radius:8px;cursor:pointer;">
                    <i class="ti ti-device-floppy"></i>
                    Save Product
                </button>

            </div>

            </form>
        </div>
    </div>
</div>
                <!-- END FORM GRID -->
            </div>

            <!-- ================= FORM END ================= -->
        </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
/* =========================================
   IMAGE PREVIEW FUNCTION
========================================= */
document.getElementById('productImage')?.addEventListener('change', function(event){

    const reader = new FileReader();

    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = "block";
    };

    if(event.target.files[0]){
        reader.readAsDataURL(event.target.files[0]);
    }
});

/* =========================================
   AUTO PRODUCT ID GENERATOR
========================================= */
window.addEventListener('load', function(){

    let random = Math.floor(Math.random() * 90000) + 10000;
    document.getElementById('productId').innerText = 'PRD-' + random;

});

/* =========================================
   PRICE VALIDATION (NO NEGATIVE)
========================================= */
document.querySelector('input[name="price"]')?.addEventListener('input', function(){

    if(this.value < 0){
        this.value = 0;
    }

});

/* =========================================
   QUANTITY VALIDATION (NO NEGATIVE)
========================================= */
document.querySelector('input[name="quantity"]')?.addEventListener('input', function(){

    if(this.value < 0){
        this.value = 0;
    }

});

/* =========================================
   FORM CONFIRMATION
========================================= */
document.querySelector('form')?.addEventListener('submit', function(e){

    if(!confirm('Do you want to save this product?')){
        e.preventDefault();
    }

});
</script>

@endpush