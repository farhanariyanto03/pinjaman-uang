@extends('pages.layout')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="mb-3">{{ $pinjaman ? 'Edit Pinjaman' : 'Tambah Pinjaman' }}</h3>

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

                    <form action="{{ $pinjaman ? route('pinjaman.update', $pinjaman->id_pinjaman) : route('pinjaman.store') }}"
                        method="POST">
                        @csrf
                        @if ($pinjaman)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Jumlah Uang</label>
                            <input type="number" class="form-control" placeholder="Masukkan jumlah uang" name="jumlah_uang"
                                value="{{ old('jumlah_uang', $pinjaman->jumlah_uang ?? '') }}" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tenor (Per Bulan)</label>
                            <input type="number" class="form-control" placeholder="Masukkan tenor" name="tenor"
                                value="{{ old('tenor', $pinjaman->tenor ?? '') }}" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bunga (%)</label>
                            <input type="number" class="form-control" placeholder="Masukkan bunga" name="bunga"
                                value="{{ old('bunga', $pinjaman->bunga ?? '') }}" />
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $pinjaman ? 'Update' : 'Tambah' }}</button>
                        <a href="{{ route('pinjaman.index') }}" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
