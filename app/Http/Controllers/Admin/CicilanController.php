<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PembayaranPinjaman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CicilanController extends Controller
{
    public function index()
    {
        $pembayaran = PembayaranPinjaman::with('pengajuan.user')
            ->where('status', 'menunggu')
            ->get();

        $pembayaranDiterima = PembayaranPinjaman::with('pengajuan.user')
            ->where('status', 'diterima')
            ->get();

        $pembayaranDitolak = PembayaranPinjaman::with('pengajuan.user')
            ->where('status', 'ditolak')
            ->get();


        return view('pages.admin.cicilan.cicilan', [
            'title' => 'Cicilan',
            'pembayaranMenunggu' => $pembayaran,
            'pembayaranDiterima' => $pembayaranDiterima,
            'pembayaranDitolak' => $pembayaranDitolak
        ]);
    }

    public function diterima($id)
    {
        $pembayaran = PembayaranPinjaman::find($id);
        $pembayaran->status = 'diterima';
        $pembayaran->save();

        // Hitung total pembayaran yang diterima
        $jumlahPembayaranDiterima = $pembayaran->where('status', 'diterima')->count();

        // Jika semua pembayaran telah diterima ubah status pengajuan menjadi 'diterima'
        if ($jumlahPembayaranDiterima === $pembayaran->pengajuan->tenor) {
            $pembayaran->pengajuan->status = 'Lunas';
            $pembayaran->pengajuan->save();
        }

        Alert::success('Berhasil', 'Pembayaran diterima')->autoClose(3000);
        return redirect()->route('admin.cicilan');
    }

    public function ditolak($id)
    {
        $pembayaran = PembayaranPinjaman::find($id);
        $pembayaran->status = 'ditolak';
        $pembayaran->save();
        Alert::error('Berhasil', 'Pembayaran ditolak')->autoClose(3000);
        return redirect()->route('admin.cicilan');
    }
}
