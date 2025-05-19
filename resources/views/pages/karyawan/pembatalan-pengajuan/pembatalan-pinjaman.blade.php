@extends('pages.layout')

@section('content')
    @foreach ($status_menunggu as $status_menunggu)
        <div class="col-md-12 mb-4">
            <div class="card border">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1 text-black">PIN-{{ $status_menunggu->jatuh_tempo }}</h5>
                            <small class="text-muted">Pinjaman
                                {{ $status_menunggu->detailPinjaman->tujuan_pinjaman }}</small>
                        </div>
                        <span
                            class="badge {{ $status_menunggu->status == 'menunggu' ? 'bg-warning' : ($status_menunggu->status == 'diterima' ? 'bg-success' : ($status_menunggu->status == 'lunas' ? 'bg-primary' : ($status_menunggu->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                            {{ ucfirst($status_menunggu->status) }}
                        </span>
                    </div>
                    <div class="row text-sm">
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Nama Peminjam</strong><br>
                            <span class="text-muted">{{ $status_menunggu->user->nama }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Tanggal Pengajuan</strong><br>
                            <span class="text-muted">{{ $status_menunggu->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Alasan Peminjaman</strong><br>
                            <span class="text-muted">{{ $status_menunggu->detailPinjaman->alasan_peminjaman }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Tanggal Disetujui</strong><br>
                            <span
                                class="text-muted">{{ $status_menunggu->updated_at ? $status_menunggu->updated_at->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Jumlah Pinjaman</strong><br>
                            <span class="text-muted">Rp.
                                {{ number_format($status_menunggu->jumlah_pinjaman, 0, ',', '.') }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Tenor</strong><br>
                            <span class="text-muted">{{ $status_menunggu->tenor }}
                                bulan</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Cicilan per Bulan</strong><br>
                            <span class="text-muted">Rp.
                                {{ number_format($status_menunggu->angsuran_per_bulan, 0, ',', '.') }}</span>
                        </div>
                        {{-- <div class="col-md-6 mb-2">
                                                <strong class="text-black">Sisa Cicilan</strong><br>
                                                <span class="text-muted">
                                                    {{ $status_menunggu->sisa_cicilan > 0 ? $status_menunggu->sisa_cicilan . ' bulan' : 'Jatuh tempo terlewati' }}
                                                </span>
                                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if ($status_menunggu->count() == 0)
        <p class="d-flex align-items-center justify-content-center">Tidak ada data pengajuan pinjaman
            menunggu</p>
    @endif
    @include('sweetalert::alert')
@endsection
