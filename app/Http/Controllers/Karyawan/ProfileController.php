<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $informasi_pribadi = $user->informasiPribadi;

        return view('pages.karyawan.profile.profile', [
            'title' => 'Profile',
            'user' => $user,
            'informasi_pribadi' => $informasi_pribadi
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, // perbolehkan email user sendiri
            'password' => 'nullable|min:6',
            'alamat' => 'required',
            'no_hp' => 'required',
            'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data user
        $user->nama = $validatedData['nama'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->alamat = $validatedData['alamat'];
        $user->no_hp = $validatedData['no_hp'];
        $user->save();

        // Update data informasi pribadi
        $informasi = $user->informasiPribadi;
        if (!$informasi) {
            $informasi = new \App\Models\InformasiPribadi();
            $informasi->id_user = $user->id;
        }

        $path = 'uploads/';

        if ($request->hasFile('foto_user')) {
            $fotoUser = $request->file('foto_user');
            $fotoUserName = time() . '_' . $fotoUser->getClientOriginalName();
            $fotoUser->move(public_path($path . 'foto_user'), $fotoUserName);
            $informasi->foto_user = $path . 'foto_user/' . $fotoUserName;
        }

        if ($request->hasFile('foto_kk')) {
            $fotoKK = $request->file('foto_kk');
            $fotoKKName = time() . '_' . $fotoKK->getClientOriginalName();
            $fotoKK->move(public_path($path . 'foto_kk'), $fotoKKName);
            $informasi->foto_kk = $path . 'foto_kk/' . $fotoKKName;
        }

        if ($request->hasFile('foto_ktp')) {
            $fotoKTP = $request->file('foto_ktp');
            $fotoKTPName = time() . '_' . $fotoKTP->getClientOriginalName();
            $fotoKTP->move(public_path($path . 'foto_ktp'), $fotoKTPName);
            $informasi->foto_ktp = $path . 'foto_ktp/' . $fotoKTPName;
        }

        $informasi->save();

        Alert::success('Berhasil', 'Data berhasil diperbarui');
        return redirect()->back();
    }
}
