@extends('pages.layout')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
                            Menunggu
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
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
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
                                                <span
                                                    class="text-muted">{{ $status_menunggu->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Alasan Peminjaman</strong><br>
                                                <span
                                                    class="text-muted">{{ $status_menunggu->detailPinjaman->alasan_peminjaman }}</span>
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
                                                    {{ number_format($status_menunggu->angsuran_per_bulanan, 0, ',', '.') }}</span>
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
                    </div>

                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        @foreach ($status_diterima as $pinjaman)
                            <div class="col-md-12 mb-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="mb-1 text-black">PIN-{{ $pinjaman->jatuh_tempo }}</h5>
                                                <small class="text-muted">Pinjaman
                                                    {{ $pinjaman->detailPinjaman->tujuan_pinjaman }}</small>
                                            </div>
                                            <span
                                                class="badge {{ $pinjaman->status == 'menunggu' ? 'bg-warning' : ($pinjaman->status == 'diterima' ? 'bg-success' : ($pinjaman->status == 'lunas' ? 'bg-primary' : ($pinjaman->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                                                {{ ucfirst($pinjaman->status) }}
                                            </span>
                                        </div>
                                        <div class="row text-sm">
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Nama Peminjam</strong><br>
                                                <span class="text-muted">{{ $pinjaman->user->nama }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tanggal Pengajuan</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Alasan</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->detailPinjaman->alasan_peminjaman }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tanggal Disetujui</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->updated_at ? $pinjaman->updated_at->format('d M Y') : '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Jumlah Pinjaman</strong><br>
                                                <span class="text-muted">Rp.
                                                    {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tenor</strong><br>
                                                <span class="text-muted">{{ $pinjaman->tenor }} bulan</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Cicilan per Bulan</strong><br>
                                                <span class="text-muted">Rp.
                                                    {{ number_format($pinjaman->angsuran_per_bulanan, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Sisa Cicilan</strong><br>
                                                <span class="text-muted">
                                                    {{ $pinjaman->sisa_cicilan > 0 ? $pinjaman->sisa_cicilan . ' bulan' : 'Jatuh tempo terlewati' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if (count($status_diterima) == 0)
                            <p class="d-flex align-items-center justify-content-center">Tidak ada data pengajuan pinjaman
                                diterima</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        @foreach ($status_lunas as $pinjaman)
                            <div class="col-md-12 mb-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="mb-1 text-black">PIN-{{ $pinjaman->jatuh_tempo }}</h5>
                                                <small class="text-muted">Pinjaman
                                                    {{ $pinjaman->detailPinjaman->tujuan_pinjaman }}</small>
                                            </div>
                                            <span class="badge bg-primary">
                                                {{ ucfirst($pinjaman->status) }}
                                            </span>
                                        </div>
                                        <div class="row text-sm">
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Nama Peminjam</strong><br>
                                                <span class="text-muted">{{ $pinjaman->user->nama }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tanggal Pengajuan</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Alasan</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->detailPinjaman->alasan_peminjaman }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tanggal Disetujui</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->updated_at ? $pinjaman->updated_at->format('d M Y') : '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Jumlah Pinjaman</strong><br>
                                                <span class="text-muted">Rp.
                                                    {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tenor</strong><br>
                                                <span class="text-muted">{{ $pinjaman->tenor }} bulan</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Cicilan per Bulan</strong><br>
                                                <span class="text-muted">Rp.
                                                    {{ number_format($pinjaman->angsuran_per_bulanan, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Sisa Cicilan</strong><br>
                                                <span class="text-muted">
                                                    {{ $pinjaman->sisa_cicilan > 0 ? $pinjaman->sisa_cicilan . ' bulan' : 'Lunas' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if (count($status_lunas) == 0)
                            <p class="d-flex align-items-center justify-content-center">Tidak ada data pinjaman lunas</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="navs-pills-top-ditolak" role="tabpanel">
                        @foreach ($status_ditolak as $pinjaman)
                            <div class="col-md-12 mb-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="mb-1 text-black">PIN-{{ $pinjaman->jatuh_tempo }}</h5>
                                                <small class="text-muted">Pinjaman
                                                    {{ $pinjaman->detailPinjaman->tujuan_pinjaman }}</small>
                                            </div>
                                            <span class="badge bg-danger">
                                                {{ ucfirst($pinjaman->status) }}
                                            </span>
                                        </div>
                                        <div class="row text-sm">
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Nama Peminjam</strong><br>
                                                <span class="text-muted">{{ $pinjaman->user->nama }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tanggal Pengajuan</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Alasan</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->detailPinjaman->alasan_peminjaman }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="text-black">Tanggal Ditolak</strong><br>
                                                <span
                                                    class="text-muted">{{ $pinjaman->updated_at ? $pinjaman->updated_at->format('d M Y') : '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if (count($status_ditolak) == 0)
                            <p class="d-flex align-items-center justify-content-center">Tidak ada data pinjaman ditolak</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
