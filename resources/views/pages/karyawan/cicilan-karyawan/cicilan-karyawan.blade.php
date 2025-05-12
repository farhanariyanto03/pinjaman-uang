@extends('pages.layout')


@section('content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
            @foreach ($cicilan as $c)
                <div class="col-md-12 mb-4">
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1 text-black">PIN-{{ $c->jatuh_tempo }}</h5>
                                    <small class="text-muted">Pinjaman
                                        456789</small>
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
                                        {{ number_format($c->pinjaman->jumlah_uang, 0, ',', '.') }}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong class="text-black">Tenor</strong><br>
                                    <span class="text-muted">{{ $c->pinjaman->tenor }} bulan</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong class="text-black">Cicilan per Bulan</strong><br>
                                    <span class="text-muted">Rp.
                                        {{ number_format($c->pinjaman->angsuran_per_bulan, 0, ',', '.') }}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong class="text-black">Sisa Cicilan</strong><br>
                                    <span class="text-muted">
                                        {{ $c->sisa_cicilan }} Bulan
                                        @if ($c->harus_bayar_bulan_ini)
                                            <span class="badge bg-warning">Harus Bayar Bulan Ini</span>
                                        @else
                                            <span class="badge bg-success">Sudah Dibayar Bulan Ini</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('karyawan.pembayaran-cicilan-karyawan', $c->id) }}" class="btn btn-primary">Bayar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($cicilan) == 0)
                <p class="d-flex align-items-center justify-content-center">Tidak ada data cicilan yang harus dibayar</p>
            @endif
        </div>
    </div>
@endsection
