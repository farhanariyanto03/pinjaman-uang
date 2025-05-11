<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PinjamanController;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\PengajuanAdminController;
use App\Http\Controllers\Karyawan\DataPinjamanController;
use App\Http\Controllers\Karyawan\AjukanPinjamanController;
use App\Http\Controllers\Karyawan\CicilanKaryawanController;

// Route::get('/', function () {
//     return view('layout');
// });

Route::prefix('adminn')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('pinjaman', PinjamanController::class);
    Route::get('/pengajuan', [PengajuanAdminController::class, 'index'])->name('admin.pengajuan');
    Route::put('/pengajuan/{id_pengajuan_pinjaman}/diterima', [PengajuanAdminController::class, 'updateStatusDiterima'])->name('admin.pengajuan.diterima');
    Route::put('/pengajuan/{id_pengajuan_pinjaman}/ditolak', [PengajuanAdminController::class, 'updateStatusDitolak'])->name('admin.pengajuan.ditolak');
});


Route::prefix('karyawan')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/ajukan-pinjaman', [AjukanPinjamanController::class, 'index'])->name('karyawan.ajukan-pinjaman');
    Route::post('/ajukan-pinjaman', [AjukanPinjamanController::class, 'storePengajuan'])->name('karyawan.store-ajukan-pinjaman');
    Route::get('/data-pinjaman', [DataPinjamanController::class, 'index'])->name('karyawan.data-pinjaman');
    Route::get('/cicilan', [CicilanKaryawanController::class, 'index'])->name('karyawan.cicilan-karyawan');
});
