<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function attempt_login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if (Auth::user()->admin == 1) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.login');
        }
        return redirect()->route('user.login');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
