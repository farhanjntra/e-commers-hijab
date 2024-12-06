<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Validasi kredensial
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Jika autentikasi berhasil
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil pengguna yang sedang login
            $user = Auth::user();

            // Cek role pengguna
            if ($user->isAdmin === 'admin') {
                return redirect()->intended('/admin'); // Redirect ke halaman admin
            }  else {
                return redirect()->intended('/'); // Redirect ke halaman default
            }
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }



    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
