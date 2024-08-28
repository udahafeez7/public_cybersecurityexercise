<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use App\Models\Admin; //use the table admin in database

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

    public function AdminForgetPassword()
    {
        return view('admin.forget_password');
    }

    public function AdminPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $admin_data = Admin::where('email', $request->email)->first(); //to check the admin emails is exsist in table
        if (!$admin_data) { //if admin data not exsist
            return redirect()->back()->with('error', 'You are not listed as Administrator');
        }
        $token = hash('sha256', time()); //give token to admin
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = "Your Reset Password Request";
        $message = "Please proceed on the link below to reset your password.<br>";
        $message .= "<a href='" . $reset_link . " '>Visit Through Here</a>";

        \Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->back()->with('success', 'Reset Password Successful Send on Your Email');
    }
}