<?php
// ============================================
// REPORT CONTROLLER
// Location: app/Http/Controllers/ReportController.php
// Purpose: Handles test reports page
// Shows statistics, charts and full test list
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class ReportController extends Controller
{
    // ----------------------------------------
    // index()
    // ----------------------------------------
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $tests = Test::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalTests   = $tests->count();
        $passedTests  = $tests->where('result', 'pass')->count();
        $failedTests  = $tests->where('result', 'fail')->count();
        $pendingTests = $tests->where('result', 'pending')->count();

        $passRate = $totalTests > 0
            ? round(($passedTests / $totalTests) * 100)
            : 0;

        $testsByType = Test::whereYear('created_at', $year)
            ->selectRaw('
                test_type,
                COUNT(*) as total,
                SUM(result = "pass") as passed,
                SUM(result = "fail") as failed,
                SUM(result = "pending") as pending
            ')
            ->groupBy('test_type')
            ->get();

        $monthlyData = Test::whereYear('created_at', $year)
            ->selectRaw('
                MONTH(created_at) as month,
                COUNT(*) as total,
                SUM(result = "pass") as passed,
                SUM(result = "fail") as failed
            ')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $availableYears = Test::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($availableYears->isEmpty()) {
            $availableYears = collect([date('Y')]);
        }

        return view('reports.index', compact(
            'tests',
            'totalTests',
            'passedTests',
            'failedTests',
            'pendingTests',
            'passRate',
            'testsByType',
            'monthlyData',
            'availableYears',
            'year'
        ));
    }
// ----------------------------------------
// Print Report
// ----------------------------------------
public function print(Request $request)
{
    $year = $request->get('year', date('Y'));

    $tests = Test::whereYear('created_at', $year)
                 ->orderBy('created_at', 'desc')
                 ->get();

    $totalTests   = $tests->count();
    $passedTests  = $tests->where('result', 'pass')->count();
    $failedTests  = $tests->where('result', 'fail')->count();
    $pendingTests = $tests->where('result', 'pending')->count();

    $passRate = $totalTests > 0
        ? round(($passedTests / $totalTests) * 100)
        : 0;

    return view('reports.print', compact(
        'tests',
        'year',
        'totalTests',
        'passedTests',
        'failedTests',
        'pendingTests',
        'passRate'
    ));

    }
}