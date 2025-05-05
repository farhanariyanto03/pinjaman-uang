<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use App\Models\DetailPengajuan;
use App\Models\PengajuanPinjaman;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AjukanPinjamanController extends Controller
{
    public function index()
    {
        return view('pages.karyawan.ajukan-pinjaman', [
            'title' => 'Ajukan Pinjaman',
            'pinjaman' => Pinjaman::all()
        ]);
    }

    public function storePengajuan(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_pinjaman' => 'required|numeric',
                'tujuan_pinjaman' => 'required',
                'alasan_peminjaman' => 'required',
            ]);

            $pinjaman = Pinjaman::findOrFail($validatedData['id_pinjaman']);

            // Simulasikan created_at sekarang jika belum ada (karena form tidak mengirimkan)
            $createdAt = now();
            $validatedData['jatuh_tempo'] = $createdAt->copy()->addMonths($pinjaman->tenor);
            $validatedData['id_user'] = 1;
            $validatedData['status'] = 'menunggu';

            $PengajuanPinjaman = PengajuanPinjaman::create([
                'id_pinjaman' => $validatedData['id_pinjaman'],
                'jatuh_tempo' => $validatedData['jatuh_tempo'],
                'id_user' => $validatedData['id_user'],
                'status' => $validatedData['status'],
            ]);

            DetailPengajuan::create([
                'id_pengajuan_pinjaman' => $PengajuanPinjaman->id_pengajuan_pinjaman,
                'tujuan_pinjaman' => $validatedData['tujuan_pinjaman'],
                'alasan_peminjaman' => $validatedData['alasan_peminjaman'],
            ]);

            Alert::success('Berhasil', 'Pengajuan pinjaman berhasil diajukan');
            return redirect()->route('karyawan.data-pinjaman');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pengajuan pinjaman: ' . $e->getMessage(), ['trace' => $e->getTraceAsString(),]);
            Alert::error('Gagal' . $e->getMessage());
            return redirect()->route('karyawan.ajukan-pinjaman');
        }
    }
}
