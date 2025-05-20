<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bunga;
use Illuminate\Http\Request;

class BungaController extends Controller
{
    public function index()
    {
        return view('pages.admin.bunga.bunga', [
            'title' => 'Bunga Pinjaman',
            'bunga' => Bunga::all(),
        ]);
    }
}
