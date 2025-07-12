@extends('layouts.app')

@section('content')

@if (session('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session('success') }}",
        icon: "success",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

<style>
    /* Variabel Warna Global (sesuai dashboard) */
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
        --success: #28a745;
        --danger: #dc3545;
        --warning: #ffc107;
        --info: #17a2b8;
        /* Tambahkan primary-main-rgb jika digunakan untuk rgba() */
        --primary-main-rgb: 65, 105, 225; /* RGB untuk #4169E1 */
    }

    /* Page Heading Customization */
    .d-sm-flex {
        margin-bottom: 2rem !important;
        align-items: flex-end !important;
    }

    .h3.text-gray-800 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0;
    }

    /* Tombol Tambah Data */
    .btn-primary.shadow-sm {
        background-color: var(--primary-main) !important;
        border-color: var(--primary-main) !important;
        box-shadow: 0 4px 15px rgba(var(--primary-main-rgb), 0.2) !important;
        border-radius: 10px;
        padding: 0.75rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary.shadow-sm:hover {
        background-color: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(var(--primary-main-rgb), 0.3) !important;
    }
    .btn-primary.shadow-sm i {
        margin-right: 0.5rem;
    }

    /* Card Styling */
    .card.shadow {
        border-radius: 20px;
        box-shadow: 0 15px 40px var(--shadow-color-1) !important;
        border: none;
        overflow: hidden;
    }

    .card-body {
        padding: 2rem;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table th, .table td {
        padding: 0.75rem;
        font-size: 0.85rem;
        vertical-align: middle;
        color: var(--text-medium);
        border-color: var(--border-main);
        white-space: normal;
    }

    .table thead th {
        background-color: var(--background-body);
        color: var(--text-dark);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--primary-light); /* Menggunakan primary-light */
        padding: 0.75rem;
    }

    .table-hovered tbody tr:hover {
        background-color: rgba(var(--primary-main-rgb), 0.05); /* Menggunakan primary-main-rgb */
        cursor: pointer;
    }
    
    /* Alternating row colors for better readability */
    .table tbody tr:nth-of-type(odd) {
        background-color: var(--card-bg);
    }
    .table tbody tr:nth-of-type(even) {
        background-color: var(--background-body);
    }

    /* Pesan Data Tidak Ada */
    .table td p.pt-3 {
        color: var(--text-medium);
        font-style: italic;
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    /* Aksi Tombol di Tabel */
    .d-flex.align-items-center {
        gap: 6px !important;
    }

    .btn-sm {
        padding: 0.45rem 0.7rem;
        font-size: 0.75rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    .btn-sm i {
        font-size: 0.7rem;
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

    /* Lihat Akun Button */
    .btn-outline-info {
        color: var(--primary-main) !important; /* Menggunakan primary-main */
        border-color: var(--primary-main) !important; /* Menggunakan primary-main */
        background-color: transparent !important;
        font-weight: 600;
    }
    .btn-outline-info:hover {
        background-color: var(--primary-main) !important; /* Menggunakan primary-main */
        color: white !important;
        box-shadow: 0 2px 8px rgba(var(--primary-main-rgb), 0.2); /* Menggunakan primary-main-rgb */
        transform: translateY(-1px);
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
        color: var(--primary-main); /* Menggunakan primary-main */
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
        background-color: var(--primary-main) !important; /* Menggunakan primary-main */
        border-color: var(--primary-main) !important; /* Menggunakan primary-main */
        color: white !important;
        box-shadow: 0 4px 15px rgba(var(--primary-main-rgb), 0.2); /* Menggunakan primary-main-rgb */
    }

    .page-item .page-link:hover {
        background-color: var(--primary-light) !important; /* Menggunakan primary-light */
        border-color: var(--primary-light) !important; /* Menggunakan primary-light */
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
    }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Warga</h1>
    <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
    </a>
</div>

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive"> <table class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Status Perkawinan</th>
                                <th>Pekerjaan</th>
                                <th>Telepon</th>
                                <th>Status Warga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @if (count($residents) < 1)
                            <tbody>
                                <tr>
                                    <td colspan="12"> <p class="pt-3 text-center">Data tidak ada</p>
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                @foreach ($residents as $item)
                                   <tr>
                                        <td>{{ $loop->iteration + $residents->firstItem() - 1 }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jk }}</td>
                                        <td>{{ $item->tmpt_lahir }}, {{ \Carbon\Carbon::parse($item->tgl_lahir)->format('d F Y') }}</td> <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->status_kwn }}</td>
                                        <td>{{ $item->pekerjaan }}</td>
                                        <td>{{ $item->notelp }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <div class="d-flex align-items-center"> <a href="/resident/{{ $item->id }}" class="btn btn-sm btn-warning"> <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#konfirmasiDelete-{{ $item->id }}">
                                                    <i class="fas fa-eraser"></i>
                                                </button>
                                                @if (!is_null($item->user_id))
                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailAkun-{{ $item->id }}">
                                                    Lihat Akun
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                   </tr> 
                                   @include('pages.resident.konfirmasi-delete')
                                   @include('pages.resident.detail-akun')
                                @endforeach
                            </tbody>
                        @endif
                    </table> 
                </div> </div>
            @if($residents->lastPage() > 1)
            <div class="card-footer">
                {{ $residents->links('pagination::bootstrap-5')}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection