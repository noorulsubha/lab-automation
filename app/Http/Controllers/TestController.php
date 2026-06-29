<?php
// ============================================
// TEST CONTROLLER - FINAL FIXED VERSION
// Location: app/Http/Controllers/TestController.php
// Purpose: Handles all test record operations
// Pages: Add Test(4), Search(5), All Records(6)
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;

class TestController extends Controller
{
    // ----------------------------------------
    // create()
    // URL: GET /tests/create
    // Purpose: Show add new test form - Page 4
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
        // Validate all form inputs
        $request->validate([
            'product_id'    => 'required|max:10',
            'test_type'     => 'required',
            'tester_name'   => 'required|min:3',
            'test_date'     => 'required|date',
            'result'        => 'required',
            'remarks'       => 'required|min:10',
            'product_image' => 'nullable|image|max:2048',
        ], [
            'product_id.required'  => 'Product ID is required',
            'product_id.max'       => 'Product ID must be 10 characters',
            'test_type.required'   => 'Please select test type',
            'tester_name.required' => 'Tester name is required',
            'tester_name.min'      => 'Tester name must be at least 3 characters',
            'test_date.required'   => 'Test date is required',
            'result.required'      => 'Please select test result',
            'remarks.required'     => 'Remarks are required',
            'remarks.min'          => 'Remarks must be at least 10 characters',
            'product_image.image'  => 'File must be an image',
            'product_image.max'    => 'Image must be less than 2MB',
        ]);

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $image     = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Save image to public/images/products/ folder
            $image->move(public_path('images/products'), $imageName);
            $imagePath = 'images/products/' . $imageName;
        }

        // Auto generate unique 12 digit test ID
        $testId = Test::generateTestId(
            $request->product_id,
            $request->test_type
        );

        // Save test record to database
        $test                = new Test();
        $test->test_id       = $testId;
        $test->product_id    = $request->product_id;
        $test->test_type     = $request->test_type;
        $test->result        = $request->result;
        $test->remarks       = $request->remarks;
        $test->tester_name   = $request->tester_name;
        $test->test_date     = $request->test_date;
        $test->user_id       = Auth::id();
        $test->product_image = $imagePath;
        $test->save();

        // Go to all records with success message
        return redirect()->route('tests.index')
                         ->with('success',
                           'Test saved! ID: ' . $testId);
    }

    // ----------------------------------------
    // index()
    // URL: GET /tests
    // Purpose: Show all test records - Page 6
    // ----------------------------------------
    public function index()
    {
        // Get all tests newest first - 10 per page
        $tests = Test::orderBy('created_at', 'desc')
                     ->paginate(10);

        // Count totals for summary cards
        $totalTests   = Test::count();
        $passedTests  = Test::where('result', 'pass')->count();
        $failedTests  = Test::where('result', 'fail')->count();
        $pendingTests = Test::where('result', 'pending')->count();

        return view('tests.index', compact(
            'tests',
            'totalTests',
            'passedTests',
            'failedTests',
            'pendingTests'
        ));
    }

    // ----------------------------------------
    // search()
    // URL: GET /tests/search
    // Purpose: Advanced search - Page 5
    // ----------------------------------------
    public function search(Request $request)
    {
        // Start with all tests newest first
        $query = Test::orderBy('created_at', 'desc');

        // Filter by product ID if entered
        if ($request->filled('product_id')) {
            $query->where('product_id', 'like',
                '%' . $request->product_id . '%');
        }

        // Filter by test ID if entered
        if ($request->filled('test_id')) {
            $query->where('test_id', 'like',
                '%' . $request->test_id . '%');
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
            $query->where('tester_name', 'like',
                '%' . $request->tester_name . '%');
        }

        // Filter by date from if entered
        if ($request->filled('date_from')) {
            $query->where('test_date', '>=', $request->date_from);
        }

        // Filter by date to if entered
        if ($request->filled('date_to')) {
            $query->where('test_date', '<=', $request->date_to);
        }

        // Paginate and keep filters in URL
        $tests = $query->paginate(10)->withQueryString();

        // Check if any search was performed
        $searched = $request->hasAny([
            'product_id', 'test_id', 'test_type',
            'result', 'tester_name', 'date_from', 'date_to'
        ]);

        return view('tests.search', compact('tests', 'searched'));
    }
// ----------------------------------------
// printAll()
// URL: GET /tests/print
// Purpose: Print all test records (A4 view)
// ----------------------------------------

public function printAll()
{
    $tests = Test::orderBy('created_at', 'desc')->get();

    return view('tests.print_all', compact('tests'));
}

// ----------------------------------------
// printSingle()
// URL: GET /tests/{id}/print
// Purpose: Print single test record
// ----------------------------------------
public function printSingle($id)
{
    $test = Test::findOrFail($id);

    return view('tests.print_single', compact('test'));
}

    // ----------------------------------------
    // destroy()
    // URL: DELETE /tests/{id}
    // Purpose: Delete one test record
    // ----------------------------------------
    public function destroy($id)
    {
        // Find test or return 404
        $test = Test::findOrFail($id);

        // Delete product image file if exists
        if ($test->product_image) {
            $path = public_path($test->product_image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Delete from database
        $test->delete();

        return back()->with('success',
            'Test record deleted successfully');
    }
}