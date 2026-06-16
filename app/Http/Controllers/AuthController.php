<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===== SHOW LOGIN PAGE =====
    public function showLogin()
    {
        // kalau sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // ===== LOGIN =====
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password,
            'is_active' => true,
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            // ✅ selalu ke dashboard setelah login
            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors([
                'login_error' => 'Email atau password salah atau akun tidak aktif.',
            ])
            ->withInput();
    }

    // ===== REGISTER =====
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // ===== LOGOUT =====
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // ✅ langsung ke welcome (homepage)
    return redirect()->route('welcome');
}
}