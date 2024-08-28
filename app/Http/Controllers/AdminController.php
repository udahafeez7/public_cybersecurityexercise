<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminLogin()
    {
        return view('admin.login'); // Ensure login.blade.php exists in resources/views/admin
    }

    public function AdminDashboard()
    {
        return view('admin.admin_dashboard'); // Ensure admin_dashboard.blade.php exists in resources/views/admin
    }

    public function AdminLoginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) { // Check if inputted data is valid
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Back Login Successfully'); // Redirect to admin dashboard if credentials are valid
        } else {
            return redirect()->route('admin.login')->with('error', 'Teribbly Sorry Mate Once Again'); // Redirect back to login on failure
        }
    }

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Connection Terminated Successfully');
    }
}