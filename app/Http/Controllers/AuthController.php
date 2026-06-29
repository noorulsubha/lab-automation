<?php
// ============================================
// AUTH CONTROLLER
// Location: app/Http/Controllers/AuthController.php
// Purpose: Handles User Authentication (Login & Logout)
// ============================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ===========================
    // Show Login Page
    // ===========================
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // ===========================
    // Login User
    // ===========================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:6',
        ], [
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
            'username.min'      => 'Username must be at least 3 characters.',
            'password.min'      => 'Password must be at least 6 characters.',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            session([
                'user_name' => Auth::user()->name,
                'user_role' => Auth::user()->role,
            ]);

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Login Successful!');
        }

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Invalid Username or Password.');
    }

    // ===========================
    // Logout User
    // ===========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logged out successfully.');
    }
}