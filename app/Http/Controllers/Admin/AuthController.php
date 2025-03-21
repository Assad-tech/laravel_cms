<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'   => 'required|email|exists:admins,email',
            'password' => 'required|min:8'
        ]);
        // dd('sdf');
        // try {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withInput($request->only('email'))->with('error', 'Invalid Email or Password');
        // } catch (Exception $e) {
        // return redirect()->back()->with('error', $e->getMessage());
        // }
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        // dd($admin);
        return view('backend.auth.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'current_password' => 'nullable|required_with:new_password|current_password:admin',
            'new_password' => 'nullable|min:8|confirmed', // Uses 'new_password_confirmation' for confirmation
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($validatedData);
        // Update admin data
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];

        // Update password if provided
        if (!empty($validatedData['new_password'])) {
            $admin->password = Hash::make($validatedData['new_password']);
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = 'admin/assets/images/avatars';
            // Move the file to the desired location in the public directory
            $file->move(public_path($destinationPath), $filename);
            $admin->image =  $filename;
        }

        $admin->save();

        toastr()->success('Profile updated successfully!');

        return redirect()->route('admin.profile');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}

