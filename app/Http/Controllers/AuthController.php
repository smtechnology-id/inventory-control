<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Menentukan level akses berdasarkan email
            $user = Auth::user();
            if ($user->level === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->level === 'supervisor') {
                return redirect()->route('supervisor.dashboard');
            } elseif ($user->level === 'staff') {
                return redirect()->route('staff.dashboard');
            }
        }

        return back()->withErrors(['password' => 'Password yang anda masukkan salah!']);
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
