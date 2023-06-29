<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme ">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/lambang_riau.png') }}" width="35px" />
            </span>
            <span class="demo menu-text fw-bolder ms-2">LPSE Provinsi Riau</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->Is('Dashboard') ? 'active' : '' }}">
            <a href="{{ url('Dashboard') }}" class="menu-link">
                <i class='menu-icon bx bx-doughnut-chart'></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @if (Auth()->user() == null || Auth()->user()->role == 'user')
            <li
                class="menu-item {{ request()->Is('ListPengadaan') ? 'active' : '' }}
            {{ request()->Is('DetailPengadaan/*') ? 'active' : '' }}
            {{ request()->Is('PendaftaranPeserta/*') ? 'active' : '' }}
            ">
                <a href="{{ url('ListPengadaan') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Analytics">List Pengadaan</div>
                </a>
            </li>
        @endif
        @if (Auth::check())
            @include('template.sidebarAuth')
        @endif
        <!-- Layouts -->
        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Layouts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                        <div data-i18n="Without menu">Without menu</div>
                    </a>
                </li>
            </ul>
        </li> --}}


    </ul>
</aside>
<!-- / Menu -->
