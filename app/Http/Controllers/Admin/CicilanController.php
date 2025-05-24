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
        $pembayaran = PembayaranPinjaman::findOrFail($id);
        $pembayaran->status = 'diterima';
        $pembayaran->save();

        // Ambil pengajuan terkait
        $pengajuan = $pembayaran->pengajuan;

        // Hitung jumlah pembayaran diterima untuk pengajuan ini
        $jumlahPembayaranDiterima = PembayaranPinjaman::where('id_pengajuan_pinjaman', $pengajuan->id_pengajuan_pinjaman)
            ->where('status', 'diterima')
            ->count();

        // Cek apakah jumlah pembayaran diterima sama dengan tenor
        if ($jumlahPembayaranDiterima >= $pengajuan->tenor) {
            $pengajuan->status = 'lunas';
            $pengajuan->save();
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
