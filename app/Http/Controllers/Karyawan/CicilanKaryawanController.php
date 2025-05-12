<?php

namespace App\Http\Controllers\Karyawan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Http\Controllers\Controller;

class CicilanKaryawanController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $cicilan = PengajuanPinjaman::with(['user', 'pinjaman', 'detailPinjaman', 'pembayaranPinjaman'])
            ->where('status', 'diterima')
            ->get()
            ->map(function ($item) use ($today) {
                $approvedDate = Carbon::parse($item->updated_at);
                $tenor = $item->pinjaman->tenor ?? 0;

                // Hitung bulan yang sudah berjalan sejak disetujui
                $monthsPassed = $approvedDate->diffInMonths($today);

                // Ambil jumlah pembayaran yang sudah diterima
                $paidMonths = $item->pembayaranPinjaman
                    ->where('status', 'diterima')
                    ->count();

                // Hitung sisa cicilan berdasarkan tenor dan jumlah pembayaran
                $sisaCicilan = $tenor - $paidMonths;

                // Jika sudah lebih dari tenor bulan dan belum lunas, bisa dianggap lewat jatuh tempo
                $item->sisa_cicilan = max($sisaCicilan, 0);
                $item->bulan_berjalan = $monthsPassed;
                $item->harus_bayar_bulan_ini = $paidMonths < $monthsPassed;

                return $item;
            });

        return view('pages.karyawan.cicilan-karyawan.cicilan-karyawan', [
            'title' => 'Cicilan Karyawan',
            'cicilan' => $cicilan,
        ]);
    }

    public function pembayaranCicilan()
    {
        return view('pages.karyawan.cicilan-karyawan.pembayaran-cicilan');
    }
}
