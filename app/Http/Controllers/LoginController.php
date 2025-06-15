<?php

namespace App\Http\Controllers;

use App\Models\InformasiPribadi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function storeRegister(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'id' => 'required|string|size:8|unique:users,id',  // ID karyawan manual
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'konfirmasi_password' => 'required|same:password', // pastikan cocok
        ]);

        // password dan confirm password harus sama
        if ($validatedData['password'] !== $request->konfirmasi_password) {
            return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak sama.');
        }
        
        $user = User::create([
            'id' => $validatedData['id'], // ID karyawan harus valid
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'karyawan',
        ]);

        if (!$user || !$user->id) {
            return redirect()->back()->with('error', 'Gagal menyimpan data user.');
        }

        InformasiPribadi::create([
            'id_user' => $user->id,
            'foto_ktp' => null,
            'foto_kk' => null,
            'foto_user' => null,
            'kartu_karyawan' => null,
        ]);

        // Berhasil
        Alert::success('Berhasil', 'Registrasi Berhasil');
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
