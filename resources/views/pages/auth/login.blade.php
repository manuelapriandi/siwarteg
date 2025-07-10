<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('template/img/Siwartegg.png')}}">
    <title>SiWarTeg - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .bg-login-image {
            background: url('{{ asset('template/img/Siwarteg.png') }}') center center no-repeat;
            background-size: contain;
        }
        .login-container {
            display: flex;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
        }
        .welcome-text {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .btn-login {
            font-size: 0.9rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
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
            <div class="col-xl-8 col-lg-8 col-md-9">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <!-- Logo Section (Left) -->
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-login-image p-5">
                                <!-- Logo will be displayed via CSS background -->
                            </div>
                            
                            <!-- Form Section (Right) -->
                            <div class="col-lg-6 p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 mb-3 welcome-text">Selamat Datang di Web</h1>
                                    <h2 class="h4 text-gray-900 mb-4"><b>Siaga Warga Tetangga!</b></h2>
                                </div>
                                <form class="user" action="/login" method="POST" onsubmit="const submitBtn = document.getElementById('submitBtn'); submitBtn.disabled = true; submitBtn.textContent = 'Memuat...'">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="inputEmail" name="email" aria-describedby="emailHelp"
                                            placeholder="Masukkan alamat email Anda...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="inputPassword" placeholder="Masukkan password...">
                                    </div>
                                    <button id="submitBtn" type="submit" class="btn btn-primary btn-user btn-block btn-login">
                                        Login
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center mt-3">
                                    <a class="small" href="/register">Buat/Daftar Akun</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js')}}"></script>
</body>
</html>