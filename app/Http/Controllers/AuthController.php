<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('/login'); // pastikan view ini ada
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'nama');
    
        $user = \App\Models\User::where('email', $credentials['email'])
                    ->where('name', $credentials['nama']) // cek juga nama
                    ->first();
    
        if ($user && $user->password === $credentials['password']) {
            Auth::login($user);
            return redirect()->intended('/home');
        }
    
        return back()->withErrors([
            'email' => 'Email, nama, atau password salah.',
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
