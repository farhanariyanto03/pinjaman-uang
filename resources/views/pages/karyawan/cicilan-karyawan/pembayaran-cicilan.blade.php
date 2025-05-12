@extends('pages.layout')


@section('content')
    <!-- Pengajuan -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-1">Pembayaran Cicilan</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="#" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3 d-flex flex-column">
                        <label for="exampleFormControlInput1" class="form-label">Metode Pembayaran</label>
                        <input class="form-check-input" type="radio" name="metode_pembayaran" id="inlineRadio1" value="option1"><span>Transfer</span>
                    </div>
                    <div class="mb-3">
                        <label for="inputTenor" class="form-label">Tenor Pinjaman (Bulan)</label>
                        <input class="form-control" type="text" name="tenor" id="inputTenor" placeholder="" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="inputBunga" class="form-label">Bunga Pinjaman (%)</label>
                        <input class="form-control" type="text" name="bunga" id="inputBunga" placeholder="" readonly />
                    </div>
                    <button class="btn btn-primary mt-3 w-100" type="submit">Ajukan Pinjaman</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Detail -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-1">Cicilan</h2>
                <p class="mb-0">Perhitungan simulasi cicilan pinjaman Anda</p>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Jumlah Pinjaman</p>
                    <p class="text-black" id="cicilanJumlah">Rp. 0</p>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Tenor</p>
                    <p class="text-black" id="cicilanTenor">0 bulan</p>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Bunga</p>
                    <p class="text-black" id="cicilanBunga">0% per bukan</p>
                </div>
                <hr class="m-0 mb-3" />
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Total Bunga</p>
                    <p class="text-black" id="totalBunga">Rp. 0</p>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Total Pembayaran</p>
                    <p class="text-black" id="totalPembayaran">Rp. 0</p>
                </div>
                <hr class="m-0 mb-3" />
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-black">Cicilan Per Bulan</p>
                    <p class="fw-bold text-black" id="cicilanPerBulan">Rp. 0</p>
                </div>
                <div class="alert alert-secondary mt-4" role="alert">
                    <h6 class="alert-heading fw-bold mb-2">Catatan Penting:</h6>
                    <ul class="mb-0 ps-3">
                        <li>Pengajuan akan diproses dalam 3–5 hari kerja</li>
                        <li>Pastikan data yang diisi sudah benar</li>
                        <li>Jika sudah megirim data pinjaman silahkan ke halaman data pinjaman untuk menunggu persetujuan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
