<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $informasi_pribadi = $user->informasiPribadi;

        return view('pages.karyawan.profile.profile', [
            'user' => $user,
            'informasi_pribadi' => $informasi_pribadi
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input (sesuaikan kebutuhan)
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed', // kalau pakai konfirmasi password
            'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data dasar user
        $user->nama = $request->firstName;
        $user->alamat = $request->lastName;
        $user->email = $request->email;
        $user->no_hp = $request->input('no_hp'); // jika ada input no_hp di form, jangan lupa tambahkan di form juga ya

        // Update password jika ada input password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan user
        $user->save();

        // Update foto - simpan ke folder 'public/foto_users' atau folder lain sesuai kebutuhan
        $informasi = $user->informasiPribadi;

        if ($request->hasFile('foto_user')) {
            // Hapus foto lama jika ada
            if ($informasi->foto_user && Storage::exists($informasi->foto_user)) {
                Storage::delete($informasi->foto_user);
            }
            $path = $request->file('foto_user')->store('public/foto_users');
            $informasi->foto_user = Storage::url($path);
        }

        if ($request->hasFile('foto_kk')) {
            if ($informasi->foto_kk && Storage::exists($informasi->foto_kk)) {
                Storage::delete($informasi->foto_kk);
            }
            $path = $request->file('foto_kk')->store('public/foto_kk');
            $informasi->foto_kk = Storage::url($path);
        }

        if ($request->hasFile('foto_ktp')) {
            if ($informasi->foto_ktp && Storage::exists($informasi->foto_ktp)) {
                Storage::delete($informasi->foto_ktp);
            }
            $path = $request->file('foto_ktp')->store('public/foto_ktp');
            $informasi->foto_ktp = Storage::url($path);
        }

        $informasi->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
