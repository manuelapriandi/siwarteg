@extends('layouts.app')

@section('content')

<!-- SweetAlert2 untuk notifikasi sukses/error -->
@if (session('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session()->get('success')}}",
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
        text: "{{ session()->get('error')}}",
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

    /* Tombol Buat Aduan */
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

    /* Card Styling */
    .card.shadow {
        border-radius: 20px; /* Card lebih membulat */
        box-shadow: 0 15px 40px var(--shadow-color-1) !important; /* Bayangan card lebih menonjol */
        border: none; /* Hapus border default card */
        overflow: hidden; /* Pastikan border radius diterapkan dengan baik */
    }

    .card-header {
        background-color: var(--background-body); /* Latar belakang header card abu-abu muda */
        border-bottom: 2px solid var(--border-main); /* Border bawah header card */
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

    /* Table Styling */
    .table {
        margin-bottom: 0; /* Hapus margin bawah default tabel */
    }

    .table th, .table td {
        padding: 0.75rem; /* Default padding sel tabel Bootstrap */
        font-size: 0.85rem; /* Default font size sel tabel Bootstrap */
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
        font-size: 0.8rem; /* Ukuran font header sedikit lebih kecil */
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--primary-light); /* Border bawah header tabel biru */
        padding: 0.75rem; /* Padding sama dengan td */
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

    /* Image Proof Styling */
    td img[alt="Foto Bukti"] {
        max-width: 80px; /* Lebar maksimum gambar bukti */
        height: auto;
        border-radius: 8px; /* Sudut gambar membulat */
        box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Bayangan pada gambar */
        transition: transform 0.2s ease;
    }
    td img[alt="Foto Bukti"]:hover {
        transform: scale(1.05); /* Efek zoom ringan pada hover */
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
    /* Pastikan warna badge sesuai dengan Bootstrap default */
    .badge-primary { background-color: var(--primary) !important; }
    .badge-info { background-color: var(--info) !important; }
    .badge-warning { background-color: var(--warning) !important; }
    .badge-success { background-color: var(--success) !important; }
    .badge-danger { background-color: var(--danger) !important; }


    /* Aksi Tombol di Tabel */
    .d-flex.align-items-center {
        gap: 6px !important; /* Jarak antar tombol aksi sedikit lebih rapat */
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
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
    }
    .btn-danger:hover {
        background-color: #bd2130 !important;
        border-color: #bd2130 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    /* Admin Status Dropdown */
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
        .form-control.status-select {
            min-width: 100px;
            font-size: 0.8rem;
        }
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Aduan Warga' : 'Aduan'}}</h1>
    @if (isset(auth()->user()->resident))
    <a href="/complaint/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>Buat Aduan
    </a>
    @endif
</div>

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Aduan</h6>
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
                                <th width="15%">Judul</th>
                                <th width="25%">Isi Aduan</th>
                                <th width="10%">Status</th>
                                <th width="15%">Bukti (Foto)</th>
                                <th width="10%">Tanggal Laporan</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        @if (count($complaints) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 8 : 7 }}">
                                        <p class="pt-3 text-center">Data tidak ada</p>
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($complaints as $item)
                                   <tr>
                                        <td>{{ $loop->iteration + $complaints->firstItem() - 1 }}</td>
                                        @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                            <td>{{$item->resident->nama ?? 'Warga Tidak Dikenal'}}</td>
                                        @endif
                                        <td>{{ $item->title }}</td>
                                        <td style="white-space: pre-wrap; word-wrap: break-word;">{!! wordwrap($item->content,50,"<br>\n") !!}</td>
                                        <td><span class="badge badge-{{$item->status_color}}">{{ $item->status_label }}</span></td>
                                        <td>
                                            @if (isset($item->photo_proof))
                                                @php
                                                    $filePath = 'storage/' . $item->photo_proof;
                                                @endphp
                                                <a href="{{ asset($filePath)}}" target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ asset($filePath)}}" alt="Foto Bukti" style="max-width: 100px">
                                                </a>
                                            @else
                                                Tidak ada
                                            @endif
                                        </td>
                                        <td>{{ $item->report_date_label}}</td>
                                        <td>
                                            @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER && isset(auth()->user()->resident) && $item->status == 'baru')
                                            <div class="d-flex align-items-center">
                                                <a href="/complaint/{{ $item->id }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#konfirmasiDelete-{{ $item->id }}">
                                                    <i class="fas fa-eraser"></i>
                                                </button>
                                            </div>
                                            @elseif(auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                            <div>
                                                <form id="formChangeStatus-{{$item->id}}" action="{{ url('complaint/update-status/' . $item->id) }}" method="post">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group mb-0"> {{-- Hapus margin bawah default form-group --}}
                                                    <select name="status" id="status-{{$item->id}}" class="form-control status-select" onchange="document.getElementById('formChangeStatus-{{$item->id}}').submit()">
                                                        @foreach ([
                                                            (object) ['label' => 'Baru', 'value' => 'baru'],
                                                            (object) ['label' => 'Sedang proses', 'value' => 'diproses'],
                                                            (object) ['label' => 'Selesai', 'value' => 'selesai'],
                                                        ] as $status)
                                                        <option value="{{$status->value}}" @selected($item->status == $status->value)>{{$status->label}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                </form>
                                            </div>
                                            @endif
                                        </td>
                                   </tr> 
                                   @include('pages.complaint.konfirmasi-delete')
                                @endforeach
                            </tbody>
                        @endif
                    </table> 
                </div>
            </div>
            @if($complaints->lastPage() > 1)
            <div class="card-footer">
                {{ $complaints->links('pagination::bootstrap-5')}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection