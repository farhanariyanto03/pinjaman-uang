<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Http\Controllers\Controller;

class DataPinjamanController extends Controller
{
    public function index()
    {
        return view('pages.karyawan.data-pinjaman', [
            'title' => 'Data Pinjaman',
            'pengajuan_pinjaman' => PengajuanPinjaman::all()
        ]);
    }
}
