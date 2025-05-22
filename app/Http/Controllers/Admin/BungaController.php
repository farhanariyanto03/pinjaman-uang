<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bunga;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BungaController extends Controller
{
    public function index()
    {
        return view('pages.admin.bunga.bunga', [
            'title' => 'Bunga Pinjaman',
            'bunga' => Bunga::all(),
        ]);
    }

    public function edit(string $id)
    {
        $bunga = Bunga::find($id);
        return view('pages.admin.bunga.create-update', [
            'title' => 'Edit Bunga',
            'bunga' => $bunga
        ]);
    }

    public function update(Request $request, string $id)
    {
        $bunga = Bunga::find($id);
        $bunga->update($request->all());
        Alert::success('Berhasil', 'Bunga berhasil diubah')->autoClose(3000);
        return redirect()->route('admin.bunga');
    }
}
