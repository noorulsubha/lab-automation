<?php
// ============================================
// TEST CONTROLLER - UPDATED
// Location: app/Http/Controllers/TestController.php
// Purpose: Handles all test record operations
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;
use App\Models\Product;

class TestController extends Controller
{
    // ----------------------------------------
    // create()
    // URL: GET /tests/create
    // Purpose: Show add new test form
    // ----------------------------------------
    public function create()
    {
        return view('tests.create');
    }

    // ----------------------------------------
    // store()
    // URL: POST /tests
    // Purpose: Save new test record to database
    // ----------------------------------------
    public function store(Request $request)
    {
        // Validate all form fields
        $request->validate([
            'product_id'  => 'required|size:10',
            'test_type'   => 'required',
            'tester_name' => 'required|min:3',
            'test_date'   => 'required|date',
            'result'      => 'required',
            'remarks'     => 'required|min:10',
        ], [
            'product_id.required'  => 'Product ID is required',
            'product_id.size'      => 'Product ID must be exactly 10 characters',
            'test_type.required'   => 'Please select test type',
            'tester_name.required' => 'Tester name is required',
            'test_date.required'   => 'Test date is required',
            'result.required'      => 'Please select test result',
            'remarks.required'     => 'Remarks are required',
            'remarks.min'          => 'Remarks must be at least 10 characters',
        ]);

        // Auto generate 12 digit unique test ID
        $testId = Test::generateTestId(
            $request->product_id,
            $request->test_type
        );

        // Save test record to database
        Test::create([
            'test_id'     => $testId,
            'product_id'  => $request->product_id,
            'test_type'   => $request->test_type,
            'result'      => $request->result,
            'remarks'     => $request->remarks,
            'tester_name' => $request->tester_name,
            'test_date'   => $request->test_date,
            'user_id'     => Auth::id(),
        ]);

        // Redirect to all records with success message
        return redirect()->route('tests.index')
                         ->with('success',
                           'Test record saved successfully! Test ID: ' . $testId);
    }

    // ----------------------------------------
    // index()
    // URL: GET /tests
    // Purpose: Show all test records with pagination
    // ----------------------------------------
    public function index()
    {
        // Get all tests newest first
        // 10 records per page
        $tests = Test::with('product')
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        return view('tests.index', compact('tests'));
    }

    // ----------------------------------------
    // search()
    // URL: GET /tests/search
    // Purpose: Advanced search with filters
    // ----------------------------------------
    public function search(Request $request)
    {
        // Start building query
        $query = Test::with('product')
                     ->orderBy('created_at', 'desc');

        // Filter by product ID if entered
        if ($request->filled('product_id')) {
            $query->where(
                'product_id', 'like',
                '%' . $request->product_id . '%'
            );
        }

        // Filter by test ID if entered
        if ($request->filled('test_id')) {
            $query->where(
                'test_id', 'like',
                '%' . $request->test_id . '%'
            );
        }

        // Filter by test type if selected
        if ($request->filled('test_type')) {
            $query->where('test_type', $request->test_type);
        }

        // Filter by result if selected
        if ($request->filled('result')) {
            $query->where('result', $request->result);
        }

        // Filter by tester name if entered
        if ($request->filled('tester_name')) {
            $query->where(
                'tester_name', 'like',
                '%' . $request->tester_name . '%'
            );
        }

        // Filter by date from if entered
        if ($request->filled('date_from')) {
            $query->where('test_date', '>=', $request->date_from);
        }

        // Filter by date to if entered
        if ($request->filled('date_to')) {
            $query->where('test_date', '<=', $request->date_to);
        }

        // Get results - 10 per page
        // Keep search filters in pagination links
        $tests = $query->paginate(10)->withQueryString();

        // Count total results found
        $totalFound = $query->count();

        // Check if any search was performed
        $searched = $request->hasAny([
            'product_id', 'test_id', 'test_type',
            'result', 'tester_name', 'date_from', 'date_to'
        ]);

        return view('tests.search', compact(
            'tests',
            'totalFound',
            'searched'
        ));
    }

    // ----------------------------------------
    // destroy()
    // URL: DELETE /tests/{id}
    // Purpose: Delete one test record
    // ----------------------------------------
    public function destroy($id)
    {
        // Find test or show 404
        $test = Test::findOrFail($id);

        // Delete the record
        $test->delete();

        // Go back with success message
        return back()->with('success',
            'Test record deleted successfully');
    }
}