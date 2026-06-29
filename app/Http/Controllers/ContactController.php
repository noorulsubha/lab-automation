<?php
// ============================================
// CONTACT CONTROLLER
// Location: app/Http/Controllers/ContactController.php
// Purpose: Handles contact page and form submit
// Saves messages to contacts table in database
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    // ----------------------------------------
    // index()
    // URL: GET /contact
    // Purpose: Show contact page with form
    // ----------------------------------------
    public function index()
    {
        return view('contact');
    }

    // ----------------------------------------
    // store()
    // URL: POST /contact
    // Purpose: Validate and save contact message
    // Saves to contacts table in database
    // ----------------------------------------
    public function store(Request $request)
    {
        // Step 1: Validate all form fields
        $request->validate([
            'contact_number'      => 'required|string|max:25',
            'message'             => 'required|string',
            'name'                => 'nullable|string|max:255',
            'company_or_location' => 'nullable|string|max:255',
        ], [
            // Custom error messages
            'contact_number.required' => 'Contact number is required',
            'message.required'        => 'Service details are required',
        ]);

        // Step 2: Save message to contacts table
        // Status default is 'new' - admin has not seen yet
        DB::table('contacts')->insert([
            'name'                => $request->name,
            'company_or_location' => $request->company_or_location,
            'contact_number'      => $request->contact_number,
            'message'             => $request->message,
            'status'              => 'new',
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        // Step 3: Go back to contact page with success
        return redirect()->route('contact')
                         ->with('success',
                           'Your message has been sent successfully!');
    }
}