<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {   
        // Validasi
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);
        $data['password'] = Hash::make($data['password']);

        // Buat user baru
        User::create($data);

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Registration successful');
    }
}
