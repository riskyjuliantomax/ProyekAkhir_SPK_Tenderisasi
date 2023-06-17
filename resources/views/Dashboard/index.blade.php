@extends('template.master')
@section('content')
    <div class="row">
        <div class="col-lg-6">{{ Breadcrumbs::render('dashboard') }}</div>
        @if (!Auth::check())
            <div class="col-lg-6 mb-2">
                <a href="{{ url('/login') }}" class="btn btn-primary float-end">Login</a>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        {{-- Card Welcome --}}
                        <div class="card-body">
                            <h3 class="card-title text-primary text-center mt-2">Selamat Datang Di Sistem Pendukung
                                Keputusan</h3>
                            <h5 class="mb-3 text-center">
                                Pemilihan Pemenangan Tender
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Order Statistics -->
        <div class="col-md-6 col-lg-8 col-xl-8 order-0 mb-4">
            {{-- Ranking --}}
            <div class="card">
                <div class="card">
                    <h5 class="card-header">{{ $title = isset($title) ? $title : '' }} </h5>
                    <div class="table-responsive   text-nowrap">
                        <table class="table table-bordered" style="overflow-x:scroll">
                            <form class="ms-4 mt-1">
                                <caption>
                                    @csrf
                                    <label class="ms-3">List Ranking </label>
                                    <div class="float-end me-3">
                                        {{-- {{ $perusahaan->onEachSide(3)->links() }} --}}
                                    </div>
                                </caption>
                                @if (count($penilaian) > 0)
                                    @include('Dashboard.ranking')
                                @else
                                    <label class="ms-3">Tidak Ada Pengumuman </label>
                                @endif
                            </form>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Ranking --}}
        </div>
        <!--/ Order Statistics -->

        @if (Auth::check())
            <!-- Log -->
            <div class="col-md-6 col-lg-4 order-2 mb-4 ">
                <div class="card h-75 overflow-hidden">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Riwayat Aktivitas</h5>
                    </div>
                    <div class="card-body" id="vertical-example">
                        <ul class="p-0 m-0 ">
                            @foreach ($riwayat_aktivitas as $riwayat)
                                <li class="d-flex mb-2 card p-3" style="border-left: 3px solid blue;">
                                    <div
                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2 mb-1 ">
                                        @if (Auth()->user()->role == 'pokja' || Auth()->user()->role == 'admin')
                                            <div class="row">
                                                <h6 class="mb-0">{{ $riwayat->User->nama }} Melakukan Aktivitas</h6>
                                            </div>
                                        @endif
                                        <div class="row mt-2">
                                            <br />
                                            <h6 class="mb-0 text-bold">{{ $riwayat->deskripsi }}</h6>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <span class="text-muted">{{ $riwayat->deskripsi2 }}</span>
                                            </div>
                                            <small
                                                class="mb-0 text-muted">{{ \Carbon\Carbon::parse($riwayat->waktu)->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <div class="ps__rail-y" style="top: 0px; height: 232px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 45px;"></div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <!--/ Transactions -->
    </div>
@endsection
