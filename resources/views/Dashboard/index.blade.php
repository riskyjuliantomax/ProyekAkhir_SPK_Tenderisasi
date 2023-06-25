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
                    <h5 class="card-header">Informasi Pengadaan </h5>
                    <div class="table-responsive text-wrap">
                        <table class="table table-bordered ">
                            <form class="ms-4 mt-1">
                                <caption>
                                    @csrf
                                    <div class="float-end me-3">
                                        {{ $infoTender->onEachSide(3)->links() }}
                                    </div>
                                </caption>
                                <thead>
                                    <tr>
                                        <th style="width:5%">No</th>
                                        <th style="width:75%">Nama Pengadaan</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Tanggal Buat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infoTender as $index => $data)
                                        <tr>
                                            <input type="hidden" class="id_infoTender"
                                                value="{{ $data->id_infoTender }}" />
                                            <td> {{ $infoTender->firstItem() + $index }} </td>
                                            <td>
                                                {{ ucFirst($data->nama_infoTender) }}</td>
                                            <td>{{ number_format($data->harga_infoTender) }}</td>
                                            <td>
                                                @if ($data->approve == 0)
                                                    <small><span class="ms-2 badge bg-info">Lagi Proses</span></small>
                                                @endif
                                                @if ($data->approve == 1)
                                                    <small><span class="ms-2 badge bg-danger">Gagal</span></small>
                                                @endif
                                                @if ($data->approve == 2)
                                                    <small><span class="ms-2 badge bg-success">Selesai</span></small>
                                                @endif
                                            </td>
                                            <td>{{ $data->created_at->format('d/m/Y') }}
                                                <br />
                                            </td>
                                            <td style="width:13%">
                                                {{-- <a href="{{ url('InfoTender/show/' . $data->id_infoTender) }}"
                                                        class="btn btn-icon btn-primary btn-update">
                                                        <span class="tf-icons bx bx-edit-alt"></span>
                                                    </a> --}}
                                                <a href="{{ url('DetailPengadaan/' . $data->id_infoTender) }}"
                                                    class="btn btn-info text-white">
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
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
                <div class="card h-100 overflow-hidden" style="max-height: 600px">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Riwayat Aktivitas</h5>
                    </div>
                    <div class="card-body" id="vertical-example">
                        <ul class="p-0 m-0 ">
                            @foreach ($riwayat_aktivitas as $riwayat)
                                <li class="d-flex mb-2 card p-3 mt-2"
                                    @if (auth()->user()->id_users == $riwayat->id_users) style="border-left: 3px solid blue; background-color: #f5f6ff;"
                                @else
                                style="border-left: 2px solid black;" @endif>
                                    <div
                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2 mb-1 ">

                                        <div class="row">
                                            @if (auth()->user()->id_users == $riwayat->id_users)
                                                <h6 class="mb-0">Anda Melakukan Aktivitas</h6>
                                            @else
                                                <h6 class="mb-0">{{ $riwayat->User->nama }} Melakukan Aktivitas</h6>
                                            @endif
                                        </div>

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
@section('script')
@endsection
