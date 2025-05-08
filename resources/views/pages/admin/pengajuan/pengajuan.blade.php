@extends('pages.layout')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="col-md-6e p-1">
                <div class="card-body bg-white p-2" style="border-radius: 18px;">
                    <table class="table table-hover large" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>No HP Karyawan</th>
                                <th>Jumlah Uang</th>
                                <th>Tenor</th>
                                <th>Angsuran Per Bulan</th>
                                <th>Alasan Pengajuan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pengajuan as $p)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>{{ $p->user->nama }}</td>
                                    <td>{{ $p->user->no_hp }}</td>
                                    <td>Rp. {{ number_format($p->pinjaman->jumlah_uang, 0, ',', '.') }}</td>
                                    <td>{{ $p->pinjaman->tenor }}</td>
                                    {{-- <td><span class="badge bg-label-primary me-1">{{ $p->pinjaman->bunga }} %</span></td> --}}
                                    <td>Rp. {{ number_format($p->pinjaman->angsuran_per_bulan, 0, ',', '.') }}</span></td>
                                    <td>{{ $p->detailPinjaman->alasan_peminjaman }}</td>
                                    <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $p->status == 'menunggu' ? 'bg-warning' : ($p->status == 'diterima' ? 'bg-success' : ($p->status == 'lunas' ? 'bg-primary' : ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <form
                                                action="{{ route('admin.pengajuan.diterima', $p->id_pengajuan_pinjaman) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-icon btn-outline-success px-3 me-2">
                                                    <i class='bx bx-check'></i>
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('admin.pengajuan.ditolak', $p->id_pengajuan_pinjaman) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-icon btn-outline-danger"
                                                    data-confirm-delete="true">
                                                    <i class="bx bx-x"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
