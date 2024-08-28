<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminLogin()
    {
        return view('admin.login'); //create login.blade.php in resources -> views
    }
    public function AdminDashboard()
    {
        return view('admin.admin_dashboard'); //create admin_dashboard.blade.php in resources -> views
    }
}