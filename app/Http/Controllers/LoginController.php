<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login.login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        $cekLogoin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($cekLogoin)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role == 'karyawan') {
                return redirect()->route('karyawan.dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password anda salah.');
        }
    }

    public function register()
    {
        return view('pages.login.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
