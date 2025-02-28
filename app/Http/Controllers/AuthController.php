<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email_karyawan' => 'required|email',
            'password_karyawan' => 'required'
        ]);

        // Menggunakan email_karyawan sebagai username
        $credentials = [
            'email_karyawan' => $request->email_karyawan,
            'password' => $request->password_karyawan
        ];
        $user = Karyawan::where('email_karyawan', $request->email_karyawan)->first();
        Auth::guard('web')->login($user);
        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/index');
        } elseif ($user->role === 'karyawan') {
            return redirect()->intended('/karyawan/index');
        }
    

        // Jika login gagal
        return back()->withErrors([
            'email_karyawan' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
