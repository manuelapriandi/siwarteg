@php
$menus=[
//Angka 1 untuk Admin (Pak RT/RW)
1 => [
    (object) [
        'title' => 'Dasbor',
        'path' => 'dasbor',
        'icon' => 'fas fa-fw fa-tachometer-alt',
    ],
    (object) [
        'title' => 'Penduduk',
        'path' => 'resident',
        'icon' => 'fas fa-fw fa-table',
    ],
    (object) [
        'title' => 'Daftar Akun',
        'path' => 'daftar-akun',
        'icon' => 'fas fa-fw fa-user',
    ],
    (object) [
        'title' => 'Permintaan Akun',
        'path' => 'account-request',
        'icon' => 'fas fa-fw fa-question',
    ],
    (object) [
        'title' => 'Aduan Warga',
        'path' => 'complaint',
        'icon' => 'fas fa-fw fa-scroll',
    ],
    (object) [
        'title' => 'Pengajuan Berkas',
        'path' => 'ktp-submission',
        'icon' => 'fas fa-fw fa-id-card',
    ],
],
//Angka 2 untuk User(Warga)
2 => [
    (object) [
        'title' => 'Dasbor',
        'path' => 'dasbor',
        'icon' => 'fas fa-fw fa-tachometer-alt',
    ],
    (object) [
        'title' => 'Pengaduan',
        'path' => 'complaint',
        'icon' => 'fas fa-fw fa-scroll',
    ],
    (object) [ 
        'title' => 'Pengajuan Berkas',
        'path' => 'ktp-submission',
        'icon' => 'fas fa-fw fa-id-card',
    ],
],
];
@endphp

