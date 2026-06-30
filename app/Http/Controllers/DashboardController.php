<?php
// ============================================
// DASHBOARD CONTROLLER - SIMPLE VERSION
// Location: app/Http/Controllers/DashboardController.php
// Purpose: Testing dashboard without DB queries
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get logged in user
        $user = Auth::user();

        // Temporary static data for testing
        // Will be replaced with DB queries later
        
        $totalTests = 0;
        $testsPassed = 0;
        $testsFailed = 0;
        $pendingTests = 0;
        $totalProducts = 0;
        $recentTests = [];


        // Chart data - empty for now
        $chartData = [
            'pass'    => 0,
            'fail'    => 0,
            'pending' => 0,
        ];

        // Monthly data - empty for now
        $monthlyData = collect([]);

        return view('dashboard', compact(
        'user',
        'totalTests',
        'testsPassed',
        'testsFailed',
        'pendingTests',
        'totalProducts',
        'recentTests',
        'chartData',
        'monthlyData'
));
    }
}