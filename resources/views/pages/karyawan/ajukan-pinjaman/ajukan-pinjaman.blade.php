@extends('pages.layout')

@section('content')
    <!-- Pengajuan -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-1">Formulir Pengajuan</h2>
                <p class="mb-0">Lengkapi data pengajuan pinjaman Anda</p>
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
            <form action="{{ route('karyawan.store-ajukan-pinjaman') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jumlah Pinjaman (Rp)</label>
                        <select class="form-select" id="selectPinjaman" name="id_pinjaman" aria-label="Default select example">
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
                        <input class="form-control" type="text" name="tenor" id="inputTenor" placeholder="" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="inputBunga" class="form-label">Bunga Pinjaman (%)</label>
                        <input class="form-control" type="text" name="bunga" id="inputBunga" placeholder="" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tujuan Pinjaman</label>
                        <select class="form-select" name="tujuan_pinjaman" id="exampleFormControlSelect1"
                            aria-label="Default select example">
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
                        <textarea class="form-control" name="alasan_peminjaman" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary mt-3 w-100" type="submit">Ajukan Pinjaman</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cicilan -->
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

    <script>
        // inputan pengajuan
        document.getElementById('selectPinjaman').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const tenor = selected.getAttribute('data-tenor');
            const bunga = selected.getAttribute('data-bunga');

            document.getElementById('inputTenor').value = tenor + ' bulan';
            document.getElementById('inputBunga').value = bunga + ' %';
        });

        // cicilan
        document.getElementById('selectPinjaman').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            const jumlahUangText = selectedOption.textContent.trim().replace('Rp. ', '').replace(/\./g, '');
            const tenor = selectedOption.getAttribute('data-tenor');
            const bunga = selectedOption.getAttribute('data-bunga');

            if (!tenor || !bunga || isNaN(jumlahUangText)) return;

            const jumlahUang = parseInt(jumlahUangText);
            const bungaPersen = parseFloat(bunga);
            const totalBunga = jumlahUang * (bungaPersen / 100) * tenor;
            const totalPembayaran = jumlahUang + totalBunga;
            const cicilanPerBulan = totalPembayaran / tenor;

            // Update ke form cicilan
            document.getElementById('cicilanJumlah').textContent = `Rp. ${jumlahUang.toLocaleString('id-ID')}`;
            document.getElementById('cicilanTenor').textContent = `${tenor} bulan`;
            document.getElementById('cicilanBunga').textContent = `${bunga}% per bulan`;
            document.getElementById('totalBunga').textContent = `Rp. ${totalBunga.toLocaleString('id-ID')}`;
            document.getElementById('totalPembayaran').textContent =
                `Rp. ${totalPembayaran.toLocaleString('id-ID')}`;
            document.getElementById('cicilanPerBulan').textContent =
                `Rp. ${Math.ceil(cicilanPerBulan).toLocaleString('id-ID')}`;
        });
    </script>
    @include('sweetalert::alert')
@endsection
