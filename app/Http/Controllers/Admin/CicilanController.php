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


        return view('pages.admin.cicilan.cicilan', [
            'title' => 'Cicilan',
            'pembayaran' => $pembayaran
        ]);
    }

    public function diterima($id)
    {
        $pembayaran = PembayaranPinjaman::find($id);
        $pembayaran->status = 'diterima';
        $pembayaran->save();

        Alert::success('Berhasil', 'Pembayaran diterima')->autoClose(3000);
        return redirect()->route('admin.cicilan');
    }
}
