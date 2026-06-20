<?php
// ============================================
// AUTH CONTROLLER
// Location: app/Http/Controllers/AuthController.php
// Purpose: Handles User Authentication (Login & Logout)
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ----------------------------------------
    // showLogin() — Displays the login page
    // URL: GET /login
    // ----------------------------------------
    public function showLogin()
    {
        // If the user is already logged in,
        // redirect them straight to the dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Show the login view
        return view('auth.login');
    }

    // ----------------------------------------
    // login() — Processes the login form submission
    // URL: POST /login
    // ----------------------------------------
    public function login(Request $request)
    {
        // --- Step 1: Validation ---
        // Ensure inputs are provided and meet minimum length requirements
        $credentials = $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:6',
        ], [
            // Custom error messages
            'username.required' => 'The username field is required.',
            'password.required' => 'The password field is required.',
            'username.min'      => 'The username must be at least 3 characters.',
            'password.min'      => 'The password must be at least 6 characters.',
        ]);

        // --- Step 2 & 3: Attempt Authentication ---
        // Auth::attempt automatically finds the user by username,
        // checks the hashed password, and starts the session if valid.
        if (Auth::attempt($credentials)) {
            
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Store extra user info in session if needed
            $user = Auth::user();
            session([
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);

            // Redirect to intended page or dashboard
            return redirect()->intended(route('dashboard'))
                             ->with('success', 'Welcome back, ' . $user->name . '!');
        }

        // --- Step 4: Authentication Failed ---
        // Redirect back to the login page with error and old input
        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Invalid username or password.');
    }

    // ----------------------------------------
    // logout() — Logs the user out
    // URL: POST /logout (Recommended to use POST for logout)
    // ----------------------------------------
    public function logout(Request $request)
    {
        // Log the user out of the application
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect back to the login page
        return redirect()->route('login')
                         ->with('success', 'You have been logged out successfully.');
    }
}