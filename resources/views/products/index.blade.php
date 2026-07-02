{{-- ==========================================================
| FILE : resources/views/products/index.blade.php
| MODULE : Product Management
| PURPOSE : Display All Products
========================================================== --}}

@extends('layouts.app')

@section('title','Products | SRS Lab Automation')

@push('styles')
<style>
.products-page{padding:30px;max-width:1300px;margin:auto;}
.page-header{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;margin-bottom:25px;}
.page-title{font-size:28px;font-weight:700;color:#26215C;}
.btn-add{background:#534AB7;color:#fff;text-decoration:none;padding:12px 22px;border-radius:8px;display:inline-flex;align-items:center;gap:8px;}
.btn-add:hover{background:#40379D;}
.search-card{background:#fff;padding:20px;border-radius:12px;box-shadow:0 5px 15px rgba(0,0,0,.08);margin-bottom:20px;}
.search-card input{width:100%;padding:12px;border:1px solid #ccc;border-radius:8px;}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:25px;}
.stat-card{background:#fff;border-radius:12px;padding:25px;box-shadow:0 5px 15px rgba(0,0,0,.08);}
.stat-card h2{color:#534AB7;font-size:30px;margin:0;}
.stat-card p{margin-top:8px;color:#666;}
.table-card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,.08);}
table{width:100%;border-collapse:collapse;}
thead{background:#534AB7;color:#fff;}
th,td{padding:15px;text-align:left;}
tbody tr:nth-child(even){background:#F8F8FD;}
tbody tr:hover{background:#EEEAFE;}
.action-btn{color:#534AB7;text-decoration:none;margin-right:10px;font-size:18px;}
.status-active{background:#D4F8E8;color:#198754;padding:4px 10px;border-radius:20px;font-size:13px;}
.status-stock{background:#FFE9CC;color:#E67E22;padding:4px 10px;border-radius:20px;font-size:13px;}
@media(max-width:768px){
.stats{grid-template-columns:1fr;}
.page-header{flex-direction:column;align-items:flex-start;gap:15px;}
.table-card{overflow-x:auto;}
}
</style>
@endpush

@section('content')

<div class="products-page">

<div class="page-header">
<div>
<h1 class="page-title"><i class="ti ti-package"></i> Product Management</h1>
<p>Manage all laboratory products.</p>
</div>

<a href="{{ route('products.create') }}" class="btn-add">
<i class="ti ti-plus"></i>
Add New Product
</a>
</div>

<div class="search-card">
<input type="text" id="searchProduct" placeholder="Search product by name, category or brand...">
</div>

<div class="stats">

<div class="stat-card">
<h2>120</h2>
<p>Total Products</p>
</div>

<div class="stat-card">
<h2>92</h2>
<p>Available</p>
</div>

<div class="stat-card">
<h2>18</h2>
<p>Low Stock</p>
</div>

<div class="stat-card">
<h2>10</h2>
<p>Out of Stock</p>
</div>

</div>

<div class="table-card">

<table>

<thead>
    
<th>Product ID</th>
<th>Product Name</th>
<th>Type</th>
<th>Revision</th>
<th>Description</th>
<th>Image</th>
<th>Status</th>
<th>Action</th>

</thead>

<tbody>

<tr>
<td>PRD-1001</td>
<td>Digital Multimeter</td>
<td>Electrical</td>
<td>Fluke</td>
<td>15</td>
<td>Rs. 12,500</td>
<td><span class="status-active">Available</span></td>
<td>
<a href="#" class="action-btn"><i class="ti ti-eye"></i></a>
<a href="#" class="action-btn"><i class="ti ti-edit"></i></a>
<a href="#" class="action-btn"><i class="ti ti-trash"></i></a>
</td>
</tr>
