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
            'pengajuan' => PengajuanPinjaman::all()
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
