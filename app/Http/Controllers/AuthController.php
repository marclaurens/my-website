<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if ($request->password === 'admin123') {
            session(['is_admin' => true]);
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'Invalid password.');
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}