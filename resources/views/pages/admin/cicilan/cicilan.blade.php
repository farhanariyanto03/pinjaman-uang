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
                                    <td><img src="{{ asset('uploads/bukti_tf/' . $p->bukti_tf) }}" class="img-fluid" style="width: 130px; height: 250px;" alt=""></td>
                                    <td><span class="badge bg-label-warning me-1">{{ $p->status }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.cicilan.diterima', $p->id_pembayaran) }}" class="btn btn-icon btn-outline-success">
                                            <i class='bx bxs-check-circle'></i>
                                        </a>
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
    </div>
    @include('sweetalert::alert')
@endsection