<style>
    /* Menggunakan variabel warna yang sudah Anda definisikan di :root (misalnya dari layouts.app) */
    /* Pastikan variabel ini terdefinisi di tempat global agar CSS ini bisa menggunakannya */
    :root {
        --primary-main: #4169E1; /* Royal Blue */
        --primary-light: #6A8BFF; /* Nuansa lebih terang dari Royal Blue */
        --primary-dark: #3150C7; /* Nuansa lebih gelap dari Royal Blue */
        --accent-color: #FFC107; /* Amber (Oranye aksen) */
        --text-dark: #212121; /* Teks gelap */
    }

    /* ==== Sidebar Styling ==== */
    #accordionSidebar {
        background: linear-gradient(180deg, var(--primary-main) 0%, var(--primary-dark) 100%); /* Gradasi Biru yang Lebih Halus */
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); /* Bayangan untuk kedalaman */
        border-right: none; /* Hapus border default */
        transition: all 0.3s ease; /* Transisi untuk sidebar toggle */
    }

    /* ==== Sidebar Brand (Logo dan Nama) ==== */
    #accordionSidebar .sidebar-brand { /* Tambahkan #accordionSidebar */
        height: auto !important; /* Izinkan tinggi menyesuaikan konten */
        padding: 1.5rem 0; /* Padding vertikal lebih banyak */
        font-size: 1.5rem; /* Ukuran teks nama aplikasi */
        font-weight: 700;
        color: white;
        letter-spacing: 1px;
        text-decoration: none;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
        flex-direction: column; /* Icon di atas teks */
    }
    #accordionSidebar .sidebar-brand:hover { /* Tambahkan #accordionSidebar */
        color: rgba(255, 255, 255, 0.9); /* Sedikit lebih terang saat hover */
    }

    #accordionSidebar .sidebar-brand-icon { /* Tambahkan #accordionSidebar */
        font-size: 2.5rem; /* Ukuran ikon lebih besar */
        margin-bottom: 0.5rem; /* Jarak antara ikon dan teks */
        color: white;
    }

    #accordionSidebar .sidebar-brand-text { /* Tambahkan #accordionSidebar */
        font-size: 1.5rem; /* Mengatur ulang ukuran teks brand */
    }
    /* Ketika sidebar diminimalisir */
    .sidebar.toggled #accordionSidebar .sidebar-brand .sidebar-brand-text { /* Tambahkan #accordionSidebar */
        display: none; /* Sembunyikan teks saat ditoggle */
    }
    .sidebar.toggled #accordionSidebar .sidebar-brand .sidebar-brand-icon { /* Tambahkan #accordionSidebar */
        margin-bottom: 0; /* Hapus margin bawah ikon saat ditoggle */
    }
    .sidebar.toggled #accordionSidebar .sidebar-brand { /* Tambahkan #accordionSidebar */
        padding: 1.5rem 0; /* Sesuaikan padding saat ditoggle */
    }

    /* ==== Divider ==== */
    #accordionSidebar .sidebar-divider { /* Tambahkan #accordionSidebar */
        border-top: 1px solid rgba(255, 255, 255, 0.2); /* Divider yang lebih tipis dan transparan */
        margin: 1.5rem 0 !important; /* Jarak yang konsisten */
    }
    #accordionSidebar .sidebar-divider.my-0 { /* Tambahkan #accordionSidebar */
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    /* ==== Navigation Items (Menu Links) ==== */
    #accordionSidebar .nav-item { /* Tambahkan #accordionSidebar */
        margin-bottom: 0.25rem; /* Sedikit jarak antar item menu */
    }

    #accordionSidebar .nav-link { /* Tambahkan #accordionSidebar */
        display: flex;
        align-items: center;
        padding: 0.75rem 1.5rem !important; /* Padding yang lebih luas */
        color: rgba(255, 255, 255, 0.8); /* Warna teks default sedikit transparan */
        transition: all 0.3s ease;
        font-size: 0.95rem; /* Ukuran font sedikit lebih besar */
        border-radius: 0 25px 25px 0; /* Sudut membulat hanya di sisi kanan */
    }
    #accordionSidebar .nav-link:hover { /* Tambahkan #accordionSidebar */
        color: white; /* Teks putih penuh saat hover */
        background-color: rgba(0, 0, 0, 0.1); /* Latar belakang transparan gelap saat hover */
        text-decoration: none;
    }

    #accordionSidebar .nav-link i { /* Tambahkan #accordionSidebar */
        font-size: 1.1rem; /* Ukuran ikon */
        margin-right: 0.75rem; /* Jarak antara ikon dan teks */
        color: rgba(255, 255, 255, 0.6); /* Warna ikon default sedikit transparan */
        transition: color 0.3s ease;
    }
    #accordionSidebar .nav-link:hover i { /* Tambahkan #accordionSidebar */
        color: white; /* Warna ikon putih penuh saat hover */
    }

    /* ==== Active Navigation Item ==== */
    #accordionSidebar .nav-item.active { /* Tambahkan #accordionSidebar */
        position: relative; /* Untuk pseudo-element border kiri */
        background-color: rgba(0, 0, 0, 0.2); /* Latar belakang gelap untuk item aktif */
        border-radius: 0 25px 25px 0; /* Sudut membulat kanan */
    }
    #accordionSidebar .nav-item.active .nav-link { /* Tambahkan #accordionSidebar */
        color: white; /* Pastikan teks putih untuk item aktif */
        font-weight: 600; /* Teks lebih tebal */
    }
    #accordionSidebar .nav-item.active .nav-link i { /* Tambahkan #accordionSidebar */
        color: white; /* Pastikan ikon putih untuk item aktif */
    }
    /* Garis highlight di sisi kiri untuk item aktif */
    #accordionSidebar .nav-item.active::before { /* Tambahkan #accordionSidebar */
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 80%; /* Tinggi garis highlight */
        width: 5px; /* Ketebalan garis highlight */
        background-color: var(--accent-color); /* Warna aksen untuk highlight */
        border-radius: 0 5px 5px 0;
    }

    /* ==== Sidebar Toggle Button ==== */
    #accordionSidebar #sidebarToggle { /* Tambahkan #accordionSidebar */
        background-color: rgba(255, 255, 255, 0.2); /* Tombol toggle yang lebih ringan */
        transition: background-color 0.3s ease;
        color: white; /* Warna ikon toggle */
    }
    #accordionSidebar #sidebarToggle:hover { /* Tambahkan #accordionSidebar */
        background-color: rgba(255, 255, 255, 0.3);
    }

    /* ==== Adjustments for Toggled Sidebar ==== */
    /* Ini adalah gaya bawaan dari SB Admin 2 yang penting untuk fungsionalitas toggle */
    /* Kita hanya memastikan gaya custom kita bekerja dengan baik bersamanya */
    .sidebar.toggled {
        width: 6.5rem !important; /* Lebar saat ditoggle */
    }
    .sidebar.toggled #accordionSidebar .nav-item .nav-link { /* Tambahkan #accordionSidebar */
        text-align: center; /* Teks rata tengah saat ditoggle */
        padding: 0.75rem 0.5rem !important; /* Padding disesuaikan */
        flex-direction: column; /* Ikon di atas teks saat ditoggle */
    }
    .sidebar.toggled #accordionSidebar .nav-item .nav-link i { /* Tambahkan #accordionSidebar */
        margin-right: 0; /* Hapus margin kanan ikon */
        margin-bottom: 0.3rem; /* Sedikit jarak bawah untuk ikon */
    }
    .sidebar.toggled #accordionSidebar .nav-item .nav-link span { /* Tambahkan #accordionSidebar */
        font-size: 0.65rem; /* Ukuran teks lebih kecil saat ditoggle */
        display: block; /* Pastikan span tampil sebagai blok */
    }
    .sidebar.toggled #accordionSidebar .nav-item.active::before { /* Tambahkan #accordionSidebar */
        height: 100%; /* Sesuaikan tinggi highlight saat ditoggle */
    }
</style>

<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    {{-- Sidebar - Brand --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dasbor">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text">SiWarTeg</div>
    </a>

    {{-- Divider --}}
    <hr class="sidebar-divider my-0">

    {{-- Nav Item - Loop Menu --}}
    @auth
    @foreach ($menus[auth()->user()->role_id] as $menu)
    <li class="nav-item {{ request()->is($menu->path . '*') ? 'active' : '' }}">
        <a class="nav-link" href="/{{$menu->path}}">
            <i class="{{$menu->icon}}"></i>
            <span>{{$menu->title}}</span>
        </a>
    </li>
    @endforeach
    @endauth

    {{-- Divider --}}
    <hr class="sidebar-divider d-none d-md-block">

    {{-- Sidebar Toggler (Sidebar) --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>