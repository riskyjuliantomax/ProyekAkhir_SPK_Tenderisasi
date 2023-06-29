@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('detailpengadaan') }}
    @if (Auth::check())
        @include('DetailPengadaan.DoubleInsert')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="ms-4 mt-2">
            <a href="{{ url('ListPengadaan') }}" class="btn btn-primary mb-4">
                <span class='bx bx-arrow-back'></span> Kembali
            </a>
        </div>
        <div class="ms-4 mt-2">
            <div class="row">
                <div class="col-6">
                    <h4 class="fw-bold mb-2">
                        <span class="text-base fw-light">Detail Pengadaan Barang</span>
                    </h4>
                    Status :
                    @if ($pengadaan->status == 0)
                        <span class=" badge bg-info">Lagi Proses</span>
                    @endif
                    @if ($pengadaan->status == 1)
                        <span class=" badge bg-danger">Gagal</span>
                    @endif
                    @if ($pengadaan->status == 2)
                        <span class=" badge bg-success">Selesai</span>
                    @endif
                </div>
                <div class="col-6">
                    @if ($pengadaan->status == 2)
                        <div class="float-end me-3">
                            <a href="{{ url('DetailPengadaan/LihatHasil/' . $pengadaan->id_infoTender) }}"
                                class="btn btn-success">Lihat Hasil</a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body overflow-auto">
                <table class="table table-bordered ">
                    <tbody>
                        <tr>
                            <td class="col-md-2">Nama Pengadaan </td>
                            <td class="col-md-10">{{ $pengadaan->nama_infoTender }}</td>
                        </tr>
                        <tr>
                            <td class="col-md-2">Harga</td>
                            <td class="col-md-10">{{ $pengadaan->harga_infoTender }}</td>
                        </tr>
                        <tr>
                            <td class="col-md-2" style="vertical-align: top">Syarat</td>
                            <td class="col-md-10">
                                {!! $pengadaan->syarat_infoTender !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @if ($pengadaan->status == 0 && Auth::check() != null)
            @if (!$checkDaftarDoubleInsert)
                <div class="mt-4">
                    <a href="{{ url('PendaftaranPeserta/' . $pengadaan->id_infoTender) }}"
                        class="btn btn-primary mb-lg-4 me-4 float-end"> Daftar Pengadaan
                    </a>
                </div>
            @endif
        @elseif($pengadaan->status == 0 && !Auth::check())
            <div class="mt-4">
                <a href="{{ url('login') }}" class="btn btn-warning mb-lg-4 me-4 float-end"> Harus Login Terlebih Dahulu
                </a>
            </div>
        @endif

    </div>
@endsection
