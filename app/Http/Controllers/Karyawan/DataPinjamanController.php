<?php

namespace App\Http\Controllers\Karyawan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataPinjamanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $data = PengajuanPinjaman::with('pembayaranPinjaman')
            ->where('id_user', $userId)
            ->get();

        foreach ($data as $item) {
            $jatuhTempo = Carbon::parse($item->jatuh_tempo);
            $dibuat = Carbon::parse($item->updated_at);

            $sisaBulanDecimal = $dibuat->floatDiffInMonths($jatuhTempo, false);
            $totalSisaBulan = round($sisaBulanDecimal);

            // Hitung jumlah cicilan yang telah dibayar berdasarkan status 'diterima'
            $cicilanDibayar = $item->pembayaranPinjaman->where('status', 'diterima')->count();

            // Kurangi sisa bulan dengan jumlah cicilan yang sudah dibayar
            $sisaCicilan = max($totalSisaBulan - $cicilanDibayar, 0);

            $item->sisa_cicilan = $sisaCicilan;
        }

        // Filter data berdasarkan status dan sisa_cicilan
        $diterima = $data->filter(function ($item) {
            return $item->status === 'diterima' && $item->sisa_cicilan > 0;
        });

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
