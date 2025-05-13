@extends('pages.layout')


@section('content')
    <!-- Pengajuan -->
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="mb-1">Pembayaran Cicilan</h2>
            </div>
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
            <form action="{{ route('karyawan.pembayaran-cicilan-karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <label class="form-label mb-3">Metode Pembayaran</label>
                    <input type="hidden" name="id_pengajuan_pinjaman" value="{{ $cicilan->id_pengajuan_pinjaman }}" readonly>

                    <!-- Transfer Manual -->
                    <div class="form-check border rounded p-3 mb-2">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" id="transferManual"
                            value="transfer" checked>
                        <label class="form-check-label fw-bold" for="transferManual">
                            Transfer Manual
                        </label>
                        <div class="text-muted ms-4">Lakukan pembayaran melalui transfer bank dan upload bukti pembayaran
                        </div>
                    </div>

                    <!-- Potong Gaji -->
                    <div class="form-check border rounded p-3">
                        <input class="form-check-input" type="radio" name="metode_pembayaran" id="potongGaji"
                            value="potong gaji">
                        <label class="form-check-label fw-bold" for="potongGaji">
                            Potong Gaji
                        </label>
                        <div class="text-muted ms-4">Pembayaran cicilan akan dipotong langsung dari gaji Anda</div>
                    </div>

                    <!-- Informasi Rekening -->
                    <div class="border rounded p-3 mt-3" id="informasiRekening">
                        <h6 class="fw-bold">Informasi Rekening</h6>
                        <div class="row">
                            <div class="col-4">Bank</div>
                            <div class="col-8">: Bank Mandiri</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Nomor Rekening</div>
                            <div class="col-8">: 1234567890</div>
                        </div>
                        <div class="row">
                            <div class="col-4">Atas Nama</div>
                            <div class="col-8">: PT Sistem Pinjaman</div>
                        </div>
                    </div>

                    <!-- Upload Bukti Pembayaran (hanya untuk transfer) -->
                    <div class="mt-3" id="buktiTransferSection">
                        <label for="buktiTf" class="form-label fw-bold">Upload Bukti Pembayaran</label>
                        <input class="form-control" type="file" name="bukti_tf" id="buktiTf" />
                    </div>

                    <!-- Jumlah Uang -->
                    <div class="mt-3" id="jumlahUangSection">
                        <label for="jumlahUang" class="form-label fw-bold">Jumlah Uang Yang Harus Dibayar</label>
                        <input type="number" class="form-control" name="jumlah_uang" id="jumlahUang"
                            placeholder="Masukkan jumlah" value="{{ $cicilan->pinjaman->angsuran_per_bulan }}" readonly/>
                    </div>
                    <button class="btn btn-primary mt-3 w-100" type="submit">Ajukan Pinjaman</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const transferRadio = document.getElementById('transferManual');
        const gajiRadio = document.getElementById('potongGaji');
        const buktiSection = document.getElementById('buktiTransferSection');
        const jumlahSection = document.getElementById('jumlahUangSection');
        const rekeningSection = document.getElementById('informasiRekening');

        function toggleSections() {
            if (transferRadio.checked) {
                buktiSection.classList.remove('d-none');
                rekeningSection.classList.remove('d-none');
            } else if (gajiRadio.checked) {
                buktiSection.classList.add('d-none');
                rekeningSection.classList.add('d-none');
            }
        }

        toggleSections();

        transferRadio.addEventListener('change', toggleSections);
        gajiRadio.addEventListener('change', toggleSections);
    </script>
@endsection
