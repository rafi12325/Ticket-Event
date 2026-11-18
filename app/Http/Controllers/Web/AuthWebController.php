<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Auth untuk halaman Blade: memakai SESSION (web guard).
// Catatan untuk laporan: API memakai token Sanctum, halaman web
// memakai session — keduanya dicover oleh `auth:sanctum`.
class AuthWebController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(
            auth()->user()->isAdmin() ? route('admin.events.index') : route('events.index'),
        );
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'participant',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('events.index')
            ->with('success', 'Registrasi berhasil! Selamat datang, '.$user->name.'.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('events.index');
    }
}
