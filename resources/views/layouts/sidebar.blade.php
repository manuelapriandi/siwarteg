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
    (object) [ // <<< NEW MENU FOR KTP SUBMISSION (ADMIN)
        'title' => 'Pengajuan Berkas',
        'path' => 'ktp-submission',
        'icon' => 'fas fa-fw fa-id-card', // Using an ID card icon
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
    (object) [ // <<< NEW MENU FOR KTP SUBMISSION (USER)
        'title' => 'Pengajuan Berkas',
        'path' => 'ktp-submission',
        'icon' => 'fas fa-fw fa-id-card',
    ],
],
];
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2" href="/dasbor" style="scale: 125%">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-shield"></i>
        </div>
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dasbor" style="scale: 150%">
        <div class="sidebar-brand-text">SiWarTeg</div>
    </a>
    <hr class="sidebar-divider my-0">
    @auth
    @foreach ($menus[auth()->user()->role_id] as $menu)
    <li class="nav-item {{ request()->is($menu->path . '*') ? 'active' : '' }}">
        <a class="nav-link" href="/{{$menu->path}}">
            <i class="{{$menu->icon}}"></i>
            <span>{{$menu->title}}</span></a>
    </li>
    @endforeach
    @endauth
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>