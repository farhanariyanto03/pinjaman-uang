@extends('pages.layout')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="mb-3">{{ $bunga ? 'Edit bunga' : 'Tambah bunga' }}</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ $bunga ? route('admin.bunga.update', $bunga->id_bunga) : route('bunga.store') }}"
                        method="POST">
                        @csrf
                        @if ($bunga)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Bunga</label>
                            <input type="number" class="form-control" placeholder="Masukkan nama bunga" name="bunga"
                                value="{{ old('bunga', $bunga->bunga ?? '') }}" />
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $bunga ? 'Update' : 'Tambah' }}</button>
                        <a href="{{ route('admin.bunga') }}" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
