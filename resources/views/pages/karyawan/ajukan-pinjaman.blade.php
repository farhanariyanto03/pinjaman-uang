@extends('pages.karyawan.dashboard')

@section('content')
    <!-- Form controls -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-1">Formulir Pengajuan</h2>
                <p class="mb-0">Lengkapi data pengajuan pinjaman Anda</p>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah Pinjaman (Rp)</label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlReadOnlyInput1" class="form-label">Tenor Pinjaman (Bulan)</label>
                    <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder=""
                        readonly />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tujuan Pinjaman</label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div>
                    <label for="exampleFormControlTextarea1" class="form-label">Alasan Pengajuan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button class="btn btn-primary mt-3 w-100">Ajukan Pinjaman</button>
            </div>
        </div>
    </div>

    <!-- Input Sizing -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-1">Cicilan</h2>
                <p class="mb-0">Perhitungan simulasi cicilan pinjaman Anda</p>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Jumlah Pinjaman</p>
                    <p class="text-black">Rp. 1.000.000</p>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Tenor</p>
                    <p class="text-black">12 bulan</p>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Bunga</p>
                    <p class="text-black">5% per bukan</p>
                </div>
                <hr class="m-0 mb-3" />
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Total Bungan</p>
                    <p class="text-black">Rp. 50.000</p>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Total Pembayaran</p>
                    <p class="text-black">Rp. 1.050.000</p>
                </div>
                <hr class="m-0 mb-3" />
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Cicilan Per Bulan</p>
                    <p class="fw-bold text-black">Rp. 83.333</p>
                </div>
                <div class="alert alert-secondary mt-4" role="alert">
                    <h6 class="alert-heading fw-bold mb-2">Catatan Penting:</h6>
                    <ul class="mb-0 ps-3">
                        <li>Pengajuan akan diproses dalam 3–5 hari kerja</li>
                        <li>Pastikan data yang diisi sudah benar</li>
                        <li>Jika sudah megirim data pinjaman silahkan ke halaman data pinjaman untuk menunggu persetujuan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
