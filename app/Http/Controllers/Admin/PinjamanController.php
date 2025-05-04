<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.pinjaman.pinjaman', [
            'title' => 'Pinjaman',
            'pinjaman' => Pinjaman::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.pinjaman.create-update', [
            'title' => 'Tambah Pinjaman',
            'pinjaman' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jumlah_uang' => 'required|numeric',
            'bunga' => 'required|numeric',
            'tenor' => 'required|numeric',
        ], [
            'jumlah_uang.required' => 'Jumlah pinjaman harus diisi',
            'bunga.required' => 'Bunga harus diisi',
            'tenor.required' => 'Tenor harus diisi',
        ]);

        // Hitung total bunga
        $total_bunga = ($validatedData['jumlah_uang'] * $validatedData['bunga'] / 100) * $validatedData['tenor'];

        // Hitung jumlah kotor
        $validatedData['jumlah_kotor'] = $validatedData['jumlah_uang'] + $total_bunga;

        // Hitung angsuran per bulan
        $validatedData['angsuran_per_bulan'] = $validatedData['jumlah_kotor'] / $validatedData['tenor'];

        Pinjaman::create($validatedData);
        Alert::success('Berhasil', 'Data pinjaman berhasil ditambahkan');
        return redirect()->route('pinjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.admin.pinjaman.create-update', [
            'title' => 'Edit Pinjaman',
            'pinjaman' => Pinjaman::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'jumlah_uang' => 'required|numeric',
            'bunga' => 'required|numeric',
            'tenor' => 'required|numeric',
        ], [
            'jumlah_uang.required' => 'Jumlah pinjaman harus diisi',
            'bunga.required' => 'Bunga harus diisi',
            'tenor.required' => 'Tenor harus diisi',
        ]);

        // Hitung total bunga
        $total_bunga = ($validatedData['jumlah_uang'] * $validatedData['bunga'] / 100) * $validatedData['tenor'];

        // Hitung jumlah kotor
        $validatedData['jumlah_kotor'] = $validatedData['jumlah_uang'] + $total_bunga;

        // Hitung angsuran per bulan
        $validatedData['angsuran_per_bulan'] = $validatedData['jumlah_kotor'] / $validatedData['tenor'];

        Pinjaman::where('id_pinjaman', $id)->update($validatedData);
        Alert::success('Berhasil', 'Data pinjaman berhasil diubah');
        return redirect()->route('pinjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pinjaman::destroy($id);
        Alert::success('Berhasil', 'Data pinjaman berhasil dihapus');
        return redirect()->route('pinjaman.index');
    }
}
