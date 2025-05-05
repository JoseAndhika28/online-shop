<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(Auth::attempt($credential)) {
            $user = Auth::user();
            if ($user->roles === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Login successful');
            } else {
                return redirect()->route('home')->with('success', 'Login successful');
            }
        }
        
        else {
            // Jika gagal login, redirect kembali ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful');
    }
}
