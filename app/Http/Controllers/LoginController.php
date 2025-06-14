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
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            // 'alamat' => 'required',
            // 'no_hp' => 'required',
            // 'foto_user' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // password dan confirm password harus sama
        if ($validatedData['password'] !== $request->konfirmasi_password) {
            return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak sama.');
        }

        $user = User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'karyawan',
            // 'alamat' => $validatedData['alamat'],
            // 'no_hp' => $validatedData['no_hp'],
        ]);

        // $path = 'uploads/';

        // $fotoUser = $request->file('foto_user');
        // $fotoKK = $request->file('foto_kk');
        // $fotoKTP = $request->file('foto_ktp');

        // $fotoUser->move(public_path($path . 'foto_user'), $fotoUser->getClientOriginalName());
        // $fotoKK->move(public_path($path . 'foto_kk'), $fotoKK->getClientOriginalName());
        // $fotoKTP->move(public_path($path . 'foto_ktp'), $fotoKTP->getClientOriginalName());

        InformasiPribadi::create([
            'id_user' => $user->id,
            // 'foto_user' => $path . 'foto_user/' . $fotoUser->getClientOriginalName(),
            // 'foto_kk' => $path . 'foto_kk/' . $fotoKK->getClientOriginalName(),
            // 'foto_ktp' => $path . 'foto_ktp/' . $fotoKTP->getClientOriginalName(),
        ]);

        Alert::success('Berhasil', 'Registrasi Berhasil');
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
