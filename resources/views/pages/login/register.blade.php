<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register</title>

    <meta name="description" content="" />
    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('admin') }}/img/favicon/LOGO2.png" /> --}}
    <!-- Fonts -->
    <link rel="preconnect" href="{{ asset('admin') }}/fonts.googleapis.com" />
    <link rel="preconnect" href="{{ asset('admin') }}/fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{ asset('admin') }}/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin') }}/js/config.js"></script>
</head>

<body>
    <div class="container-xl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card shadow-sm mx-auto">
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('storeRegister') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="text-center mb-4">
                                <h3 class="fw-bold text-primary">Registrasi</h3>
                                <p class="text-muted mb-0">Masukkan data diri Anda dengan lengkap. Jika sudah punya akun
                                    silakan <a href="{{ route('login') }}" class="text-primary">Login Disini</a></p>
                            </div>

                            <!-- Biodata -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan nama anda" value="{{ old('nama') }}" autofocus />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat"
                                    placeholder="Masukkan alamat" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" class="form-control" name="no_hp"
                                    placeholder="Masukkan nomor HP" />
                            </div>

                            <!-- Upload Foto -->
                            <div class="row">
                                <!-- Foto Pribadi -->
                                <div class="col-md-4 text-center mb-3">
                                    <label class="form-label fw-bold">Foto Pribadi</label>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <img id="preview-foto-user" src="https://via.placeholder.com/150"
                                            class="img-thumbnail" style="height: 150px;" alt="Foto Pribadi" />
                                    </div>
                                    <input type="file" class="form-control" name="foto_user"
                                        onchange="previewImage(event, 'preview-foto-user')" />
                                </div>

                                <!-- Foto KTP -->
                                <div class="col-md-4 text-center mb-3">
                                    <label class="form-label fw-bold">Foto KTP</label>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <img id="preview-foto-ktp" src="https://via.placeholder.com/150"
                                            class="img-thumbnail" style="height: 150px;" alt="Foto KTP" />
                                    </div>
                                    <input type="file" class="form-control" name="foto_ktp"
                                        onchange="previewImage(event, 'preview-foto-ktp')" />
                                </div>

                                <!-- Foto KK -->
                                <div class="col-md-4 text-center mb-3">
                                    <label class="form-label fw-bold">Foto KK</label>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <img id="preview-foto-kk" src="https://via.placeholder.com/150"
                                            class="img-thumbnail" style="height: 150px;" alt="Foto KK" />
                                    </div>
                                    <input type="file" class="form-control" name="foto_kk"
                                        onchange="previewImage(event, 'preview-foto-kk')" />
                                </div>

                                <!-- Login -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="" name="email"
                                        placeholder="Masukkan email anda" value="{{ old('email') }}" autofocus />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="************" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="bx bx-save me-1"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk preview gambar -->
    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('admin') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('admin') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('admin') }}/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
