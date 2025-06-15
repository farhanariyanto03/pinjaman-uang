@extends('pages.layout')

@section('content')
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
    <form action="{{ route('karyawan.store-ajukan-pinjaman') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Pengajuan -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="mb-1">Data Diri</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                                <input class="form-control" type="text" name="nama" id="nama" placeholder=""
                                    readonly value="{{ Auth::user()->nama }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" id="jenisKelamin"
                                    aria-label="Default select example">
                                    <option selected><--- Pilih Jenis Kelamin ---></option>
                                    <option value="laki-laki">Laki - Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                                <input class="form-control" type="text" name="alamat" id="alamat"
                                    placeholder="Masukkan alamat anda" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">No HP</label>
                                <input class="form-control" type="text" name="no_hp" id="alamat"
                                    placeholder="Masukkan alamat anda" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Foto KK</label><br>
                            <img id="previewFotoKK"
                                src="{{ asset(Auth::user()->informasiPribadi->foto_kk ?: 'admin/img/elements/12.jpg') }}"
                                alt="Foto KK" style="width:400px; height:150px; border-radius:5px;">
                            <input type="file" id="fotoKKInput" name="foto_kk" class="form-control mt-2"
                                accept="image/*" />
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Foto KTP</label><br>
                            <img id="previewFotoKTP"
                                src="{{ asset(Auth::user()->informasiPribadi->foto_ktp ?: 'admin/img/elements/13.jpg') }}"
                                alt="Foto KTP" style="width:400px; height:150px; border-radius:5px;">
                            <input type="file" id="fotoKTPInput" name="foto_ktp" class="form-control mt-2"
                                accept="image/*" />
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Kartu Karyawan</label><br>
                            <img id="previewKartuKaryawan"
                                src="{{ asset(Auth::user()->informasiPribadi->kartu_karyawan ?: 'admin/img/elements/13.jpg') }}"
                                alt="Foto KTP" style="width:400px; height:150px; border-radius:5px;">
                            <input type="file" id="kartuKaryawanInput" name="kartu_karyawan" class="form-control mt-2"
                                accept="image/*" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengajuan -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="mb-1">Formulir Pengajuan</h2>
                        <p class="mb-0">Lengkapi data pengajuan pinjaman Anda</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah Pinjaman (Rp)</label>
                            <input class="form-control" type="number" name="jumlah_pinjaman" id="jumlahPinjaman"
                                placeholder="" />
                        </div>
                        <div class="mb-3">
                            <label for="inputTenor" class="form-label">Tenor Pinjaman (Bulan)</label>
                            <select class="form-select" name="tenor" id="tenorPinjaman"
                                aria-label="Default select example">
                                <option selected><--- Pilih Tenor Pinjaman ---></option>
                                <option value="1">1 Bulan</option>
                                <option value="2">2 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="4">4 Bulan</option>
                                <option value="5">5 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="7">7 Bulan</option>
                                <option value="8">8 Bulan</option>
                                <option value="9">9 Bulan</option>
                                <option value="10">10 Bulan</option>
                                <option value="11">11 Bulan</option>
                                <option value="12">12 Bulan</option>
                            </select>
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
                            <p class="text-black" id="cicilanBunga">{{ $bunga->bunga }} % per bulan</p>
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
                                <li>Jika sudah megirim data pinjaman silahkan ke halaman data pinjaman untuk menunggu
                                    persetujuan
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('fotoKKInput').addEventListener('change', e => {
            previewFile(e.target, 'previewFotoKK');
        });

        document.getElementById('fotoKTPInput').addEventListener('change', e => {
            previewFile(e.target, 'previewFotoKTP');
        });

        document.getElementById('kartuKaryawanInput').addEventListener('change', e => {
            previewFile(e.target, 'previewKartuKaryawan');
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Elemen input
            const jumlahPinjamanInput = document.getElementById("jumlahPinjaman");
            const tenorPinjamanSelect = document.getElementById("tenorPinjaman");

            // Elemen output
            const cicilanJumlah = document.getElementById("cicilanJumlah");
            const cicilanTenor = document.getElementById("cicilanTenor");
            const totalBunga = document.getElementById("totalBunga");
            const totalPembayaran = document.getElementById("totalPembayaran");
            const cicilanPerBulan = document.getElementById("cicilanPerBulan");

            // Nilai bunga per bulan dari backend (contoh: 2%)
            const bungaPerBulan = {{ $bunga->bunga }};

            // Fungsi format rupiah
            function formatRupiah(angka) {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0
                }).format(angka);
            }

            // Fungsi perhitungan cicilan
            function hitungCicilan() {
                const jumlah = parseFloat(jumlahPinjamanInput.value) || 0;
                const tenor = parseInt(tenorPinjamanSelect.value) || 0;

                const bungaTotal = jumlah * (bungaPerBulan / 100) * tenor;
                const totalBayar = jumlah + bungaTotal;
                const cicilanBulanan = tenor > 0 ? totalBayar / tenor : 0;

                // Update tampilan
                cicilanJumlah.textContent = formatRupiah(jumlah);
                cicilanTenor.textContent = tenor + " bulan";
                totalBunga.textContent = formatRupiah(bungaTotal);
                totalPembayaran.textContent = formatRupiah(totalBayar);
                cicilanPerBulan.textContent = formatRupiah(cicilanBulanan);
            }

            jumlahPinjamanInput.addEventListener("input", hitungCicilan);
            tenorPinjamanSelect.addEventListener("change", hitungCicilan);
        });
    </script>
    @include('sweetalert::alert')
@endsection
