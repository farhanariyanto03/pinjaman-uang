@extends('pages.layout')


@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                {{-- <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
                            Harus Dibayar
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                            aria-selected="false">
                            Ditolak
                        </button>
                    </li>
                </ul> --}}
                <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                    @foreach ($cicilanBelumLunas as $c)
                        <div class="col-md-12 mb-4">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5 class="mb-1 text-black">PIN-{{ $c->jatuh_tempo }}</h5>
                                            <small class="text-muted">Pinjaman
                                                {{ $c->detailPinjaman->tujuan_pinjaman }}</small>
                                        </div>
                                        <span class="badge bg-warning">
                                            SILAHKAN DIBAYAR
                                        </span>
                                    </div>
                                    <div class="row text-sm">
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Nama Peminjam</strong><br>
                                            <span class="text-muted">{{ $c->user->nama }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Tanggal Pengajuan</strong><br>
                                            <span class="text-muted">{{ $c->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Alasan Peminjaman</strong><br>
                                            <span class="text-muted">{{ $c->detailPinjaman->alasan_peminjaman }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Tanggal Disetujui</strong><br>
                                            <span class="text-muted">{{ $c->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Jumlah Pinjaman</strong><br>
                                            <span class="text-muted">Rp.
                                                {{ number_format($c->jumlah_pinjaman, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Tenor</strong><br>
                                            <span class="text-muted">{{ $c->tenor }} bulan</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Cicilan per Bulan</strong><br>
                                            <span class="text-muted">Rp.
                                                {{ number_format($c->angsuran_per_bulanan, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong class="text-black">Sisa Cicilan</strong><br>
                                            <span class="text-muted">
                                                {{ $c->sisa_cicilan }} Bulan
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('karyawan.pembayaran-cicilan-karyawan', $c->id_pengajuan_pinjaman) }}"
                                            class="btn btn-primary">Bayar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($cicilanBelumLunas->count() == 0)
                        <p class="d-flex align-items-center justify-content-center">Tidak ada data cicilan yang harus
                            dibayar</p>
                    @endif
                </div>

                {{-- <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                    <>testt</
                </div> --}}
            </div>
        </div>
    </div>
    </div>
    @include('sweetalert::alert')
@endsection
