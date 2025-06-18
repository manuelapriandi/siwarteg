 @php
     $menus=[
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
        ],
        2 => [
            (object) [
                'title' => 'Dasbor',
                'path' => 'dasbor',
                'icon' => 'fas fa-fw fa-tachometer-alt',
            ],
        ],
];
 @endphp

 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dasbor">
                <div class="sidebar-brand-icon rotate-n-15">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                </div>
                <div class="sidebar-brand-text mx-3">SiWarTeg <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            {{-- <li class="nav-item {{ request()->is('dasbor') ? 'active' : '' }}">
                <a class="nav-link" href="/dasbor">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dasbor</span></a>
            </li> --}}

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
                Manajemen Data
            </div> --}}


            <!-- Nav Item - Tables -->
            @auth
                @foreach ($menus[auth()->user()->role_id] as $menu)
                <li class="nav-item {{ request()->is($menu->path . '*') ? 'active' : '' }}">
                    <a class="nav-link" href="/{{$menu->path}}">
                        <i class="{{$menu->icon}}"></i>
                        <span>{{$menu->title}}</span></a>
                </li>    
                @endforeach
            @endauth
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            {{-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> --}}

        </ul>
