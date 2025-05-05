@extends('pages.layout')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
                            Proses
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                            aria-selected="false">
                            Pinjaman Aktif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                            aria-selected="false">
                            Lunas
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-ditolak" aria-controls="navs-pills-top-messages"
                            aria-selected="false">
                            Ditolak
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    @foreach ($pengajuan_pinjaman as $pengajuan)
                        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h5 class="mb-1 text-black">PIN-{{ $pengajuan->jatuh_tempo }}</h5>
                                    <small class="text-muted">Pinjaman {{ $pengajuan->detailPinjaman->tujuan_pinjaman }}</small>
                                </div>
                                <span class="badge bg-warning">Menunggu</span>
                            </div>
                            <div class="row text-sm">
                                <div class="col-md-4 mb-3">
                                    <strong class="text-black">Nama Peminjam</strong><br>
                                    <span class="text-muted">{{ $pengajuan->user->nama }}</span>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <strong class="text-black">Tanggal Pengajuan</strong><br>
                                    <span class="text-muted">{{ $pengajuan->created_at }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong class="text-black">Alasan Pengajuan</strong><br>
                                    <span class="text-muted">{{ $pengajuan->detailPinjaman->alasan_peminjaman }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong class="text-black">Tanggal Disetujui</strong><br>
                                    <span class="text-muted">{{ $pengajuan->updated_at ? $pengajuan->updated_at : '-' }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong class="text-black">Jumlah Pinjaman</strong><br>
                                    <span class="text-muted">Rp. {{ number_format($pengajuan->pinjaman->jumlah_uang, 0, ',', '.') }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong class="text-black">Tenor</strong><br>
                                    <span class="text-muted">{{ $pengajuan->pinjaman->tenor }} bulan</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong class="text-black">Cicilan per Bulan</strong><br>
                                    <span class="text-muted">Rp. {{ number_format($pengajuan->pinjaman->angsuran_per_bulan, 0, ',', '.') }}</span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <strong class="text-black">Sisa Cicilan</strong><br>
                                    <span class="text-muted">{{ $pengajuan->pinjaman->jatuh_tempo - $pengajuan->create_at }} bulan</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="mb-1 text-black">PIN-2025-001</h5>
                                <small class="text-muted">Pinjaman Pendidikan</small>
                            </div>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                        <div class="row text-sm">
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">ID Peminjam</strong><br>
                                <span class="text-muted">USR-001</span>
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <strong class="text-black">Tanggal Pengajuan</strong><br>
                                <span class="text-muted">10 Januari 2025</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Alasan Pengajuan</strong><br>
                                <span class="text-muted">Biaya pendidikan anak</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Tanggal Disetujui</strong><br>
                                <span class="text-muted">15 Januari 2025</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Jumlah Pinjaman</strong><br>
                                <span class="text-muted">Rp 3.000.000</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Tenor</strong><br>
                                <span class="text-muted">12 bulan</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Cicilan per Bulan</strong><br>
                                <span class="text-muted">Rp 250.000</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Sisa Cicilan</strong><br>
                                <span class="text-muted">8 bulan</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="mb-1 text-black">PIN-2025-001</h5>
                                <small class="text-muted">Pinjaman Pendidikan</small>
                            </div>
                            <span class="badge bg-primary">Lunas</span>
                        </div>
                        <div class="row text-sm">
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">ID Peminjam</strong><br>
                                <span class="text-muted">USR-001</span>
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <strong class="text-black">Tanggal Pengajuan</strong><br>
                                <span class="text-muted">10 Januari 2025</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Alasan Pengajuan</strong><br>
                                <span class="text-muted">Biaya pendidikan anak</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Tanggal Disetujui</strong><br>
                                <span class="text-muted">15 Januari 2025</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Jumlah Pinjaman</strong><br>
                                <span class="text-muted">Rp 3.000.000</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Tenor</strong><br>
                                <span class="text-muted">12 bulan</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Cicilan per Bulan</strong><br>
                                <span class="text-muted">Rp 250.000</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Sisa Cicilan</strong><br>
                                <span class="text-muted">8 bulan</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-ditolak" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="mb-1 text-black">PIN-2025-001</h5>
                                <small class="text-muted">Pinjaman Pendidikan</small>
                            </div>
                            <span class="badge bg-danger">Ditolak</span>
                        </div>
                        <div class="row text-sm">
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">ID Peminjam</strong><br>
                                <span class="text-muted">USR-001</span>
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <strong class="text-black">Tanggal Pengajuan</strong><br>
                                <span class="text-muted">10 Januari 2025</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Alasan Pengajuan</strong><br>
                                <span class="text-muted">Biaya pendidikan anak</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Tanggal Disetujui</strong><br>
                                <span class="text-muted">15 Januari 2025</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Jumlah Pinjaman</strong><br>
                                <span class="text-muted">Rp 3.000.000</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Tenor</strong><br>
                                <span class="text-muted">12 bulan</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Cicilan per Bulan</strong><br>
                                <span class="text-muted">Rp 250.000</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <strong class="text-black">Sisa Cicilan</strong><br>
                                <span class="text-muted">8 bulan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
