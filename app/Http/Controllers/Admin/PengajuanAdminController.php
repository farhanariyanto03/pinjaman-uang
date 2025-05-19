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

        $validatedData = $request->validate([
            'bunga' => 'required|numeric',
        ], [
            'bunga.required' => 'Bunga harus diisi',
            'bunga.numeric' => 'Bunga harus berupa angka',
        ]);

        // Hitung total bunga
        $total_bunga = ($pengajuan->jumlah_pinjaman * $validatedData['bunga'] / 100) * $pengajuan->tenor;

        // Hitung jumlah kotor
        $pengajuan->jumlah_kotor = $pengajuan->jumlah_pinjaman + $total_bunga;

        // Hitung angsuran per bulan
        $pengajuan->angsuran_per_bulanan = $pengajuan->jumlah_kotor / $pengajuan->tenor;

        $pengajuan->status = 'diterima';
        $pengajuan->bunga = $validatedData['bunga'];
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
