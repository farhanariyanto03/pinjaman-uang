<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\User;
use App\Models\Bunga;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use App\Models\DetailPengajuan;
use App\Models\InformasiPribadi;
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
        $id_user = Auth::user();
        $bunga = Bunga::latest()->first();
        $informasi = $id_user->informasiPribadi;

        try {
            // Validasi
            $rules = [
                'jenis_kelamin' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'jumlah_pinjaman' => 'required|numeric',
                'tenor' => 'required|numeric',
                'tujuan_pinjaman' => 'required',
                'alasan_peminjaman' => 'required',
            ];

            // Validasi file jika belum ada di database atau ada file baru diupload
            if (!$informasi || !$informasi->foto_kk) {
                $rules['foto_kk'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
            } elseif ($request->hasFile('foto_kk')) {
                $rules['foto_kk'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            }

            if (!$informasi || !$informasi->foto_ktp) {
                $rules['foto_ktp'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
            } elseif ($request->hasFile('foto_ktp')) {
                $rules['foto_ktp'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            }

            if (!$informasi || !$informasi->kartu_karyawan) {
                $rules['kartu_karyawan'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
            } elseif ($request->hasFile('kartu_karyawan')) {
                $rules['kartu_karyawan'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            }

            $validatedData = $request->validate($rules, [
                'jumlah_pinjaman.required' => 'Jumlah pinjaman harus diisi',
                'tenor.required' => 'Tenor harus diisi',
                'tujuan_pinjaman.required' => 'Tujuan pinjaman harus diisi',
                'alasan_peminjaman.required' => 'Alasan peminjaman harus diisi',
            ]);

            // Update user
            $id_user->jenis_kelamin = $validatedData['jenis_kelamin'] == 'laki-laki' ? 'laki-laki' : 'perempuan';
            $id_user->alamat = $validatedData['alamat'];
            $id_user->no_hp = $validatedData['no_hp'];
            $id_user->save();

            // Proses file upload
            $path = 'uploads/';

            // Foto KK
            if ($request->hasFile('foto_kk')) {
                $fotoKKName = $request->file('foto_kk')->getClientOriginalName();
                $request->file('foto_kk')->move(public_path($path . 'foto_kk'), $fotoKKName);
                $fotoKKPath = $path . 'foto_kk/' . $fotoKKName;
            } else {
                $fotoKKPath = $informasi->foto_kk ?? null;
            }

            // Foto KTP
            if ($request->hasFile('foto_ktp')) {
                $fotoKTPName = $request->file('foto_ktp')->getClientOriginalName();
                $request->file('foto_ktp')->move(public_path($path . 'foto_ktp'), $fotoKTPName);
                $fotoKTPPath = $path . 'foto_ktp/' . $fotoKTPName;
            } else {
                $fotoKTPPath = $informasi->foto_ktp ?? null;
            }

            // Kartu Karyawan
            if ($request->hasFile('kartu_karyawan')) {
                $kartuKaryawanName = $request->file('kartu_karyawan')->getClientOriginalName();
                $request->file('kartu_karyawan')->move(public_path($path . 'kartu_karyawanan'), $kartuKaryawanName);
                $kartuKaryawanPath = $path . 'kartu_karyawanan/' . $kartuKaryawanName;
            } else {
                $kartuKaryawanPath = $informasi->kartu_karyawan ?? null;
            }

            // Simpan atau update informasi pribadi
            if (!$informasi) {
                InformasiPribadi::create([
                    'id_user' => $id_user->id,
                    'foto_kk' => $fotoKKPath,
                    'foto_ktp' => $fotoKTPPath,
                    'kartu_karyawan' => $kartuKaryawanPath,
                ]);
            } else {
                $informasi->update([
                    'foto_kk' => $fotoKKPath,
                    'foto_ktp' => $fotoKTPPath,
                    'kartu_karyawan' => $kartuKaryawanPath,
                ]);
            }

            // Hitung bunga
            $jumlah = $request->jumlah_pinjaman;
            $tenor = $request->tenor;
            $bungaPerBulan = $bunga->bunga;

            $bungaTotal = $jumlah * ($bungaPerBulan / 100) * $tenor;
            $jumlahKotor = $jumlah + $bungaTotal;
            $angsuranBulanan = $jumlahKotor / $tenor;

            // pengajuan
            $createdAt = now();
            $validatedData['id_user'] = $id_user->id;
            $validatedData['id_bunga'] = $bunga->id_bunga;
            $validatedData['jumlah_kotor'] = $jumlahKotor;
            $validatedData['angsuran_per_bulanan'] = $angsuranBulanan;
            $validatedData['jatuh_tempo'] = $createdAt->copy()->addMonths((int) $tenor);
            $validatedData['status'] = 'menunggu';

            // pengajuan
            $pengajuan = PengajuanPinjaman::create($validatedData);

            // detail pengajuan
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
