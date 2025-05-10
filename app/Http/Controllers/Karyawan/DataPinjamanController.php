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

        $menunggu = $data->where('status', 'menunggu');
        $diterima = $data->where('status', 'diterima');
        $lunas = $data->where('status', 'lunas');
        $ditolak = $data->where('status', 'ditolak');

        return view('pages.karyawan.ajukan-pinjaman.data-pinjaman', [
            'title' => 'Data Pinjaman',
            'status_menunggu' => $menunggu,
            'status_diterima' => $diterima,
            'status_lunas' => $lunas,
            'status_ditolak' => $ditolak,
        ]);
    }
}
