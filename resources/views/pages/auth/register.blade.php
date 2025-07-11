<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('template/img/Siwartegg.png')}}">
    <title>SiWarTeg - Daftar Akun</title>

    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .bg-login-image {
            background: url('{{ asset('template/img/Siwarteg.png') }}') center center no-repeat;
            background-size: contain; /* Menggunakan 'contain' agar gambar logo tidak terpotong dan terlihat penuh */
        }
        .login-container { /* Diganti namanya agar lebih generik untuk halaman otentikasi */
            display: flex;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
        }
        .welcome-text { /* Disesuaikan untuk halaman register */
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .btn-register { /* Class baru untuk tombol registrasi */
            font-size: 0.9rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
        }
        /* CSS untuk toggle password, sama seperti di ubah-pw.blade.php */
        .input-group-text {
            cursor: pointer;
            transition: all 0.3s;
        }
        .input-group-text:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    @if ($errors->any())
        <script>
            Swal.fire({
                title: "Terjadi Kesalahan",
                text: "@foreach($errors->all() as $error) {{$error}} {{$loop->last ? '.' : ',' }}@endforeach",
                icon: "error"
            });
        </script>
    @endif

    <div class="container login-container">
        <div class="row justify-content-center w-100">
            <div class="col-xl-8 col-lg-8 col-md-9"> <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-login-image p-5">
                                </div>

                            <div class="col-lg-6 p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 mb-3 welcome-text">Daftar Akun Baru</h1>
                                    <h2 class="h4 text-gray-900 mb-4"><b>Siaga Warga Tetangga!</b></h2>
                                </div>
                                <form class="user" action="/register" method="POST" onsubmit="const submitBtn = document.getElementById('submitBtn'); submitBtn.disabled = true; submitBtn.textContent = 'Mendaftarkan...'">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror "
                                            id="inputName" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda...">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="inputEmail" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Masukkan alamat email Anda...">
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="inputPassword" placeholder="Masukkan password Anda...">
                                            <div class="input-group-append">
                                                <span class="input-group-text toggle-password" data-target="inputPassword">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                                id="inputPasswordConfirm" placeholder="Konfirmasi password Anda...">
                                            <div class="input-group-append">
                                                <span class="input-group-text toggle-password" data-target="inputPasswordConfirm">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button id="submitBtn" type="submit" class="btn btn-primary btn-user btn-block btn-register">
                                        Daftar Akun
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center mt-3">
                                    <a class="small" href="/">Sudah punya akun? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <script src="{{ asset('template/js/sb-admin-2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            // Toggle password visibility for multiple fields
            $('.toggle-password').click(function() {
                var target = $(this).data('target');
                var input = $('#' + target);
                var icon = $(this).find('i'); // Find the <i> element (the icon) inside the clicked span

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change to eye-slash icon
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change back to eye icon
                }
            });
        });
    </script>

</body>

</html>