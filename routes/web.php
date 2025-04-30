<?php

use App\Http\Controllers\Karyawan\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layout');
// });


Route::prefix('karyawan')->group(
    function () {
        Route::get('/', function () {
            return view('pages.karyawan.dashboard');
        });
        Route::get('/', [DashboardController::class, 'index'])->name('karyawan.dashboard');
    }
);
