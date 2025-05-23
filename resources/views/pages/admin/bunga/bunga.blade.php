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
                                <th>Bunga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($bunga as $b)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>1</strong>
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">{{ $b->bunga }} %</span></td>
                                    <td>
                                        <a href="{{ route('admin.bunga.edit', $b->id_bunga) }}" class="btn btn-icon btn-outline-warning">
                                            <i class='bx bxs-pencil'></i>
                                        </a>
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
