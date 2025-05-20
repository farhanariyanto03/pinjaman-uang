<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PembatalanPinjamanController extends Controller
{
    public function index()
    {
        $pengajuan =PengajuanPinjaman::where('status', 'menunggu')->get();

        return view('pages.karyawan.pembatalan-pengajuan.pembatalan-pinjaman', [
            'title' => 'Pembatalan Pinjaman',
            'pengajuan' => $pengajuan
        ]);
    }

    public function batalPengajuan(String $id)
    {
        PengajuanPinjaman::where('id_pengajuan_pinjaman', $id)->delete();

        Alert::success('Berhasil', 'Pengajuan berhasil dibatalkan')->autoClose(3000);
        return redirect()->route('karyawan.pembatalan-pengajuan');
    }
}
