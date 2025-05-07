<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PinjamanController;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Karyawan\DataPinjamanController;
use App\Http\Controllers\Karyawan\AjukanPinjamanController;

// Route::get('/', function () {
//     return view('layout');
// });

Route::prefix('adminn')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('pinjaman', PinjamanController::class);
});


Route::prefix('karyawan')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/ajukan-pinjaman', [AjukanPinjamanController::class, 'index'])->name('karyawan.ajukan-pinjaman');
    Route::post('/ajukan-pinjaman', [AjukanPinjamanController::class, 'storePengajuan'])->name('karyawan.store-ajukan-pinjaman');
    Route::get('/data-pinjaman', [DataPinjamanController::class, 'index'])->name('karyawan.data-pinjaman');
});
