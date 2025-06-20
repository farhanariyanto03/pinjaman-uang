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

    public function updateStatusDiterima($id)
    {
        $pengajuan = PengajuanPinjaman::find($id);
        $pengajuan->status = 'diterima';
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

    public function deleteAllStatusLunas()
    {
        PengajuanPinjaman::where('status', 'lunas')->delete();
        Alert::success('Berhasil', 'Semua pengajuan lunas berhasil dihapus')->autoClose(3000);
        return redirect()->route('admin.pengajuan');
    }

    public function deleteAllStatusDitolak()
    {
        PengajuanPinjaman::where('status', 'ditolak')->delete();
        Alert::success('Berhasil', 'Semua pengajuan ditolak berhasil dihapus')->autoClose(3000);
        return redirect()->route('admin.pengajuan');
    }
}
