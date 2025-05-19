@extends('pages.layout')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="mb-3">{{ $bank ? 'Edit Bank' : 'Tambah Bank' }}</h3>

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

                    <form action="{{ $bank ? route('bank.update', $bank->id_bank) : route('bank.store') }}"
                        method="POST">
                        @csrf
                        @if ($bank)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Bank</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama bank" name="nama_bank"
                                value="{{ old('nama_bank', $bank->nama_bank ?? '') }}" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Rekening</label>
                            <input type="number" class="form-control" placeholder="Masukkan nomor rekening" name="nomor_rekening"
                                value="{{ old('nomor_rekening', $bank->nomor_rekening ?? '') }}" />

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Rekening</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama rekening" name="nama_rekening"
                                value="{{ old('nama_rekening', $bank->nama_rekening ?? '') }}" />
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $bank ? 'Update' : 'Tambah' }}</button>
                        <a href="{{ route('bank.index') }}" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
