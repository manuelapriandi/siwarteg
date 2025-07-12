@extends('layouts.app')

@section('content')

<style>
    /* Variabel Warna Global (pastikan sama dengan layouts.app atau tempat lain yang terpusat) */
    :root {
        --primary-main: #4169E1; /* Royal Blue */
        --primary-light: #6A8BFF; /* Nuansa lebih terang dari Royal Blue */
        --primary-dark: #3150C7; /* Nuansa lebih gelap dari Royal Blue */
        --accent-color: #FFC107; /* Amber (Oranye aksen) */
        --accent-dark: #FFA000;

        --background-body: #efefefec; /* Latar belakang abu-abu muda */
        --card-bg: #FFFFFF; /* Latar belakang kartu putih */
        --text-dark: #212121; /* Teks gelap */
        --text-medium: #616161; /* Teks sedang */
        --text-light: #9E9E9E; /* Teks terang */
        --shadow-color-1: rgba(0, 0, 0, 0.08); /* Bayangan ringan */
        --shadow-color-2: rgba(0, 0, 0, 0.15); /* Bayangan sedang */
        --border-main: #DEDEDE; 

        /* Override Bootstrap colors for consistency */
        --bs-primary: var(--primary-main); /* Menggunakan variabel primary-main */
        --bs-info: #17a2b8; /* Tetap info default */
        --bs-warning: #ffc107; /* Tetap warning default (bisa disamakan dengan accent-color) */
        --bs-success: #28a745; /* Tetap success default */
        --bs-danger: #dc3545; /* Tetap danger default */

        /* RGB values for rgba() function */
        --primary-main-rgb: 65, 105, 225; /* RGB untuk #4169E1 */
        --accent-color-rgb: 255, 193, 7;
    }

    .dashboard-container {
        padding: 25px; /* Padding keseluruhan container lebih lega */
        background-color: var(--background-body); /* Latar belakang body dashboard */
        min-height: calc(100vh - 56px); /* Pastikan cukup tinggi */
    }

    /* Welcome Section */
    .welcome-section {
        margin-top: 20px;
        margin-bottom: 40px; /* Jarak bawah welcome section lebih jauh */
        padding: 30px; /* Padding lebih besar */
        background: linear-gradient(135deg, #e2ebf3 0%, var(--primary-light) 100%); /* Warna gradien mengikuti primary-light */
        border-radius: 15px; /* Lebih membulat */
        box-shadow: 0 5px 20px rgba(0,0,0,0.1); /* Bayangan lebih jelas */
        color: var(--text-dark); /* Warna teks umum */
    }

    .welcome-text {
        font-size: 1.2rem; /* Ukuran teks "Selamat datang," lebih besar */
        font-weight: 500; /* Tidak terlalu tebal */
        color: var(--text-medium); /* Warna teks lebih lembut */
        margin-bottom: 8px; /* Jarak bawah lebih jelas */
    }

    .username {
        font-size: 2.5rem; /* Ukuran nama user lebih besar dan menonjol */
        font-weight: 800; /* Sangat tebal */
        color: var(--text-dark); /* Warna teks gelap */
        margin-bottom: 10px; /* Jarak bawah lebih jelas */
    }

    .welcome-message {
        font-size: 1rem; /* Ukuran tanggal dan pesan */
        color: var(--text-medium); /* Warna teks lebih lembut */
        font-style: normal; /* Kembali ke normal, italic seringkali sulit dibaca */
    }

    /* Section Header */
    .section-header {
        margin: 40px 0 25px; /* Jarak atas dan bawah section header lebih besar */
        padding-bottom: 12px; /* Padding bawah lebih jelas */
        border-bottom: 2px solid var(--border-main); /* Border bawah lebih tebal */
    }

    .section-header h1 {
        color: var(--text-dark); /* Warna teks judul section */
        font-size: 1.8rem; /* Ukuran judul section lebih besar */
        font-weight: 700; /* Sangat tebal */
    }

    /* Status Cards */
    .card-row {
        margin-bottom: 30px; /* Jarak antara baris card */
    }

    .status-card {
        border-radius: 15px; /* Card lebih membulat */
        box-shadow: 0 8px 25px var(--shadow-color-1); /* Bayangan lebih menonjol */
        border: none; /* Hilangkan border default */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%; /* Pastikan semua card tingginya sama dalam satu baris */
    }

    .status-card:hover {
        transform: translateY(-8px); /* Efek lift yang lebih jelas */
        box-shadow: 0 15px 35px var(--shadow-color-2); /* Bayangan lebih kuat saat hover */
    }

    .status-card .card-body {
        padding: 2rem; /* Padding dalam card lebih lega */
    }

    .card-title {
        font-size: 1rem; /* Ukuran judul card lebih besar */
        font-weight: 600; /* Cukup tebal */
        color: var(--text-medium); /* Warna teks judul card */
        margin-bottom: 8px; /* Jarak bawah judul card */
        text-transform: uppercase; /* Judul card dalam huruf besar */
        letter-spacing: 0.5px;
    }

    .card-value {
        font-size: 2.5rem; /* Ukuran nilai angka lebih besar */
        font-weight: 900; /* Sangat sangat tebal */
        color: var(--text-dark); /* Warna teks gelap */
        line-height: 1.2;
    }

    .card-icon {
        font-size: 3.5rem; /* Ukuran ikon lebih besar */
        opacity: 0.15; /* Sedikit lebih jelas tapi tetap sebagai latar */
        margin-left: 20px; /* Jarak ikon dari teks */
        color: var(--primary-main); /* Warna ikon mengikuti primary-main */
    }
    
    /* Override Bootstrap border colors for status cards */
    .status-card.border-left-primary { border-left: 0.25rem solid var(--primary-main) !important; }
    .status-card.border-left-info { border-left: 0.25rem solid var(--bs-info) !important; }
    .status-card.border-left-warning { border-left: 0.25rem solid var(--bs-warning) !important; }
    .status-card.border-left-success { border-left: 0.25rem solid var(--bs-success) !important; }
    .status-card.border-left-danger { border-left: 0.25rem solid var(--bs-danger) !important; }


    .progress {
        height: 6px; /* Ketebalan progress bar */
        border-radius: 3px; /* Sudut lebih membulat */
        background-color: var(--border-main); /* Warna track progress bar */
        margin-top: 15px !important; /* Jarak atas progress bar */
    }
    .progress-bar {
        border-radius: 3px; /* Ikuti radius progress */
    }


    /* Recent Activity Section */
    .recent-activity-card {
        border-radius: 15px; /* Lebih membulat */
        border: none;
        box-shadow: 0 8px 25px var(--shadow-color-1);
    }

    .activity-list {
        padding: 10px; /* Padding keseluruhan daftar aktivitas */
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 15px 0; /* Padding vertikal item aktivitas lebih besar */
        border-bottom: 1px solid var(--border-main); /* Border lebih jelas */
        gap: 15px; /* Jarak antar ikon dan konten */
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 45px; /* Ukuran ikon aktivitas lebih besar */
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem; /* Ukuran ikon dalam lingkaran */
        flex-shrink: 0; /* Pastikan ikon tidak menyusut */
        box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Bayangan kecil pada ikon */
    }
    
    /* Warna latar belakang ikon aktivitas */
    .activity-icon.bg-info { background-color: var(--bs-info) !important; }
    .activity-icon.bg-primary { background-color: var(--primary-main) !important; } /* Mengikuti primary-main */
    .activity-icon.bg-secondary { background-color: var(--bs-secondary) !important; }


    .activity-content {
        flex-grow: 1;
    }

    .activity-text {
        font-size: 0.95rem; /* Ukuran teks aktivitas sedikit lebih besar */
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 4px; /* Jarak bawah teks aktivitas */
    }
    .activity-text b {
        font-weight: 700; /* Pastikan bagian bold sangat tebal */
    }

    .activity-time {
        font-size: 0.85rem; /* Ukuran waktu sedikit lebih besar */
        color: var(--text-medium);
    }

    .badge {
        font-size: 0.75rem; /* Ukuran badge status */
        padding: 0.4em 0.6em;
        border-radius: 5px;
        font-weight: 600;
    }

    .placeholder-section {
        padding: 30px; /* Padding lebih lega */
        background-color: var(--card-bg); /* Latar belakang putih */
        border-radius: 15px;
        text-align: center;
        color: var(--text-medium);
        box-shadow: 0 5px 20px var(--shadow-color-1);
        font-size: 1.1rem; /* Ukuran teks placeholder lebih besar */
    }

    /* Responsive adjustments */
    @media (max-width: 992px) { /* Untuk tablet dan mobile */
        .welcome-section {
            padding: 25px;
            margin-bottom: 30px;
        }
        .username {
            font-size: 2rem;
        }
        .section-header h1 {
            font-size: 1.6rem;
        }
        .status-card .card-body {
            padding: 1.5rem;
        }
        .card-value {
            font-size: 2rem;
        }
        .card-icon {
            font-size: 3rem;
            margin-left: 10px;
        }
        .activity-item {
            padding: 12px 0;
            gap: 10px;
        }
        .activity-icon {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }
        .activity-text {
            font-size: 0.9rem;
        }
        .activity-time {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 768px) { /* Khusus mobile */
        .dashboard-container {
            padding: 15px;
        }
        .welcome-section {
            padding: 20px;
            margin-bottom: 25px;
        }
        .username {
            font-size: 1.8rem;
        }
        .section-header {
            margin: 30px 0 20px;
        }
        .section-header h1 {
            font-size: 1.4rem;
        }
        .card-row {
            margin-bottom: 20px;
        }
        .col-xl-3.col-md-6.mb-4 {
            margin-bottom: 20px !important; /* Kurangi margin bawah antar kolom di mobile */
        }
        .status-card .card-body {
            padding: 1.2rem;
        }
        .card-title {
            font-size: 0.85rem;
        }
        .card-value {
            font-size: 1.7rem;
        }
        .card-icon {
            font-size: 2.5rem;
            margin-left: 8px;
        }
        .activity-list {
            padding: 0;
        }
        .activity-item {
            padding: 10px 0;
        }
        .activity-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
        .activity-text {
            font-size: 0.85rem;
        }
        .activity-time {
            font-size: 0.75rem;
        }
    }

</style>

<div class="dashboard-container">
    <div class="welcome-section">
        <h4 class="welcome-text">Selamat datang,</h4>
        <h2 class="username">{{ auth()->user()->name }}<span style="font-weight: 500;">...</span></h2>
        <p class="welcome-message">
            @php
                // Set locale to Indonesian
                setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'id');

                // Format date in Indonesian
                echo strftime('%A, %d %B %Y');
            @endphp
        </p>
    </div>

    <div class="section-header">
        <h1>{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Aduan Warga' : 'Status Aduan Anda' }}</h1>
    </div>

    <div class="row card-row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Total Aduan Warga' : 'Total Aduan Anda' }}
                            </div>
                            <div class="card-value">{{ $totalAduan }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">Aduan Baru</div>
                            <div class="card-value">{{ $aduanBaru }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" style="width: {{ $totalAduan ? ($aduanBaru/$totalAduan)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Sedang Diproses' : 'Diproses Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $aduanDiproses }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-spinner fa-pulse"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-warning" style="width: {{ $totalAduan ? ($aduanDiproses/$totalAduan)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Selesai' : 'Diselesaikan Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $aduanSelesai }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" style="width: {{ $totalAduan ? ($aduanSelesai/$totalAduan)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- --- START KTP Submission Status Cards --- --}}
    <div class="section-header">
        <h1>{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Pengajuan Berkas Warga' : 'Status Pengajuan Berkas Anda' }}</h1>
    </div>

    <div class="row card-row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Total Pengajuan Berkas' : 'Total Pengajuan Berkas' }}
                            </div>
                            <div class="card-value">{{ $totalKtpSubmissions }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">Pengajuan Berkas Baru</div>
                            <div class="card-value">{{ $ktpSubmissionsBaru }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-folder-plus"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsBaru/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Sedang Diproses' : 'Diproses Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $ktpSubmissionsDiproses }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-warning" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsDiproses/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Selesai' : 'Diselesaikan Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $ktpSubmissionsSelesai }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-check-double"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsSelesai/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card status-card border-left-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="card-title">
                                {{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Ditolak' : 'Ditolak Pak RT/RW' }}
                            </div>
                            <div class="card-value">{{ $ktpSubmissionsDitolak }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-danger" style="width: {{ $totalKtpSubmissions ? ($ktpSubmissionsDitolak/$totalKtpSubmissions)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- --- END KTP Submission Status Cards --- --}}


    <div class="section-header">
        <h1>Aktivitas Terkini</h1>
    </div>
    <div class="card recent-activity-card mb-4">
        <div class="card-body">
            <div class="activity-list">
                {{-- Recent Complaints --}}
                @forelse ($aduanTerbaru as $aduan)
                <div class="activity-item">
                    <div class="activity-icon bg-info">
                        <i class="fas fa-scroll"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Aduan baru: <b>{{ $aduan->title }}</b> oleh {{ $aduan->resident->nama ?? 'Warga Tidak Dikenal' }}</div>
                        <div class="activity-time">{{ $aduan->report_date_label }}</div>
                    </div>
                </div>
                @empty
                    <div class="activity-item">
                        <div class="activity-content">
                            <div class="activity-text">Tidak ada aduan terbaru.</div>
                        </div>
                    </div>
                @endforelse

                {{-- Recent KTP Submissions --}}
                @forelse ($ktpSubmissionsTerbaru as $submission)
                <div class="activity-item">
                    <div class="activity-icon bg-primary">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Pengajuan <b>{{ $submission->submission_type_label }}</b> oleh {{ $submission->resident->nama ?? 'Warga Tidak Dikenal' }} - Status: <span class="badge badge-{{ $submission->status_color }}">{{ $submission->status_label }}</span></div>
                        <div class="activity-time">{{ $submission->submission_date_label }}</div>
                    </div>
                </div>
                @empty
                    <div class="activity-item">
                        <div class="activity-content">
                            <div class="activity-text">Tidak ada pengajuan berkas terbaru.</div>
                        </div>
                    </div>
                @endforelse

                {{-- You can add other recent activities here --}}
                <div class="activity-item">
                    <div class="activity-icon bg-secondary">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Sistem telah diperbarui</div>
                        <div class="activity-time">Hari ini, {{ now()->format('H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-header">
        <h1>{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Iuran Bulanan Warga' : 'Status Iuran Bulanan Anda' }}</h1>
    </div>
    <div class="placeholder-section">
        <p>Informasi iuran akan ditampilkan di sini</p>
    </div>
</div>
@endsection