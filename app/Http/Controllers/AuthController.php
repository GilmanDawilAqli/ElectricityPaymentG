<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login'); // pastikan view ini ada
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);
    
        // cukup pakai attempt
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();   // proteksi session fixation
            return redirect()->intended('/home');
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();      // Optional: clear session
        $request->session()->regenerateToken(); // Optional: security
    
        return redirect('/');
    }
}
