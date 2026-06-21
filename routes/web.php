<?php
// ============================================
// ROUTES FILE - COMPLETE FINAL VERSION
// Location: routes/web.php
// Purpose: All URL routes for entire website
// ============================================

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;

// ==========================================
// PUBLIC ROUTES - No login needed
// ==========================================

// Page 1: Home page
Route::get('/', [HomeController::class, 'index'])
     ->name('home');

// About page - new
Route::get('/about', [HomeController::class, 'about'])
     ->name('about');

// Page 8: Contact page - show form
Route::get('/contact', [ContactController::class, 'index'])
     ->name('contact');

// Page 8: Contact page - submit form
Route::post('/contact', [ContactController::class, 'store'])
     ->name('contact.store');

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
// PROTECTED ROUTES - Login required
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Page 3: Dashboard
    Route::get('/dashboard',
        [DashboardController::class, 'index'])
        ->name('dashboard');

    // Page 4: Show add test form
    Route::get('/tests/create',
        [TestController::class, 'create'])
        ->name('tests.create');

    // Page 4: Save new test
    Route::post('/tests',
        [TestController::class, 'store'])
        ->name('tests.store');

    // Page 5: Search records
    Route::get('/tests/search',
        [TestController::class, 'search'])
        ->name('tests.search');

    // Page 6: All records
    Route::get('/tests',
        [TestController::class, 'index'])
        ->name('tests.index');

    // Page 6: Delete a record
    Route::delete('/tests/{id}',
        [TestController::class, 'destroy'])
        ->name('tests.destroy');

    // Page 7: Reports
    Route::get('/reports',
        [ReportController::class, 'index'])
        ->name('reports.index');

});