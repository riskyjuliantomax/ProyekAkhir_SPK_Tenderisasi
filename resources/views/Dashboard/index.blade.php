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
                    <h5 class="card-header">Tahap Ranking </h5>
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
                                    <thead>
                                        <tr>
                                            <th style="width: 30%"></th>
                                            @foreach ($kriteria as $dataKriteria)
                                                <th>
                                                    {{ $dataKriteria->nama_kriteria }}
                                                </th>
                                            @endforeach
                                            <th rowspan="2"
                                                style="text-align: center; padding-bottom: 30px; width:100px">
                                                Total
                                            </th>
                                            <th rowspan="2" style="text-align: center; padding-bottom: 30px; width:50px">
                                                Rank
                                            </th>
                                        </tr>
                                        <th>Bobot</th>
                                        @foreach ($kriteria as $dataKriteria)
                                            <th>
                                                {{ $dataKriteria->bobot * 100 }}%
                                            </th>
                                        @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($ranking as $key => $value)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                @foreach ($value as $key_1 => $value_1)
                                                    <td>
                                                        {{ number_format($value_1, 2) }}
                                                    </td>
                                                @endforeach
                                                <td>{{ $no++ }}</td>
                                            </tr>
                                        @endforeach
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


        <!-- Log -->
        <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Transactions</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Paypal</small>
                                    <h6 class="mb-0">Send money</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">+82.6</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Wallet</small>
                                    <h6 class="mb-0">Mac'D</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">+270.69</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/chart.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Transfer</small>
                                    <h6 class="mb-0">Refund</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">+637.91</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/cc-success.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Credit Card</small>
                                    <h6 class="mb-0">Ordered Food</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">-838.71</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Wallet</small>
                                    <h6 class="mb-0">Starbucks</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">+203.33</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Mastercard</small>
                                    <h6 class="mb-0">Ordered Food</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">-92.45</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Transactions -->
    </div>
@endsection
