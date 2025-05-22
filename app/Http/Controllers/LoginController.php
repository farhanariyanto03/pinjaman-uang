<?php

namespace App\Http\Controllers;

use App\Models\InformasiPribadi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'alamat' => 'required',
            'no_hp' => 'required',
            'foto_user' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'foto_user.required' => 'Foto User harus diisi.',
            'foto_kk.required' => 'Foto Kartu Keluarga harus diisi.',
            'foto_ktp.required' => 'Foto Kartu Tanda Penduduk harus diisi.',
        ]);

        $user = User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'role' => 'karyawan',
        ]);

        $path = 'uploads/';

        $fotoUser = $validatedData['foto_user'];
        $fotoUser->storeAs($path . 'foto_user', $fotoUser->getClientOriginalName());
        $fotoKK = $validatedData['foto_kk'];
        $fotoKK->storeAs($path . 'foto_kk', $fotoKK->getClientOriginalName());
        $fotoKTP = $validatedData['foto_ktp'];
        $fotoKTP->storeAs($path . 'foto_ktp', $fotoKTP->getClientOriginalName());

        InformasiPribadi::create([
            'user_id' => $user->id,
            'foto_user' => $path . 'foto_user/' . $fotoUser->getClientOriginalName(),
            'foto_kk' => $path . 'foto_kk/' . $fotoKK->getClientOriginalName(),
            'foto_ktp' => $path . 'foto_ktp/' . $fotoKTP->getClientOriginalName(),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
