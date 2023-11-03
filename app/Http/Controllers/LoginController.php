<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'              => ['required', 'email'],
            'password'           => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            // if (Auth::user()->role_id == 1) {
            //     return redirect()->intended('superadmin');
            // }

            // if (Auth::user()->role_id == 2) {
            //     return redirect()->intended('admin');
            // }
            return redirect()->intended('dashboard');
        }

        return back()->withInput()->with('msg', '<div class="alert small alert-danger small" role="alert">Email atau Password Salah!</div>');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}