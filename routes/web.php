<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Karyawan\PinjamanController;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Karyawan\DataPinjamanController;
use App\Http\Controllers\Karyawan\AjukanPinjamanController;

// Route::get('/', function () {
//     return view('layout');
// });


Route::prefix('karyawan')->group(
    function () {
        Route::get('/', function () {
            return view('pages.karyawan.dashboard');
        });
        Route::get('/', [DashboardController::class, 'index'])->name('karyawan.dashboard');
        Route::get('/ajukan-pinjaman', [AjukanPinjamanController::class, 'index'])->name('karyawan.ajukan-pinjaman');
        Route::get('/data-pinjaman', [DataPinjamanController::class, 'index'])->name('karyawan.data-pinjaman');
    }
);
