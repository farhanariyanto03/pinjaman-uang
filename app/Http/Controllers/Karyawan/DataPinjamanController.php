<?php

namespace App\Http\Controllers\Karyawan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Http\Controllers\Controller;

class DataPinjamanController extends Controller
{
    public function index()
    {
        $data = PengajuanPinjaman::with('pinjaman')->get();

        foreach ($data as $item) {
            $jatuhTempo = Carbon::parse($item->jatuh_tempo);
            $dibuat = Carbon::parse($item->created_at);

            $sisaBulanDecimal = $dibuat->floatDiffInMonths($jatuhTempo, false);
            $sisaBulan = round($sisaBulanDecimal);

            $item->sisa_cicilan = $sisaBulan;
        }

        return view('pages.karyawan.ajukan-pinjaman.data-pinjaman', [
            'title' => 'Data Pinjaman',
            'pengajuan_pinjaman' => $data
        ]);
    }
}
