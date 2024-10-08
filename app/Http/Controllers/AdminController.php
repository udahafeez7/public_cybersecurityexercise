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
        return view('admin.index'); // Ensure admin_dashboard.blade.php exists in resources/views/admin
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
    public function AdminResetPassword($token, $email)
    {
        $admin_data = Admin::where('email', $email)->where('token', $token)->first(); //matching the email and token

        if (!$admin_data) {
            return redirect()->route('admin.login')->with('error', 'Email and Token did not MATCH');
        }
        return view('admin.reset_password', compact('token', 'email'));
    }
    public function AdminResetPasswordSubmit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $admin_data = Admin::where('email', $request->email)->where('token', $request->token)->first();
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = "";
        $admin_data->update(); //update the password

        return redirect()->route('admin.login')->with('success', 'You should not forgetting your new password');
    }
    public function AdminProfile()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::guard('admin')->id();
        $data = Admin::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;

            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                $this->deleteOldImage($oldPhotoPath);
            }
        }
        $data->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Method
    private function deleteOldImage(string $oldPhotoPath): void
    {
        $fullPath = public_path('upload/admin_images/' . $oldPhotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
    public function AdminChangePassword()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_change_Password', compact('profileData'));
    }
    public function AdminPasswordUpdate(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, $admin->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        /// Update the new password
        Admin::whereId($admin->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'You have Successfully Change the password',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    // End Method
}
