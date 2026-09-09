<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('is_admin')) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Default password is 'password123' or set ADMIN_PASSWORD in your .env file
        $adminPassword = env('ADMIN_PASSWORD', 'password123');

        if ($request->password === $adminPassword) {
            session(['is_admin' => true]);
            return redirect()->route('home')->with('success', 'Logged in as Admin successfully!');
        }

        return back()->withErrors(['password' => 'Incorrect admin password.']);
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}