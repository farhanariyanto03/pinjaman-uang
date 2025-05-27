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
                            Diterima
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
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
                                        <th>No HP</th>
                                        <th>Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Bukti TF</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pembayaranMenunggu as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>{{ $p->pengajuan->user->nama }}</td>
                                            <td>{{ $p->pengajuan->user->no_hp }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</td>
                                            <td>{{ $p->tanggal_pembayaran }}</td>
                                            <td><span class="badge bg-label-primary me-1">{{ $p->metode_pembayaran }}</span>
                                            </td>
                                            <td><img src="{{ asset('uploads/bukti_tf/' . $p->bukti_tf) }}" class="img-fluid"
                                                    style="width: 130px; height: 250px;" alt=""></td>
                                            <td><span class="badge bg-label-warning me-1">{{ $p->status }}</span></td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.cicilan.diterima', $p->id_pembayaran_pinjaman) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-icon btn-outline-success">
                                                        <i class='bx bxs-check-circle'></i>
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.cicilan.ditolakk', $p->id_pembayaran_pinjaman) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button id="confirmDelete" type="submit"
                                                        class="btn btn-icon btn-outline-danger" data-confirm-delete="true">
                                                        <i class="bx bx-x"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover large" id="myTable1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
                                        <th>No HP</th>
                                        <th>Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Bukti TF</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pembayaranDiterima as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>{{ $p->pengajuan->user->nama }}</td>
                                            <td>{{ $p->pengajuan->user->no_hp }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</td>
                                            <td>{{ $p->tanggal_pembayaran }}</td>
                                            <td><span
                                                    class="badge bg-label-primary me-1">{{ $p->metode_pembayaran }}</span>
                                            </td>
                                            <td><img src="{{ asset('uploads/bukti_tf/' . $p->bukti_tf) }}"
                                                    class="img-fluid" style="width: 130px; height: 250px;" alt="">
                                            </td>
                                            <td><span class="badge bg-label-warning me-1">{{ $p->status }}</span></td>
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
                                        <th>No HP</th>
                                        <th>Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Bukti TF</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pembayaranDitolak as $p)
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>{{ $p->pengajuan->user->nama }}</td>
                                            <td>{{ $p->pengajuan->user->no_hp }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</td>
                                            <td>{{ $p->tanggal_pembayaran }}</td>
                                            <td><span
                                                    class="badge bg-label-primary me-1">{{ $p->metode_pembayaran }}</span>
                                            </td>
                                            <td><img src="{{ asset('uploads/bukti_tf/' . $p->bukti_tf) }}"
                                                    class="img-fluid" style="width: 150px; height: 250px;" alt="">
                                            </td>
                                            <td><span class="badge bg-label-warning me-1">{{ $p->status }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="content-wrapper">
        <div class="card">
            <div class="col-md-6e p-1">
                <div class="card-body bg-white p-2" style="border-radius: 18px;">
                    <table class="table table-hover large" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th>Metode Pembayaran</th>
                                <th>Bukti TF</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pembayaran as $p)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>{{ $p->pengajuan->user->nama }}</td>
                                    <td>Rp. {{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</td>
                                    <td>{{ $p->tanggal_pembayaran }}</td>
                                    <td><span class="badge bg-label-primary me-1">{{ $p->metode_pembayaran }}</span></td>
                                    <td><img src="{{ asset('uploads/bukti_tf/' . $p->bukti_tf) }}" class="img-fluid"
                                            style="width: 130px; height: 250px;" alt=""></td>
                                    <td><span class="badge bg-label-warning me-1">{{ $p->status }}</span></td>
                                    <td>
                                        <form action="{{ route('admin.cicilan.diterima', $p->id_pembayaran_pinjaman) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-icon btn-outline-success">
                                                <i class='bx bxs-check-circle'></i>
                                            </button>
                                        </form>
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button id="confirmDelete" type="submit"
                                                class="btn btn-icon btn-outline-danger" data-confirm-delete="true">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    @include('sweetalert::alert')
@endsection
