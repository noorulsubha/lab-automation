<?php

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
    // Purpose: Save new test + image to database
    // ----------------------------------------
    public function store(Request $request)
    {
        // Step 1: Validate form fields
        $validated = $request->validate([
            'product_id'    => 'required|size:10',
            'test_type'     => 'required',
            'tester_name'   => 'required|min:3',
            'test_date'     => 'required|date',
            'result'        => 'required',
            'remarks'       => 'required|min:10',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'product_id.required'  => 'Product ID is required',
            'product_id.size'      => 'Product ID must be exactly 10 characters',
            'test_type.required'   => 'Please select test type',
            'tester_name.required' => 'Tester name is required',
            'test_date.required'   => 'Test date is required',
            'result.required'      => 'Please select test result',
            'remarks.required'     => 'Remarks are required',
            'remarks.min'          => 'Remarks must be at least 10 characters',
            'product_image.image'  => 'File must be an image',
            'product_image.max'    => 'Image must be less than 2MB',
        ]);

        // Step 2: Handle image upload
        $imagePath = null;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Save image to public/images/products folder
            $image->move(public_path('images/products'), $imageName);

            $imagePath = 'images/products/' . $imageName;
        }

        // Step 3: Generate unique test ID
        $testId = Test::generateTestId(
            $request->product_id,
            $request->test_type
        );

        // Step 4: Save test record to database
        $test = new Test();

        $test->test_id = $testId;
        $test->product_id = $request->product_id;
        $test->test_type = $request->test_type;
        $test->result = $request->result;
        $test->remarks = $request->remarks;
        $test->tester_name = $request->tester_name;
        $test->test_date = $request->test_date;
        $test->user_id = Auth::id();
        $test->product_image = $imagePath;

        $test->save();

        // Step 5: Redirect with success message
        return redirect()
            ->route('tests.index')
            ->with('success', 'Test saved successfully! Test ID: ' . $testId);
    }

    // ----------------------------------------
    // index()
    // URL: GET /tests
    // Purpose: Show all test records - Page 6
    // ----------------------------------------
    public function index()
    {
        // Get latest test records with pagination
        $tests = Test::orderBy('created_at', 'desc')
                     ->paginate(10);

        // Calculate summary statistics
        $totalTests = Test::count();
        $passedTests = Test::where('result', 'pass')->count();
        $failedTests = Test::where('result', 'fail')->count();
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
        // Start test query
        $query = Test::orderBy('created_at', 'desc');

        // Filter by product ID
        if ($request->filled('product_id')) {
            $query->where(
                'product_id',
                'like',
                '%' . $request->product_id . '%'
            );
        }

        // Filter by test ID
        if ($request->filled('test_id')) {
            $query->where(
                'test_id',
                'like',
                '%' . $request->test_id . '%'
            );
        }

        // Filter by test type
        if ($request->filled('test_type')) {
            $query->where('test_type', $request->test_type);
        }

        // Filter by result
        if ($request->filled('result')) {
            $query->where('result', $request->result);
        }

        // Filter by tester name
        if ($request->filled('tester_name')) {
            $query->where(
                'tester_name',
                'like',
                '%' . $request->tester_name . '%'
            );
        }

        // Filter by starting date
        if ($request->filled('date_from')) {
            $query->where('test_date', '>=', $request->date_from);
        }

        // Filter by ending date
        if ($request->filled('date_to')) {
            $query->where('test_date', '<=', $request->date_to);
        }

        // Get paginated search results
        $tests = $query->paginate(10)->withQueryString();

        // Check whether user searched anything
        $searched = $request->hasAny([
            'product_id',
            'test_id',
            'test_type',
            'result',
            'tester_name',
            'date_from',
            'date_to'
        ]);

        return view('tests.search', compact(
            'tests',
            'searched'
        ));
    }

    // ----------------------------------------
    // destroy()
    // URL: DELETE /tests/{id}
    // Purpose: Delete test record and image
    // ----------------------------------------
    public function destroy($id)
    {
        // Find test record
        $test = Test::findOrFail($id);

        // Delete image if available
        if ($test->product_image) {
            $imagePath = public_path($test->product_image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete test from database
        $test->delete();
        

        // Return with success message
        return back()->with(
            'success',
            'Test record deleted successfully'
        );
    }
}