<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /* ==========================================================
    | Display All Users
    | URL : /users
    ========================================================== */
    public function index()
    {
        // Temporary page until database integration
        return view('users.index');
    }

    /* ==========================================================
    | Show Add New User Form
    | URL : /users/create
    ========================================================== */
    public function create()
    {
        return view('users.create');
    }

    /* ==========================================================
    | Store New User
    | URL : POST /users
    ========================================================== */
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'full_name' => 'required|max:100',
            'email'     => 'required|email',
            'username'  => 'required|max:50',
            'password'  => 'required|min:6',
            'role'      => 'required',
            'status'    => 'required',
        ]);

        // Database save will be added later

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully.');
    }

    /* ==========================================================
    | Edit User
    ========================================================== */
    public function edit($id)
    {
        return view('users.edit');
    }

    /* ==========================================================
    | Update User
    ========================================================== */
    public function update(Request $request, $id)
    {
        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /* ==========================================================
    | Delete User
    ========================================================== */
    public function destroy($id)
    {
        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}