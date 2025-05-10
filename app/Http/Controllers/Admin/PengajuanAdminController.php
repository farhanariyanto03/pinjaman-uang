<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanAdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.pengajuan.pengajuan', [
            'title' => 'Pengajuan',
            'pengajuan_menunggu' => PengajuanPinjaman::where('status', 'menunggu')->get(),
            'pengajuan_diterima' => PengajuanPinjaman::where('status', 'diterima')->get(),
            'pengajuan_lunas' => PengajuanPinjaman::where('status', 'lunas')->get(),
            'pengajuan_ditolak' => PengajuanPinjaman::where('status', 'ditolak')->get(),
        ]);
    }

    public function updateStatusDiterima(Request $request, $id)
    {
        $pengajuan = PengajuanPinjaman::find($id);
        $pengajuan->status = 'diterima';
        $pengajuan->updated_at = now();
        $pengajuan->save();

        Alert::success('Berhasil', 'Pengajuan diterima')->autoClose(3000);
        return redirect()->route('admin.pengajuan');
    }

    public function updateStatusDitolak(Request $request, $id)
    {
        $pengajuan = PengajuanPinjaman::find($id);
        $pengajuan->status = 'ditolak';
        $pengajuan->updated_at = now();
        $pengajuan->save();

        Alert::success('Berhasil', 'Pengajuan ditolak')->autoClose(3000);
        return redirect()->route('admin.pengajuan');
    }
}
