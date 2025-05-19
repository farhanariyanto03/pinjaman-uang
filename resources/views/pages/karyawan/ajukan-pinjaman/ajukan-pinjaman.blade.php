@extends('pages.layout')

@section('content')
    <!-- Pengajuan -->
    <div class="col-md-8 offset-md-2">
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
                        <input class="form-control" type="number" name="jumlah_pinjaman" id="inputTenor" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <label for="inputTenor" class="form-label">Tenor Pinjaman (Bulan)</label>
                        <select class="form-select" name="tenor" id="exampleFormControlSelect1"
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
                    <button class="btn btn-primary mt-3 w-100" type="submit">Ajukan Pinjaman</button>
                </div>
            </form>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
