<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Bunga;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use App\Models\DetailPengajuan;
use App\Models\PengajuanPinjaman;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AjukanPinjamanController extends Controller
{
    public function index()
    {
        return view('pages.karyawan.ajukan-pinjaman.ajukan-pinjaman', [
            'title' => 'Ajukan Pinjaman',
            'bunga' => Bunga::latest()->first(),
        ]);
    }

    public function storePengajuan(Request $request)
    {
        $id_user = Auth::user()->id;
        $bunga = Bunga::latest()->first();

        try {
            $validatedData = $request->validate([
                'jumlah_pinjaman' => 'required|numeric',
                'tenor' => 'required|numeric',
                'tujuan_pinjaman' => 'required',
                'alasan_peminjaman' => 'required',
            ], [
                'jumlah_pinjaman.required' => 'Jumlah pinjaman harus diisi',
                'tenor.required' => 'Tenor harus diisi',
                'tujuan_pinjaman.required' => 'Tujuan pinjaman harus diisi',
                'alasan_peminjaman.required' => 'Alasan peminjaman harus diisi',
            ]);

            $jumlah = $request->jumlah_pinjaman;
            $tenor = $request->tenor;
            $bungaPerBulan = $bunga->bunga;

            // dd($jumlah, $tenor, $bungaPerBulan);

            // Hitung bunga total (flat)
            $bungaTotal = $jumlah * ($bungaPerBulan / 100) * $tenor;
            $jumlahKotor = $jumlah + $bungaTotal;
            $angsuranBulanan = $jumlahKotor / $tenor;

            // Isi data tambahan
            $createdAt = now();
            $validatedData['id_user'] = $id_user;
            $validatedData['id_bunga'] = $bunga->id_bunga;
            $validatedData['jumlah_kotor'] = $jumlahKotor;
            $validatedData['angsuran_per_bulanan'] = $angsuranBulanan;
            $validatedData['jatuh_tempo'] = $createdAt->copy()->addMonths((int) $tenor);
            $validatedData['status'] = 'menunggu';

            // Simpan pengajuan
            $pengajuan = PengajuanPinjaman::create($validatedData);

            // Simpan detail pengajuan
            DetailPengajuan::create([
                'id_pengajuan_pinjaman' => $pengajuan->id_pengajuan_pinjaman,
                'tujuan_pinjaman' => $request->tujuan_pinjaman,
                'alasan_peminjaman' => $request->alasan_peminjaman,
            ]);

            Alert::success('Berhasil', 'Pengajuan pinjaman berhasil diajukan');
            return redirect()->route('karyawan.data-pinjaman');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pengajuan pinjaman: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data');
            return redirect()->route('karyawan.ajukan-pinjaman');
        }
    }
}
