<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        // dd('werwe');
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        // dd('wer');
        $this->validate($request, [
            'email'   => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended(route('user.home'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }
}
