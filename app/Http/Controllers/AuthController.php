<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->status == 'submitted') {
            Auth::logout(); // optional: logout if not approved
            return back()->withErrors(['email' => 'Akun Anda masih menunggu persetujuan admin.']);
        }

        if ($user->status == 'rejected') {
            Auth::logout(); // optional: logout if rejected
            return back()->withErrors(['email' => 'Akun Anda ditolak oleh admin.']);
        }

        return redirect()->intended('dasbor');
    }

    return back()->withErrors([
        'email' => 'Terjadi kesalahan, boleh dicek kembali email atau password Anda.',
    ])->onlyInput('email');
    }
}