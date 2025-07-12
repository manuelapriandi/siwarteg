<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('template/img/Siwartegg.png')}}">
    <title>SiWarTeg</title>

    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset ('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Variabel Warna Global (pastikan sama dengan layouts.app atau tempat lain yang terpusat) */
        :root {
            --primary-main: #4169E1; /* Royal Blue */
            --primary-light: #6A8BFF; /* Nuansa lebih terang dari Royal Blue */
            --primary-dark: #3150C7; /* Nuansa lebih gelap dari Royal Blue */
            --accent-color: #FFC107; /* Amber (Oranye aksen) */
            --accent-dark: #FFA000;

            --background-body: #EFEFEF; /* Latar belakang abu-abu muda */
            --card-bg: #FFFFFF; /* Latar belakang kartu putih */
            --text-dark: #212121; /* Teks gelap */
            --text-medium: #616161; /* Teks sedang */
            --text-light: #9E9E9E; /* Teks terang */
            --shadow-color-1: rgba(0, 0, 0, 0.08); /* Bayangan ringan */
            --shadow-color-2: rgba(0, 0, 0, 0.15); /* Bayangan sedang */
            --border-main: #DEDEDE; /* Warna border */
            --red-note: #dc3545; /* Merah khusus untuk catatan penting */

            /* Override Bootstrap primary color for consistency */
            --blue: var(--primary-main);
            --primary: var(--primary-main);
            --success: #28a745; /* Tetap hijau untuk sukses */
            --danger: #dc3545; /* Tetap merah untuk bahaya */
            --warning: #ffc107; /* Tetap kuning untuk warning */
            --info: #17a2b8; /* Tetap biru muda untuk info */

            /* RGB values for rgba() function */
            --primary-main-rgb: 65, 105, 225;
            --accent-color-rgb: 255, 193, 7;
            --danger-rgb: 220, 53, 69;
            --info-rgb: 23, 162, 184;
        }

        /* Page Heading Customization */
        .d-sm-flex {
            margin-bottom: 2rem !important; /* Tambah jarak bawah header */
            align-items: flex-end !important; /* Pastikan rata bawah jika ada deskripsi tambahan */
        }

        .h3.text-gray-800 {
            font-size: 1.8rem; /* Ukuran judul halaman lebih besar */
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0; /* Hapus margin bawah default */
        }

        /* Tombol Buat Pengajuan Berkas */
        .btn-primary.shadow-sm {
            background-color: var(--primary-main) !important;
            border-color: var(--primary-main) !important;
            box-shadow: 0 4px 15px rgba(var(--primary-main-rgb), 0.2) !important;
            border-radius: 10px; /* Radius tombol lebih besar */
            padding: 0.75rem 1.25rem; /* Padding tombol */
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary.shadow-sm:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
            transform: translateY(-2px); /* Efek lift pada hover */
            box-shadow: 0 6px 20px rgba(var(--primary-main-rgb), 0.3) !important;
        }
        .btn-primary.shadow-sm i {
            margin-right: 0.5rem; /* Jarak ikon dengan teks */
        }

        /* Card Styling General */
        .card.shadow {
            border-radius: 20px; /* Card lebih membulat */
            box-shadow: 0 15px 40px var(--shadow-color-1) !important; /* Bayangan card lebih menonjol */
            border: none; /* Hapus border default card */
            overflow: hidden; /* Pastikan border radius diterapkan dengan baik */
        }

        .card-header {
            background-color: var(--card-bg); /* Latar belakang header card putih (default) */
            border-bottom: 1px solid var(--border-main); /* Border bawah header card */
            padding: 1.25rem 2rem; /* Padding header card */
        }

        .card-header h6 {
            font-size: 1.1rem; /* Ukuran judul header card lebih besar */
            font-weight: 700; /* Lebih tebal */
            color: var(--primary-main) !important; /* Warna judul header card mengikuti primary-main */
        }

        .card-body {
            padding: 2rem; /* Padding dalam card lebih luas */
        }

        /* Spesific Styling for Ketentuan/Syarat Card Header */
        .card.shadow.mb-4 .card-header {
            /* Mengatur ulang untuk mengikuti gaya asli dari pengguna */
            padding: 1.25rem 2rem; /* Padding umum */
        }

        .card.shadow.mb-4 .card-header h3 {
            font-size: 1.4rem; /* Ukuran judul ketentuan lebih besar */
            font-weight: 700;
            color: var(--primary-main) !important;
            text-align: center; /* Tetap rata tengah */
        }

        /* Table Styling */
        .table {
            margin-bottom: 0; /* Hapus margin bawah default tabel */
            font-size: 0.9rem; /* Ukuran font default untuk seluruh tabel */
        }

        .table th, .table td {
            padding: 0.9rem 1rem; /* Padding sel tabel lebih luas */
            vertical-align: middle; /* Rata tengah vertikal tetap */
            color: var(--text-medium);
            border-color: var(--border-main); /* Warna border tabel */
            white-space: normal; /* Izinkan teks wrap */
        }

        .table thead th {
            background-color: var(--background-body); /* Latar belakang header tabel abu-abu muda */
            color: var(--text-dark);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem; /* Ukuran font header sedikit lebih kecil */
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--primary-light); /* Border bawah header tabel biru */
            padding: 0.9rem 1rem; /* Padding sama dengan td */
        }

        .table-hovered tbody tr:hover {
            background-color: rgba(var(--primary-main-rgb), 0.05); /* Efek hover ringan pada baris tabel */
            cursor: pointer;
        }

        /* Alternating row colors for better readability */
        .table tbody tr:nth-of-type(odd) {
            background-color: var(--card-bg); /* Putih */
        }
        .table tbody tr:nth-of-type(even) {
            background-color: var(--background-body); /* Abu-abu muda */
        }

        /* Pesan Data Tidak Ada */
        .table td p.pt-3 {
            color: var(--text-medium);
            font-style: italic;
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        /* Document Proof Styling (Image/PDF) */
        td img[alt="Dokumen Syarat"] {
            max-width: 80px; /* Lebar maksimum gambar bukti */
            height: auto;
            border-radius: 8px; /* Sudut gambar membulat */
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Bayangan pada gambar */
            transition: transform 0.2s ease;
        }
        td img[alt="Dokumen Syarat"]:hover {
            transform: scale(1.05); /* Efek zoom ringan pada hover */
        }
        td .fa-file-pdf {
            font-size: 2.2rem; /* Ukuran ikon PDF */
            color: #DC3545; /* Warna merah untuk ikon PDF */
            transition: color 0.2s ease;
            vertical-align: middle;
        }
        td .fa-file-pdf:hover {
            color: #A0202F; /* Warna lebih gelap saat hover */
        }
        td a[target="_blank"] {
            display: flex; /* Menggunakan flexbox untuk alignment */
            align-items: center; /* Rata tengah vertikal */
            gap: 8px; /* Jarak antara ikon dan teks */
            text-decoration: none;
            color: var(--primary-main);
            font-weight: 500;
            font-size: 0.85rem;
        }
        td a[target="_blank"]:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }


        /* Status Badge Styling */
        .badge {
            font-size: 0.75rem; /* Ukuran badge */
            padding: 0.4em 0.6em;
            border-radius: 5px; /* Sudut badge */
            font-weight: 600; /* Ketebalan font badge */
            text-transform: uppercase; /* Huruf besar semua */
            letter-spacing: 0.2px;
        }
        /* Pastikan warna badge sesuai dengan Bootstrap default dan teksnya terbaca */
        .badge-primary {
            background-color: var(--primary-main) !important;
            color: white !important; /* Teks putih untuk primary (gelap) */
        }
        .badge-info {
            background-color: var(--info) !important;
            color: white !important; /* Teks putih untuk info (cukup gelap) */
        }
        .badge-warning {
            background-color: var(--accent-color) !important;
            color: var(--text-dark) !important; /* Teks gelap untuk warning (terang) */
        }
        .badge-success {
            background-color: var(--success) !important;
            color: white !important; /* Teks putih untuk success (gelap) */
        }
        .badge-danger {
            background-color: var(--danger) !important;
            color: white !important; /* Teks putih untuk danger (gelap) */
        }


        /* Aksi Tombol di Tabel */
        .d-flex.align-items-center {
            gap: 6px !important; /* Jarak antar tombol aksi sedikit lebih rapat */
            flex-wrap: wrap; /* Izinkan wrap jika banyak tombol */
        }

        .btn-sm {
            padding: 0.45rem 0.7rem; /* Padding tombol aksi lebih kecil */
            font-size: 0.75rem; /* Ukuran font lebih kecil */
            border-radius: 6px; /* Tombol aksi lebih membulat tapi tidak terlalu besar */
            transition: all 0.2s ease;
        }
        .btn-sm i {
            font-size: 0.7rem; /* Ukuran ikon lebih kecil */
        }

        /* Edit Button */
        .btn-warning {
            background-color: var(--accent-color) !important;
            border-color: var(--accent-color) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(var(--accent-color-rgb), 0.2);
        }
        .btn-warning:hover {
            background-color: var(--accent-dark) !important;
            border-color: var(--accent-dark) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(var(--accent-color-rgb), 0.3);
        }

        /* Delete Button */
        .btn-danger {
            background-color: var(--danger) !important;
            border-color: var(--danger) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(var(--danger-rgb), 0.2);
        }
        .btn-danger:hover {
            background-color: #bd2130 !important;
            border-color: #bd2130 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(var(--danger-rgb), 0.3);
        }

        /* Info Button (Lihat Catatan Admin) */
        .btn-info {
            background-color: var(--info) !important;
            border-color: var(--info) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(var(--info-rgb), 0.2);
        }
        .btn-info:hover {
            background-color: #138496 !important;
            border-color: #138496 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(var(--info-rgb), 0.3);
        }


        /* Admin Status Dropdown & Textarea */
        .form-control.status-select { /* Kelas baru untuk dropdown status */
            min-width: 130px; /* Lebar minimum dropdown sedikit disesuaikan */
            font-size: 0.85rem; /* Ukuran font dropdown */
            border-radius: 8px; /* Sudut dropdown membulat */
            border: 1px solid var(--border-main); /* Border dropdown */
            background-color: var(--background-body);
            color: var(--text-dark);
            padding: 0.5rem 1rem; /* Padding dropdown */
            height: auto; /* Agar padding bekerja */
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Bayangan dropdown */
            transition: all 0.2s ease;
        }
        .form-control.status-select:focus {
            border-color: var(--primary-main);
            box-shadow: 0 0 0 3px rgba(var(--primary-main-rgb), 0.2);
            outline: none;
        }

        textarea.form-control {
            border-radius: 8px;
            border: 1px solid var(--border-main);
            background-color: var(--background-body);
            color: var(--text-dark);
            font-size: 0.85rem;
            padding: 0.75rem 1rem;
            margin-top: 0.5rem;
            transition: all 0.2s ease;
        }
        textarea.form-control:focus {
            border-color: var(--primary-main);
            box-shadow: 0 0 0 3px rgba(var(--primary-main-rgb), 0.2);
            outline: none;
        }
        .btn-primary.btn-sm.mt-2 {
            background-color: var(--primary-main) !important;
            border-color: var(--primary-main) !important;
            box-shadow: 0 2px 8px rgba(var(--primary-main-rgb), 0.2);
            border-radius: 6px;
            padding: 0.4rem 0.8rem;
            font-weight: 600;
            margin-top: 0.75rem !important;
        }
        .btn-primary.btn-sm.mt-2:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(var(--primary-main-rgb), 0.3);
        }


        /* Pagination Styling */
        .card-footer {
            background-color: var(--card-bg);
            border-top: 1px solid var(--border-main);
            padding: 1.5rem 2rem;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .pagination {
            margin-bottom: 0;
            justify-content: center;
            flex-wrap: wrap;
        }

        .page-item .page-link {
            border-radius: 8px;
            margin: 0 4px;
            color: var(--primary-main);
            background-color: var(--background-body);
            border: 1px solid var(--border-main);
            transition: all 0.3s ease;
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            font-size: 0.9rem;
        }

        .page-item.active .page-link {
            background-color: var(--primary-main) !important;
            border-color: var(--primary-main) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(var(--primary-main-rgb), 0.2);
        }

        .page-item .page-link:hover {
            background-color: var(--primary-light) !important;
            border-color: var(--primary-light) !important;
            color: white !important;
        }

        .page-item.disabled .page-link {
            color: var(--text-light) !important;
            background-color: var(--background-body) !important;
            border-color: var(--border-main) !important;
        }

        .highlighted-note-box {
    background-color: var(--background-body); /* Menggunakan warna abu-abu muda dari variabel Anda */
    padding: 1.5rem; /* Jarak internal di dalam kotak */
    border-radius: 15px; /* Membuat sudut membulat */
    text-align: center; /* Memusatkan teks di dalam kotak */
    margin-bottom: 2rem; /* Jarak bawah kotak dari elemen selanjutnya */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); /* Bayangan tipis agar terlihat menonjol */
    border: 1px solid var(--border-main); /* Border tipis opsional */
}

    .highlighted-note-box h3 {
        color: var(--primary-main) !important; /* Memastikan judul berwarna Royal Blue */
        font-weight: 700;
        font-size: 1.8rem; /* Ukuran font judul */
        margin-bottom: 1rem; /* Jarak antara judul dan catatan */
    }

    .highlighted-note-box .note-text { /* Gaya untuk teks catatan */
        color: var(--red-note) !important; /* Menggunakan variabel warna merah Anda */
        font-size: 1rem; /* Ukuran font catatan */
        line-height: 1.4; /* Jarak antar baris */
        margin-top: 0.2rem; /* Mengatur ulang margin atas jika diperlukan */
    }

    /* Pastikan h5 dalam card-header tidak terpengaruh jika ada h5 lain */
    .card-header h5 {
        color: inherit; /* Tetapkan warna default dari parent atau Bootstrap */
        font-size: 1.1rem; /* Ukuran font standar */
        font-weight: 700;
    }

        /* Modal for Admin Notes */
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .modal-header {
            background-color: var(--primary-main);
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 1.2rem 1.5rem;
            border-bottom: none;
        }
        .modal-title {
            font-weight: 600;
            font-size: 1.1rem;
        }
        .modal-header .btn-close { /* For Bootstrap 5 close button */
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .modal-body {
            padding: 1.5rem;
            color: var(--text-dark);
        }
        .modal-body p strong {
            color: var(--text-dark);
        }
        .modal-body p {
            margin-bottom: 0.75rem;
        }
        .modal-body p.admin-notes-content {
            background-color: var(--background-body);
            padding: 1rem;
            border-radius: 10px;
            margin-top: 0.5rem;
            white-space: pre-wrap; /* Preserve whitespace and line breaks */
            font-family: monospace, sans-serif;
            font-size: 0.9rem;
            color: var(--text-dark);
            border: 1px solid var(--border-main);
        }
        .modal-footer {
            border-top: 1px solid var(--border-main);
            padding: 1rem 1.5rem;
            justify-content: flex-end;
        }
        .modal-footer .btn-secondary {
            background-color: var(--text-light);
            border-color: var(--text-light);
            color: white;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.6rem 1rem;
        }
        .modal-footer .btn-secondary:hover {
            background-color: #888;
            border-color: #888;
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }
            .table th, .table td {
                padding: 0.75rem;
                font-size: 0.85rem;
            }
            .btn-primary.shadow-sm {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
            .h3.text-gray-800 {
                font-size: 1.5rem;
            }
            .d-sm-flex {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
            }
            .card-header {
                padding: 1rem 1.5rem;
            }
            .card-header h6 {
                font-size: 1rem;
            }
            .card.shadow.mb-4 .card-header h3 {
                font-size: 1.2rem;
            }
        }
    </style>
    </head>

<body id="page-top">

    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layouts.navbar')
                <div class="container-fluid">

                    @yield('content')

                </div>
                </div>
            @include('layouts.footer')
            </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/logout" method="post">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ingin Logout?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Apakah Anda ingin keluar dari akun SiWarTeg sekarang?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset ('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset ('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset ('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset ('template/js/sb-admin-2.min.js')}}"></script>

    <script src="{{ asset ('template/vendor/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset ('template/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset ('template/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>


</body>

</html>