<?php
// ============================================
// ROUTES FILE - UPDATED FOR PAGE 4
// Location: routes/web.php
// Purpose: All URL routes defined here
// ============================================

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;

// ==========================================
// PUBLIC ROUTES
// These pages open without login
// ==========================================

// Page 1: Home page
Route::get('/', [HomeController::class, 'index'])
     ->name('home');

// Page 8: Contact page
Route::get('/contact', [HomeController::class, 'contact'])
     ->name('contact');

// Page 2: Show login form
Route::get('/login', [AuthController::class, 'showLogin'])
     ->name('login');

// Page 2: Submit login form
Route::post('/login', [AuthController::class, 'login'])
     ->name('login.submit');

// Logout user
Route::get('/logout', [AuthController::class, 'logout'])
     ->name('logout');

// ==========================================
// PROTECTED ROUTES
// Login required to access these pages
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Page 3: Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');

    // Page 4: Show add test form
    Route::get('/tests/create', [TestController::class, 'create'])
         ->name('tests.create');

    // Page 4: Save new test record
    Route::post('/tests', [TestController::class, 'store'])
         ->name('tests.store');

    // Page 5: Search test records
    Route::get('/tests/search', [TestController::class, 'search'])
         ->name('tests.search');

    // Page 6: Show all test records
    Route::get('/tests', [TestController::class, 'index'])
         ->name('tests.index');

    // Page 6: Delete a test record
    Route::delete('/tests/{id}', [TestController::class, 'destroy'])
         ->name('tests.destroy');

});