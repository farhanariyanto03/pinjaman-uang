<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CicilanKaryawanController extends Controller
{
    public function index()
    {
        return view('pages.karyawan.cicilan-karyawan.cicilan-karyawan', [
            'title' => 'Cicilan Karyawan'
        ]);
    }
}
