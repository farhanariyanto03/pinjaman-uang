@extends('pages.layout')

@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form id="formAccountSettings" action="{{ route('karyawan.profile.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="card-header">Profile</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ asset(Auth::user()->informasiPribadi->foto_user ?? 'admin/img/avatars/1.png') }}"
                            alt="user-avatar" class="d-block rounded" height="150" width="150" id="previewFotoUser" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload foto user</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" name="foto_user" id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" />
                            </label>

                            <p class="text-muted mb-0">JPG, GIF atau PNG. Maksimal size 2048KB</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">NamaLengkap</label>
                            <input class="form-control" type="text" id="firstName" name="nama"
                                value="{{ Auth::user()->nama }}" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Role</label>
                            <input class="form-control" type="text" name="role" id="lastName"
                                value="{{ Auth::user()->role }}" disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email"
                                value="{{ Auth::user()->email }}" placeholder="john.doe@example.com" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" value="" />
                            <p class="text-danger">* Kosongkan jika tidak ingin mengganti password</p>
                        </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
