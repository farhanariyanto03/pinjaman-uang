<?php

namespace App\Http\Controllers\Karyawan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Models\PembayaranPinjaman;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CicilanKaryawanController extends Controller
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

        // $ditolak = $data->filter(function ($item) {
        //     return $item->status === 'ditolak';
        // });

        // $lunas = $data->where('status', 'lunas');
        $ditolak = $data->where('status', 'ditolak');

        return view('pages.karyawan.cicilan-karyawan.cicilan-karyawan', [
            'title' => 'Cicilan Karyawan',
            'cicilanBelumLunas' => $diterima,
            // 'cicilanDitolak' => $ditolak,
            // 'cicilanLunas' => $lunas,
            // 'cicilanDitolak' => $ditolak
        ]);
    }

    public function pembayaranCicilan(string $id)
    {
        $cicilan = PengajuanPinjaman::where('id_pengajuan_pinjaman', $id)->first();

        return view('pages.karyawan.cicilan-karyawan.pembayaran-cicilan', [
            'title' => 'Pembayaran Cicilan',
            'cicilan' => $cicilan,
            'bank' => Bank::all(),
        ]);
    }


    public function storePembayaran(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_pengajuan_pinjaman' => 'required',
                'metode_pembayaran' => 'required',
                'jumlah_uang' => 'required|numeric',
                'bukti_tf' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            $data = [
                'id_pengajuan_pinjaman' => $validatedData['id_pengajuan_pinjaman'],
                'jumlah_pembayaran' => $validatedData['jumlah_uang'],
                'metode_pembayaran' => $validatedData['metode_pembayaran'],
                'tanggal_pembayaran' => now(),
                'status' => 'menunggu',
            ];

            // dd($data);

            // Jika metode transfer dan ada bukti tf
            if ($request->hasFile('bukti_tf')) {
                $file = $request->file('bukti_tf');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/bukti_tf'), $filename);
                $data['bukti_tf'] = $filename;
            }

            Alert::success('Pembayaran Berhasil', 'Pembayaran berhasil ditambahkan.');
            PembayaranPinjaman::create($data);
            return redirect()->route('karyawan.cicilan-karyawan');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pengajuan pinjaman: ' . $e->getMessage(), ['trace' => $e->getTraceAsString(),]);
            Alert::error('Gagal' . $e->getMessage());
            return redirect()->route('karyawan.cicilan-karyawan');
        }
    }
}
