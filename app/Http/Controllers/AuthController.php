<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ── Login ──────────────────────────────────────────────────────────────
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Mark as returning user
            session(['auth_action' => 'login']);

            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors(['email' => 'Ces identifiants ne correspondent à aucun compte.'])
            ->onlyInput('email');
    }

    // ── Register ───────────────────────────────────────────────────────────
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        session(['auth_action' => 'register']);

        return redirect()->route('dashboard');
    }

    // ── Dashboard ──────────────────────────────────────────────────────────
    public function dashboard()
    {
        $user       = Auth::user();
        $authAction = session('auth_action', 'login'); // 'login' | 'register' | 'google'
        session()->forget('auth_action');

        return view('dashboard.index', compact('user', 'authAction'));
    }

    // ── Logout ─────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
