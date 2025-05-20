<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BungaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BungaController as AdminBungaController;
use App\Http\Controllers\Admin\CicilanController;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\PengajuanAdminController;
use App\Http\Controllers\Karyawan\DataPinjamanController;
use App\Http\Controllers\Karyawan\AjukanPinjamanController;
use App\Http\Controllers\Karyawan\CicilanKaryawanController;
use App\Http\Controllers\Karyawan\PembatalanPinjamanController;

// Route::get('/', function () {
//     return view('layout');
// });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/cekLogin', [LoginController::class, 'login'])->name('cekLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::prefix('adminn')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bunga-pinjaman', [AdminBungaController::class, 'index'])->name('admin.bunga');
    Route::resource('bank', BankController::class);
    Route::get('/pengajuan', [PengajuanAdminController::class, 'index'])->name('admin.pengajuan');
    Route::put('/pengajuan/{id_pengajuan_pinjaman}/diterima', [PengajuanAdminController::class, 'updateStatusDiterima'])->name('admin.pengajuan.diterima');
    Route::put('/pengajuan/{id_pengajuan_pinjaman}/ditolak', [PengajuanAdminController::class, 'updateStatusDitolak'])->name('admin.pengajuan.ditolak');
    Route::get('/cicilan', [CicilanController::class, 'index'])->name('admin.cicilan');
});


Route::prefix('karyawan')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/ajukan-pinjaman', [AjukanPinjamanController::class, 'index'])->name('karyawan.ajukan-pinjaman');
    Route::post('/ajukan-pinjaman', [AjukanPinjamanController::class, 'storePengajuan'])->name('karyawan.store-ajukan-pinjaman');
    Route::get('/data-pinjaman', [DataPinjamanController::class, 'index'])->name('karyawan.data-pinjaman');
    Route::get('/cicilan', [CicilanKaryawanController::class, 'index'])->name('karyawan.cicilan-karyawan');
    Route::get('/pembayaran-cicilan/{id_pengajuan_pinjaman}', [CicilanKaryawanController::class, 'pembayaranCicilan'])->name('karyawan.pembayaran-cicilan-karyawan');
    Route::post('/pembayaran-cicilan/store', [CicilanKaryawanController::class, 'storePembayaran'])->name('karyawan.pembayaran-cicilan-karyawan.store');
    Route::get('/pembatalan', [PembatalanPinjamanController::class, 'index'])->name('karyawan.pembatalan-pengajuan');
    Route::delete('/pembatalan/{id_pengajuan_pinjaman}', [PembatalanPinjamanController::class, 'batalPengajuan'])->name('karyawan.pembatalan-pengajuan.batal');
});
