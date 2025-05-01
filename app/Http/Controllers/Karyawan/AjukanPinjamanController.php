<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjukanPinjamanController extends Controller
{
    public function index()
    {
        return view('pages.karyawan.ajukan-pinjaman');
    }
}
