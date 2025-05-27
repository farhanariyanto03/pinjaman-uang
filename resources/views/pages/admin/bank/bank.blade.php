@extends('pages.layout')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="p-3 d-flex justify-content-start">
                <a href="{{ route('bank.create') }}" class="btn btn-primary"> + Bank</a>
            </div>
            <div class="col-md-6e p-1">
                <div class="card-body bg-white p-2" style="border-radius: 18px;">
                    <div class="table-responsive">
                        <table class="table table-hover large" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bank</th>
                                    <th>No Rekening</th>
                                    <th>Nama Rekening</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($bank as $b)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $loop->iteration }}</strong>
                                        </td>
                                        <td>{{ $b->nama_bank }}</td>
                                        <td>{{ $b->nomor_rekening }}</td>
                                        <td><span class="badge bg-label-primary me-1">{{ $b->nama_rekening }}</span></td>
                                        <td>
                                            <a href="{{ route('bank.edit', $b->id_bank) }}"
                                                class="btn btn-icon btn-outline-warning">
                                                <i class='bx bxs-pencil'></i>
                                            </a>
                                            <form action="{{ route('bank.destroy', $b->id_bank) }}" method="POST"
                                                class="d-inline">
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
    </div>
    @include('sweetalert::alert')
@endsection
