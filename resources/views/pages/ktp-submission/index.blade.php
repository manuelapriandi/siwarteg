@extends('layouts.app')

@section('content')

@if (session('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session()->get('success') }}",
        icon: "success",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        title: "Terjadi Kesalahan!",
        text: "{{ session()->get('error') }}",
        icon: "error",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

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
        background-color: var(--background-body); /* Latar belakang dropdown */
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

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Daftar Pengajuan Berkas' : 'Pengajuan Berkas Saya' }}</h1>
    @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->resident))
    <a href="/ktp-submission/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Pengajuan Berkas
    </a>
    @endif
</div>

<div class="row">
    <div class="col">
        <div class="card shadow mb-4"> {{-- Tambahkan mb-4 agar ada jarak dengan tabel di bawah --}}
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary" style="text-align: center;">{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'KETENTUAN PENGECEKAN AJUAN BERKAS DARI WARGA' : 'SYARAT PENGAJUAN BERKAS UNTUK SURAT PENGANTAR' }}</h3>
                
                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                <h5 style="color:red; text-align: center; margin-top: 10px"><b>Catatan: Sistem telah menyarankan bahwa warga bisa mengirim seluruh persyaratan di 1 pdf agar<br> memudahkan pengecekan,dan bisa juga dikirim satu-persatu baik dengan file pdf/foto.</b></h5>
                @else
                <h5 style="color:red; text-align: center; margin-top: 10px"><b>Catatan: Seluruh persyaratan disarankan dibuat menjadi 1 pdf agar memudahkan pengecekan,<br>dan bisa juga mengirim satu-persatu baik dengan file pdf/foto.</b></h5>
                @endif
                <h5 style="margin-top: 10px; margin-left: 20px">Surat Pengantar Pembuatan KK:</h5>
                <ul style="margin-left: 20px">
                    <li>Scan KTP-el (KTP Fisik)</li>
                    <li>Scan Kartu Keluarga (KK) lama (jika ada, misalnya untuk perubahan data, penambahan/pengurangan anggota, atau pecah KK)</li>
                    <li>Warga menyampaikan tujuan pembuatan KK secara jelas di catatan saat warga mengajukan berkas</li>
                </ul>

                <h5 style="margin-left: 20px">Surat Pengantar Pembuatan Akta Kelahiran:</h5>
                <ul style="margin-left: 20px">
                    <li>Foto/Scan KTP-el (KTP Fisik) orang tua pelapor.</li>
                    <li>Scan Kartu Keluarga (KK) asli. Pastikan nama bayi sudah tercantum dalam KK. Jika belum, warga perlu mengurus penambahan anggota keluarga di KK terlebih dahulu.</li>
                    <li>Scan Buku Nikah / Akta Perkawinan orang tua</li>
                    <li>Scan Surat Keterangan Kelahiran ASLI dari Dokter/Bidan</li>
                    <li>Scan Formulir Permohonan Pencatatan Kelahiran (F-2.01 atau sejenisnya)</li>
                </ul>

                <h5 style="margin-left: 20px">Surat Pengantar Pembuatan SKCK (Surat Keterangan Catatan Kepolisian):</h5>
                <ul style="margin-left: 20px">
                    <li>Scan Kartu Tanda Penduduk (KTP) Asli</li>
                    <li>Scan Kartu Keluarga (KK)</li>
                    <li>Scan Akta Lahir / Ijazah Terakhir</li>
                </ul>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <th width="15%">Nama Warga</th>
                                @endif
                                <th width="15%">Jenis Pengajuan</th>
                                <th width="20%">Catatan</th>
                                <th width="15%">Status</th>
                                <th width="15%">Dokumen Syarat</th>
                                <th width="10%">Tanggal Pengajuan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        @if (count($ktpSubmissions) < 1)
                        <tbody>
                            <tr>
                                <td colspan="{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 8 : 7 }}">
                                    <p class="pt-3 text-center">Data tidak ada</p>
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach ($ktpSubmissions as $item)
                            <tr>
                                <td>{{ $loop->iteration + $ktpSubmissions->firstItem() - 1 }}</td>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <td>{{ $item->resident->nama ?? 'N/A' }}</td>
                                @endif
                                <td>Surat Pengantar {{ $item->submission_type }}</td>
                                <td style="white-space: pre-wrap; word-wrap: break-word;">{!! wordwrap($item->notes ?? 'Tidak ada catatan', 50, "<br>\n") !!}</td>
                                <td><span class="badge badge-{{ $item->status_color }}">{{ $item->status_label }}</span></td>
                                <td>
                                    @if (isset($item->document_proof))
                                    @php
                                    $filePath = 'storage/' . $item->document_proof;
                                    @endphp

                                    <a href="{{ asset($filePath)}}" target="_blank" rel="noopener noreferrer">
                                        {{-- Jika ini adalah gambar, tampilkan gambar, jika PDF, tampilkan icon --}}
                                        @if (in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset($filePath)}}" alt="Dokumen Syarat">
                                        @else
                                        <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                        @endif
                                    </a>
                                    @else
                                    Tidak ada
                                    @endif
                                </td>
                                <td>{{ $item->submission_date_label }}</td>
                                <td>
                                    @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->resident))
                                    <div class="d-flex align-items-center">
                                        @if ($item->status == 'baru')
                                        <a href="/ktp-submission/{{ $item->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#konfirmasiDelete-{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endif
                                        {{-- Tombol Lihat Catatan Admin, hanya tampilkan jika ada catatan admin --}}
                                        @if ($item->admin_notes)
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#lihatCatatanAdmin-{{ $item->id }}">
                                            <i class="fas fa-comment-alt"></i> Catatan RT/RW
                                        </button>
                                        @endif
                                    </div>
                                    @elseif(auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                    <div>
                                        <form id="formChangeStatus-{{$item->id}}" action="{{ url('ktp-submission/update-status/' . $item->id) }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group mb-2">
                                                <select name="status" id="status-{{$item->id}}" class="form-control status-select" onchange="this.form.submit()">
                                                    @foreach ([
                                                        (object) ['label' => 'Baru', 'value' => 'baru'],
                                                        (object) ['label' => 'Sedang Proses', 'value' => 'diproses'],
                                                        (object) ['label' => 'Selesai', 'value' => 'selesai'],
                                                        (object) ['label' => 'Ditolak', 'value' => 'ditolak'],
                                                    ] as $statusOption)
                                                    <option value="{{ $statusOption->value }}" @selected($item->status == $statusOption->value)>{{ $statusOption->label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="admin_notes" class="form-control" placeholder="Catatan Admin (opsional)" rows="2">{{ $item->admin_notes }}</textarea>
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update Status</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            {{-- Modal untuk Melihat Catatan Admin (diletakkan di dalam foreach loop) --}}
                            @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->resident) && $item->admin_notes)
                            <div class="modal fade" id="lihatCatatanAdmin-{{ $item->id }}" tabindex="-1" aria-labelledby="lihatCatatanAdminLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="lihatCatatanAdminLabel-{{ $item->id }}">Catatan Admin untuk Pengajuan Berkas {{ $item->submission_type }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Status Pengajuan:</strong> <span class="badge badge-{{ $item->status_color }}">{{ $item->status_label }}</span></p>
                                            <p><strong>Catatan dari Admin:</strong></p>
                                            <p class="admin-notes-content">{{ $item->admin_notes ?? 'Tidak ada catatan dari admin.' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @include('pages.ktp-submission.konfirmasi-delete')
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
            @if($ktpSubmissions->lastPage() > 1)
            <div class="card-footer">
                {{ $ktpSubmissions->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection