@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('detailpengadaan') }}
    <div class="card">
        <div class="ms-4 mt-2">
            <a href="{{ url('ListPengadaan') }}" class="btn btn-primary mb-4">
                <span class='bx bx-arrow-back'></span> Kembali
            </a>
        </div>
        <div class="ms-4 mt-2">
            <h4 class="fw-bold mb-4">
                <span class="text-base fw-light">Detail Pengadaan Barang</span>
            </h4>
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
        <div class="mt-4">
            <a href="{{ url('PendaftaranPeserta/' . $pengadaan->id_infoTender) }}"
                class="btn btn-primary mb-lg-4 me-4 float-end"> Daftar Pengadaan
            </a>
        </div>
    </div>
@endsection
