@extends('pages.layout')

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
                    <select class="form-select" id="selectPinjaman" aria-label="Default select example">
                        <option selected><--- Pilih Pinjaman ---></option>
                        @foreach ($pinjaman as $p)
                            <option value="{{ $p->id_pinjaman }}" data-tenor="{{ $p->tenor }}"
                                data-bunga="{{ $p->bunga }}">
                                Rp. {{ number_format($p->jumlah_uang, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputTenor" class="form-label">Tenor Pinjaman (Bulan)</label>
                    <input class="form-control" type="text" id="inputTenor" placeholder="" readonly />
                </div>
                <div class="mb-3">
                    <label for="inputBunga" class="form-label">Bunga Pinjaman (%)</label>
                    <input class="form-control" type="text" id="inputBunga" placeholder="" readonly />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tujuan Pinjaman</label>
                    <select class="form-select"vname="tujuan_pinjaman" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected><--- Pilih Tujuan Pinjaman ---></option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Renovasi Rumah">Renovasi Rumah</option>
                        <option value="Modal Usaha">Modal Usaha</option>
                        <option value="Keperluan Lain">Keperluan Lain</option>
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
                        <li>Jika sudah megirim data pinjaman silahkan ke halaman data pinjaman untuk menunggu persetujuan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('selectPinjaman').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const tenor = selected.getAttribute('data-tenor');
            const bunga = selected.getAttribute('data-bunga');

            document.getElementById('inputTenor').value = tenor + ' bulan';
            document.getElementById('inputBunga').value = bunga + ' %';
        });
    </script>
@endsection
