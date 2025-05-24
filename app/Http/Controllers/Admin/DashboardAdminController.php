<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanPinjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard.dashboard', [
            'title' => 'Dashboard',
            'pengajuan' => PengajuanPinjaman::where('status', 'menunggu')->count(),
            'lunas' => PengajuanPinjaman::where('status', 'lunas')->count(),
            'karyawan' => User::where('role', 'karyawan')->count(),
        ]);
    }
}
