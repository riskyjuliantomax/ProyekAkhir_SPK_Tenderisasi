{{-- Role Pokja --}}
@if (Auth()->user()->role == 'pokja')
    <li
        class="menu-item {{ request()->Is('InfoTender') ? 'active' : '' }}
        {{ request()->Is('InfoTender/*') ? 'active' : '' }}
        ">
        <a href="{{ url('InfoTender') }}" class="menu-link">
            <i class='menu-icon bx bx-info-circle'></i>
            <div data-i18n="Analytics">Pengadaan Barang</div>
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
    <li
        class="menu-item {{ request()->Is('PengadaanBerjalan') ? 'active' : '' }}
    {{ request()->Is('PengadaanBerjalan/*') ? 'active' : '' }}
    ">
        <a href="{{ route('permintaanPeserta.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-briefcase"></i>
            <div data-i18n="Analytics">Peserta Pengadaan </div>
        </a>
        </>
    <li
        class="menu-item
    {{ request()->Is('Penilaian') ? 'active' : '' }}
    {{ request()->Is('Penilaian/*') ? 'active' : '' }}
        ">
        <a href="{{ url('Penilaian') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file-blank"></i>
            <div data-i18n="Analytics">Penilaian</div>
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
        class="menu-item
    {{ request()->is('RiwayatPendaftaran') ? 'active' : '' }}
    {{ request()->is('RiwayatPendaftaran/*') ? 'active' : '' }}
    ">
        <a href="{{ url('RiwayatPendaftaran') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-paperclip"></i>
            <div>Riwayat Pendaftaran</div>
        </a>
    </li>
@endif
