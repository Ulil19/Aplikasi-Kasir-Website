<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $kredensial = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'pemilik') {
                return redirect()->intended('pemilik/dashboard');
            } elseif (Auth::user()->role === 'kasir') {
                return redirect()->intended('kasir/transaksi');
            }else {
            Auth::logout();
            return back()->withErrors(['error' => 'Email atau password salah']);
            }
        }

        return back()->withErrors(['error' => 'Email atau password salah']);

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
