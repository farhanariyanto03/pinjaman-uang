@extends('pages.layout')

@section('content')
    @foreach ($pengajuan as $p)
        <div class="col-md-12 mb-4">
            <div class="card border">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1 text-black">PIN-{{ $p->jatuh_tempo }}</h5>
                            <small class="text-muted">Pinjaman
                                {{ $p->detailPinjaman->tujuan_pinjaman }}</small>
                        </div>
                        <span
                            class="badge {{ $p->status == 'menunggu' ? 'bg-warning' : ($p->status == 'diterima' ? 'bg-success' : ($p->status == 'lunas' ? 'bg-primary' : ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </div>
                    <div class="row text-sm">
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Nama Peminjam</strong><br>
                            <span class="text-muted">{{ $p->user->nama }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Tanggal Pengajuan</strong><br>
                            <span class="text-muted">{{ $p->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Alasan Peminjaman</strong><br>
                            <span class="text-muted">{{ $p->detailPinjaman->alasan_peminjaman }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Tanggal Disetujui</strong><br>
                            <span class="text-muted">{{ $p->updated_at ? $p->updated_at->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Jumlah Pinjaman</strong><br>
                            <span class="text-muted">Rp.
                                {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Tenor</strong><br>
                            <span class="text-muted">{{ $p->tenor }}
                                bulan</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="text-black">Cicilan per Bulan</strong><br>
                            <span class="text-muted">Rp.
                                {{ number_format($p->angsuran_per_bulan, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('karyawan.pembatalan-pengajuan.batal', $p->id_pengajuan_pinjaman) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Batal Pengajuan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if ($pengajuan->count() == 0)
        <p class="d-flex align-items-center justify-content-center">Tidak ada data pengajuan pinjaman
            menunggu</p>
    @endif
    @include('sweetalert::alert')
@endsection
