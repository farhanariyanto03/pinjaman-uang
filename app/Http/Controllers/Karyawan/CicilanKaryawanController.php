<?php

namespace App\Http\Controllers\Karyawan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Models\PembayaranPinjaman;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CicilanKaryawanController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $cicilanBelumLunas = PengajuanPinjaman::with(['user', 'pinjaman', 'detailPinjaman', 'pembayaranPinjaman'])
            ->where('status', 'diterima')
            ->whereHas('pembayaranPinjaman', function ($query) use ($today) {
                $query->where('status', 'menunggu');
            })
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

        $cicilanLunas = PengajuanPinjaman::with(['user', 'pinjaman', 'detailPinjaman', 'pembayaranPinjaman'])
            ->where('status', 'diterima')
            ->whereHas('pembayaranPinjaman', function ($query) use ($today) {
                $query->where('status', 'diterima');
            })
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
            'cicilanBelumLunas' => $cicilanBelumLunas,
            'cicilanLunas' => $cicilanLunas,
        ]);
    }

    public function pembayaranCicilan(string $id)
    {
        $cicilan = PengajuanPinjaman::with('pinjaman')
            ->where('id_pengajuan_pinjaman', $id)
            ->first();

        return view('pages.karyawan.cicilan-karyawan.pembayaran-cicilan', [
            'title' => 'Pembayaran Cicilan',
            'cicilan' => $cicilan,
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
