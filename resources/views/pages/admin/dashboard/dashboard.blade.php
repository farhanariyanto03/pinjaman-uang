@extends('pages.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Hallo Selaat datang {{ Auth::user()->nama }}! 🎉</h5>
                                <p class="mb-4">
                                    Selamat datang di halaman dashboard admin, dari sini anda dapat mengatur dan mengelola
                                    data-data yang berhubungan dengan pinjaman dan cicilan, serta mengelola user yang
                                    terdaftar di aplikasi ini.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('admin/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('admin/img/icons/unicons/cc-success.png') }}" alt="chart success"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Pengajuan</span>
                                <h3 class="card-title mb-2">{{ $pengajuan }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('admin/img/icons/unicons/cc-success.png') }}" alt="Credit Card"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span>Total Pinjaman Lunas</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $lunas }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('admin/img/icons/unicons/cc-success.png') }}" alt="Credit Card"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span>Total Karyawan</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $karyawan }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
