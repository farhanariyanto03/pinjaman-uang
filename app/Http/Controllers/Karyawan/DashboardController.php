<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pinjamanAktif = PengajuanPinjaman::where('id_user', Auth::id())->where('status', 'diterima')->count();
        $pinjamanLunas = PengajuanPinjaman::where('id_user', Auth::id())->where('status', 'lunas')->count();
        $pinjamanDitolak = PengajuanPinjaman::where('id_user', Auth::id())->where('status', 'ditolak')->count();

        return view('pages.karyawan.dashboard.dashboard', [
            'title' => 'Dashboard',
            'pinjamanAktif' => $pinjamanAktif,
            'pinjamanLunas' => $pinjamanLunas,
            'pinjamanDitolak' => $pinjamanDitolak
        ]);
    }
}
