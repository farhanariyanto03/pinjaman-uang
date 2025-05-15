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
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('cekLogin') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Halaman 1: Login -->
                            <div class="page" id="page-1">
                                <div class="text-center mb-4">
                                    <h3 class="fw-bold text-primary">Registrasi</h3>
                                    <p class="text-muted mb-0">Masukkan data diri Anda dengan lengkap, Jika sudah punya akun silahkan <a href="{{ route('login') }}" class="text-primary">Login Disini</a></p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Masukkan email anda" value="{{ old('email') }}" autofocus />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="************" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Halaman 2: Biodata -->
                            <div class="page d-none" id="page-2">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukkan nama lengkap" />
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
                            </div>

                            <!-- Halaman 3: Upload Foto -->
                            <div class="page d-none" id="page-3">
                                <!-- FOTO PRIBADI -->
                                <div class="mb-4 text-center">
                                    <label class="form-label fw-bold">Foto Pribadi</label>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <img id="preview-foto-user" src="https://via.placeholder.com/150"
                                            class="img-thumbnail" style="height: 150px;" alt="Foto Pribadi" />
                                    </div>
                                    <input type="file" class="form-control mx-auto" style="max-width: 300px;"
                                        name="foto_user" onchange="previewImage(event, 'preview-foto-user')" />
                                </div>

                                <!-- FOTO KTP -->
                                <div class="mb-4 text-center">
                                    <label class="form-label fw-bold">Foto KTP</label>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <img id="preview-foto-ktp" src="https://via.placeholder.com/150"
                                            class="img-thumbnail" style="height: 150px;" alt="Foto KTP" />
                                    </div>
                                    <input type="file" class="form-control mx-auto" style="max-width: 300px;"
                                        name="foto_ktp" onchange="previewImage(event, 'preview-foto-ktp')" />
                                </div>

                                <!-- FOTO KK -->
                                <div class="mb-4 text-center">
                                    <label class="form-label fw-bold">Foto KK</label>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <img id="preview-foto-kk" src="https://via.placeholder.com/150"
                                            class="img-thumbnail" style="height: 150px;" alt="Foto KK" />
                                    </div>
                                    <input type="file" class="form-control mx-auto" style="max-width: 300px;"
                                        name="foto_kk" onchange="previewImage(event, 'preview-foto-kk')" />
                                </div>
                            </div>

                            <!-- Halaman 4: Konfirmasi -->
                            <div class="page d-none" id="page-4">
                                <div class="card shadow-sm mx-auto" style="max-width: 500px;">
                                    <div class="card-header bg-label-primary text-center">
                                        <i class="bx bx-check-circle bx-lg text-success mb-2"></i>
                                        <h5 class="card-title mb-1">Konfirmasi Data</h5>
                                        <p class="mb-0">Silakan periksa kembali semua data yang telah Anda isi
                                            sebelum menyimpan.</p>
                                    </div>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn btn-primary mt-2 px-4">
                                            <i class="bx bx-save me-1"></i> Simpan Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Navigasi -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="prevPage()">Sebelumnya</button>
                            <button type="button" class="btn btn-outline-primary"
                                onclick="nextPage()">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentPage = 1;
        const totalPages = 4;

        function showPage(page) {
            for (let i = 1; i <= totalPages; i++) {
                document.getElementById(`page-${i}`).classList.add('d-none');
            }
            document.getElementById(`page-${page}`).classList.remove('d-none');
        }

        function nextPage() {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        }

        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Inisialisasi
        showPage(currentPage);
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
