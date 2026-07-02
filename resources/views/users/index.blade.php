{{-- ==========================================================
| FILE : resources/views/users/index.blade.php
| MODULE : User Management
| PURPOSE : Display All Users
========================================================== --}}

@extends('layouts.app')

@section('title','Users | SRS Lab Automation')

@push('styles')

<style>

/* ==========================================================
   PAGE
========================================================== */

.users-page{

    padding:30px;
    max-width:1300px;
    margin:auto;

}

/* ==========================================================
   HEADER
========================================================== */

.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;

}

.page-title{

    font-size:28px;
    font-weight:700;
    color:#26215C;

}

/* ==========================================================
   BUTTON
========================================================== */

.btn-add{

    background:#534AB7;
    color:white;
    text-decoration:none;
    padding:12px 22px;
    border-radius:8px;
    display:inline-flex;
    align-items:center;
    gap:8px;

}

.btn-add:hover{

    background:#3E3693;

}

/* ==========================================================
   SEARCH BOX
========================================================== */

.search-box{

    background:white;
    padding:18px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 3px 12px rgba(0,0,0,.08);

}

.search-box input{

    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;

}

/* ==========================================================
   STATS
========================================================== */

.stats{

    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:25px;

}

.stat-card{

    background:white;
    border-radius:12px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);

}

.stat-card h2{

    color:#534AB7;
    font-size:32px;

}

.stat-card p{

    color:#666;

}

/* ==========================================================
   TABLE
========================================================== */

.table-card{

    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);

}

table{

    width:100%;
    border-collapse:collapse;

}

thead{

    background:#534AB7;
    color:white;

}

th,td{

    padding:15px;
    text-align:left;

}

tbody tr:nth-child(even){

    background:#F7F7FC;

}

tbody tr:hover{

    background:#EEEAFE;

}

.action-btn{

    color:#534AB7;
    margin-right:10px;
    text-decoration:none;

}

</style>

@endpush

@section('content')

<div class="users-page">

<div class="page-header">

<div>

<h1 class="page-title">

<i class="ti ti-users"></i>

User Management

</h1>

<p>

Manage all system users.

</p>

</div>

<a
href="{{ route('users.create') }}"
class="btn-add">

<i class="ti ti-user-plus"></i>

Add New User

</a>

</div>

<!-- Search -->

<div class="search-box">

<input
type="text"
placeholder="Search users...">

</div>

<!-- Statistics -->

<div class="stats">

<div class="stat-card">

<h2>20</h2>

<p>Total Users</p>

</div>

<div class="stat-card">

<h2>16</h2>

<p>Active Users</p>

</div>

<div class="stat-card">

<h2>4</h2>

<p>Inactive Users</p>

</div>

<div class="stat-card">

<h2>3</h2>

<p>Administrators</p>

</div>

</div>

<!-- User Table -->

<div class="table-card">

<table>

<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Role</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<tr>

<td>USR-1001</td>

<td>Ali Khan</td>

<td>ali@gmail.com</td>

<td>Administrator</td>

<td>Active</td>

<td>

<a href="#" class="action-btn">

<i class="ti ti-eye"></i>

</a>

<a href="#" class="action-btn">

<i class="ti ti-edit"></i>

</a>

<a href="#" class="action-btn">

<i class="ti ti-trash"></i>

</a>

</td>

</tr>
<tr>
<td>USR-1002</td>
<td>Ahmed Raza</td>
<td>ahmed@gmail.com</td>
<td>Technician</td>
<td>Active</td>
<td>
<a href="#" class="action-btn"><i class="ti ti-eye"></i></a>
<a href="#" class="action-btn"><i class="ti ti-edit"></i></a>
<a href="#" class="action-btn"><i class="ti ti-trash"></i></a>
</td>
</tr>

<tr>
<td>USR-1003</td>
<td>Fatima Noor</td>
<td>fatima@gmail.com</td>
<td>Lab Manager</td>
<td>Inactive</td>
<td>
<a href="#" class="action-btn"><i class="ti ti-eye"></i></a>
<a href="#" class="action-btn"><i class="ti ti-edit"></i></a>
<a href="#" class="action-btn"><i class="ti ti-trash"></i></a>
</td>
</tr>

<tr>
<td>USR-1004</td>
<td>Usman Ali</td>
<td>usman@gmail.com</td>
<td>Operator</td>
<td>Active</td>
<td>
<a href="#" class="action-btn"><i class="ti ti-eye"></i></a>
<a href="#" class="action-btn"><i class="ti ti-edit"></i></a>
<a href="#" class="action-btn"><i class="ti ti-trash"></i></a>
</td>
</tr>

</tbody>
</table>
</div>

@if(session('success'))
<div style="margin-top:20px;padding:15px;background:#E8F8F0;border-left:5px solid #28a745;border-radius:8px;color:#155724;">
<i class="ti ti-circle-check"></i>
{{ session('success') }}
</div>
@endif

@endsection

@push('scripts')
<script>
// Search Filter
const search=document.querySelector(".search-box input");
search.addEventListener("keyup",function(){
let value=this.value.toLowerCase();
let rows=document.querySelectorAll("tbody tr");
rows.forEach(function(row){
let text=row.innerText.toLowerCase();
row.style.display=text.indexOf(value)>-1?"":"none";
});
});

// Delete Confirmation
document.querySelectorAll(".ti-trash").forEach(function(btn){
btn.parentElement.addEventListener("click",function(e){
if(!confirm("Are you sure you want to delete this user?")){
e.preventDefault();
}
});
});
</script>
@endpush