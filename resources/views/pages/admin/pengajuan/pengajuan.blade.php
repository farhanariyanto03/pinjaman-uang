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
                        <div class="table-responsive">
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
                                    @foreach ($pengajuan_menunggu as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>{{ $p->user->nama }}</td>
                                            <td>{{ $p->user->no_hp }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                                            <td>{{ $p->tenor }} Bulan</td>
                                            <td>Rp. {{ number_format($p->angsuran_per_bulanan, 0, ',', '.') }}</span>
                                            </td>
                                            <td>{{ $p->detailPinjaman->alasan_peminjaman ?? '-' }}</td>
                                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $p->status == 'menunggu' ? 'bg-warning' : ($p->status == 'diterima' ? 'bg-success' : ($p->status == 'lunas' ? 'bg-primary' : ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                                                    {{ ucfirst($p->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <form
                                                        action="{{ route('admin.pengajuan.diterima', $p->id_pengajuan_pinjaman) }}"
                                                        method="POST" class="me-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-icon btn-outline-success px-3">
                                                            <i class='bx bx-check'></i>
                                                        </button>
                                                    </form>
                                                    {{-- <button type="button" class="btn btn-icon btn-outline-warning me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPengajuan{{ $p->id_pengajuan_pinjaman }}">
                                                    <i class="bx bx-pen"></i>
                                                </button> --}}
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

                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover large w-full" id="myTable1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
                                        <th>No HP Karyawan</th>
                                        <th>Jumlah Uang</th>
                                        <th>Tenor</th>
                                        <th>Angsuran Per Bulan</th>
                                        <th>Jumlah Kotor</th>
                                        <th>Alasan Pengajuan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pengajuan_diterima as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>{{ $p->user->nama }}</td>
                                            <td>{{ $p->user->no_hp }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                                            <td>{{ $p->tenor }} Bulan</td>
                                            <td>Rp. {{ number_format($p->angsuran_per_bulanan, 0, ',', '.') }}</span>
                                            <td>Rp. {{ number_format($p->jumlah_kotor, 0, ',', '.') }}</span>
                                            </td>
                                            <td>{{ $p->detailPinjaman->alasan_peminjaman ?? '-' }}</td>
                                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $p->updated_at->format('d-m-Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $p->status == 'menunggu' ? 'bg-warning' : ($p->status == 'diterima' ? 'bg-success' : ($p->status == 'lunas' ? 'bg-primary' : ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                                                    {{ ucfirst($p->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover large" id="myTable2">
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
                                        <th>Jatuh Tempo</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pengajuan_lunas as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>{{ $p->user->nama }}</td>
                                            <td>{{ $p->user->no_hp }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                                            <td>{{ $p->tenor }} Bulan</td>
                                            <td>Rp. {{ number_format($p->angsuran_per_bulanan, 0, ',', '.') }}</span>
                                            </td>
                                            <td>{{ $p->detailPinjaman->alasan_peminjaman ?? '-' }}</td>
                                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $p->updated_at->format('d-m-Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $p->status == 'menunggu' ? 'bg-warning' : ($p->status == 'diterima' ? 'bg-success' : ($p->status == 'lunas' ? 'bg-primary' : ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                                                    {{ ucfirst($p->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="btn">
                                <form action="{{ route('admin.pengajuan.hapus-lunas') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-outline-light"><i class="bx bx-trash bx-xxs me-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-top-ditolak" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover large" id="myTable3">
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
                                        <th>Jatuh Tempo</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pengajuan_ditolak as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>{{ $p->user->nama }}</td>
                                            <td>{{ $p->user->no_hp }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                                            <td>{{ $p->tenor }} Bulan</td>
                                            <td>Rp. {{ number_format($p->angsuran_per_bulanan, 0, ',', '.') }}</span>
                                            </td>
                                            <td>{{ $p->detailPinjaman->alasan_peminjaman ?? '-' }}</td>
                                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $p->updated_at->format('d-m-Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $p->status == 'menunggu' ? 'bg-warning' : ($p->status == 'diterima' ? 'bg-success' : ($p->status == 'lunas' ? 'bg-primary' : ($p->status == 'ditolak' ? 'bg-danger' : 'bg-secondary'))) }}">
                                                    {{ ucfirst($p->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="btn">
                                <form action="{{ route('admin.pengajuan.hapus-ditolak') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-outline-light"><i class="bx bx-trash bx-xxs me-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
