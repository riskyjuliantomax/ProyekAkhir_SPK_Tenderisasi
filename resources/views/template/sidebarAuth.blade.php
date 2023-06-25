{{-- Role Pokja --}}
@if (Auth()->user()->role == 'pokja')
    <li
        class="menu-item {{ request()->Is('InfoTender') ? 'active' : '' }}
        {{ request()->Is('InfoTender/*') ? 'active' : '' }}
        ">
        <a href="{{ url('InfoTender') }}" class="menu-link">
            <i class='menu-icon bx bx-info-circle'></i>
            <div data-i18n="Analytics">Info Tender</div>
        </a>
    </li>
    <li
        class="menu-item
            {{ request()->Is('Kriteria') ? 'active' : '' }}
            {{ request()->Is('Kriteria/Crips/*') ? 'active' : '' }}
        ">
        <a href="{{ url('Kriteria') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-list-check"></i>
            <div data-i18n="Analytics">Kriteria</div>
        </a>
    </li>
    <li class="menu-item {{ request()->Is('PermintaanPeserta') ? 'active' : '' }}">
        <a href="{{ url('PermintaanPeserta') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Analytics">Permintaaan Peserta </div>
        </a>
    </li>
    <li class="menu-item {{ request()->Is('Perusahaan') ? 'active' : '' }}">
        <a href="{{ url('Perusahaan') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-building"></i>
            <div data-i18n="Analytics">Peserta Tender</div>
        </a>
    </li>
    <li class="menu-item {{ request()->Is('Penilaian') ? 'active' : '' }}">
        <a href="{{ url('Penilaian') }}" class="menu-link">
            <i class='menu-icon bx bx-file-blank'></i>
            <div data-i18n="Analytics">Penilaian</div>
        </a>
    </li>
    <li class="menu-item {{ request()->Is('Perhitungan') ? 'active' : '' }}">
        <a href="{{ url('Perhitungan') }}" class="menu-link">
            <i class="menu-icon bx bx-calculator"></i>
            <div data-i18n="Analytics">Perhitungan</div>
        </a>
    </li>
@endif
{{-- Role Admin --}}
@if (Auth()->user()->role == 'admin')
    <li class="menu-item {{ request()->Is('User') ? 'active' : '' }}">
        <a href="{{ url('User') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Analytics">User</div>
        </a>
    </li>
@endif
{{-- Role User --}}
@if (Auth()->user()->role == 'user')
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
    <li class="menu-item
    {{ request()->is('RiwayatPendaftaran') ? 'active' : '' }}
    ">
        <a href="{{ url('RiwayatPendaftaran') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-paperclip"></i>
            <div>Riwayat Pendaftaran</div>
        </a>
    </li>
@endif
