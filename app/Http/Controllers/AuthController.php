<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Login Page
    |--------------------------------------------------------------------------
    | If the user is already authenticated, redirect to the dashboard.
    | Otherwise, display the login page.
    |--------------------------------------------------------------------------
    */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Authenticate User
    |--------------------------------------------------------------------------
    | Validate the login request, authenticate the user,
    | create a new session and redirect to the dashboard.
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        // Validate user input
        $request->validate([
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:6',
        ], [
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
            'username.min'      => 'Username must be at least 3 characters.',
            'password.min'      => 'Password must be at least 6 characters.',
        ]);

        // Create authentication credentials
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // Attempt user authentication
        if (Auth::attempt($credentials)) {

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Store user information in the session
            session([
                'user_name' => Auth::user()->name,
                'user_role' => Auth::user()->role,
            ]);

            // Redirect authenticated user to dashboard
            return redirect()->route('dashboard')
                ->with('success', 'Login Successful!');
        }

        // Redirect back if authentication fails
        return back()
            ->withInput($request->only('username'))
            ->withErrors([
                'username' => 'Invalid Username or Password.'
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Logout User
    |--------------------------------------------------------------------------
    | Log out the authenticated user, invalidate the session,
    | regenerate the CSRF token and redirect to the login page.
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logged out successfully.');
    }
}