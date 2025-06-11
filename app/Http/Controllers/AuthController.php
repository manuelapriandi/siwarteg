<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function registerView(){
        return view('pages.auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = 2; // Ini Usernya kayak warga
        $user->saveOrFail();

        return redirect('/')->with('success', 'berhasil menambahkan akun, dimohon untuk menunggu persetujuan admin');
    }


    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}