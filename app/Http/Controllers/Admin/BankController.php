<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.bank.bank', [
            'title' => 'Bank',
            'bank' => Bank::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.bank.create-update', [
            'title' => 'Tambah Bank',
            'bank' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_bank' => 'required',
            'nomor_rekening' => 'required',
            'nama_rekening' => 'required',
        ], [
            'nama_bank.required' => 'Nama bank harus diisi',
            'nomor_rekening.required' => 'Nomor rekening harus diisi',
            'nama_rekening.required' => 'Nama rekening harus diisi',
        ]);

        Bank::create($validatedData);
        FacadesAlert::success('Berhasil', 'Bank berhasil ditambahkan')->autoClose(3000);
        return redirect()->route('bank.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bank = Bank::find($id);
        return view('pages.admin.bank.create-update', [
            'title' => 'Edit Bank',
            'bank' => $bank
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bank = Bank::find($id);
        $bank->update($request->all());
        FacadesAlert::success('Berhasil', 'Bank berhasil diubah')->autoClose(3000);
        return redirect()->route('bank.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        Alert::success('Berhasil', 'Bank berhasil dihapus')->autoClose(3000);
        return redirect()->route('bank.index');
    }
}
