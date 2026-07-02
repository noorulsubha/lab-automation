<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


// =========================
// PUBLIC ROUTES
// =========================


Route::get('/', [HomeController::class, 'index'])->name('welcome')->withoutMiddleware(['auth']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->withoutMiddleware(['auth']);
Route::get('/about', [HomeController::class, 'about'])->name('about')->withoutMiddleware(['auth']);


// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact')->withoutMiddleware(['auth']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->withoutMiddleware(['auth']);


// Login / Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->withoutMiddleware(['auth']);
Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->withoutMiddleware(['auth']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =========================
// PROTECTED ROUTES (Requires Authentication)
// =========================
Route::middleware(['auth'])->group(function () {

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Edit User
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// Update User
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Delete User
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Edit Product
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update Product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Delete Product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Tests CRUD & Search
    Route::get('/tests', [TestController::class, 'index'])->name('tests.index');
    Route::get('/tests/create', [TestController::class, 'create'])->name('tests.create');
    Route::post('/tests', [TestController::class, 'store'])->name('tests.store');
    Route::get('/tests/search', [TestController::class, 'search'])->name('tests.search');
    Route::delete('/tests/{id}', [TestController::class, 'destroy'])->name('tests.destroy');

    // Print Features
    Route::get('/tests/print', [TestController::class, 'printAll'])->name('tests.printAll');
    Route::get('/tests/{id}/print', [TestController::class, 'printSingle'])->name('tests.printSingle');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');

});