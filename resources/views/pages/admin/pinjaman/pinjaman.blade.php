@extends('pages.layout')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="p-3">
                <a href="{{ route('pinjaman.create') }}" class="btn btn-primary col-2"> + Pinjaman</a>
            </div>
            <div class="col-md-6e p-1">
                <div class="card-body bg-white p-2" style="border-radius: 18px;">
                    <table class="table table-hover large" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jumlah Uang</th>
                                <th>Tenor</th>
                                <th>Bunga</th>
                                <th>Angsuran Per Bulan</th>
                                <th>Jumlah Kotor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pinjaman as $p)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>Rp. {{ number_format($p->jumlah_uang, 0, ',', '.') }}</td>
                                    <td>{{ $p->tenor }}</td>
                                    <td>{{ $p->bunga }} %</td>
                                    <td>Rp. {{ number_format($p->angsuran_per_bulan, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-label-primary me-1">Rp. {{ number_format($p->jumlah_kotor, 0, ',', '.') }}</span></td>
                                    <td>
                                        <a href="{{ route('pinjaman.edit', $p->id_pinjaman) }}" class="btn btn-icon btn-outline-warning">
                                            <i class='bx bxs-pencil'></i>
                                        </a>
                                        <form action="{{ route('pinjaman.destroy', $p->id_pinjaman) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button id="confirmDelete" type="submit"
                                                class="btn btn-icon btn-outline-danger" data-confirm-delete="true">
                                                <i class="bx bx-trash-alt"></i>
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
