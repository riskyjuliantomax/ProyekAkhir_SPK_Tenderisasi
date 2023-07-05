@extends('template.master')
@section('content')
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
    <div class="mt-2">
        <a href="{{ url('RiwayatPendaftaran') }}" class="btn btn-primary mb-4">
            <span class='bx bx-arrow-back'></span> Kembali
        </a>
    </div>

    {{-- End --}}
    <div class="col-xl-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-detailPengajuan" aria-controls="navs-top-detailPengajuan"
                        aria-selected="true">Detail Pengajuan</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-pengadaan" aria-controls="navs-top-pengadaan" aria-selected="false">Detail
                        Pengadaan</button>
                </li>
                @if ($pengadaan->infoTender->status == '2')
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-pengumuman" aria-controls="navs-top-pengumuman"
                            aria-selected="false">Pengumuman</button>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-detailPengajuan" role="tabpanel">
                    <div class=" mt-2">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="fw-bold my-2">
                                    <span class="text-base fw-light">Detail Pengadaan Barang</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <table class="table table-responsive table-bordered ">
                        <tbody>
                            <tr>
                                <td class="col-md-6 fw-bold bg-lighter" colspan="2">Nama Perusahaan </td>
                                <td class="col-md-6 fw-bold bg-lighter" colspan="2">Harga Penawaran </td>
                            </tr>
                            <tr>
                                <td colspan="2">{{ $pengadaan->nama_perusahaan }}</td>
                                <td colspan="2">{{ $pengadaan->harga_penawaran }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold bg-lighter">NPWP Perusahaan</td>
                                <td class="fw-bold bg-lighter">Nomor Telepon</td>
                                <td class="fw-bold bg-lighter">Email</td>
                                <td class="fw-bold bg-lighter">Tanggal Pengajuan</td>
                            </tr>
                            <tr>
                                <td>{{ $pengadaan->npwp_perusahaan }}</td>
                                <td>{{ $pengadaan->telp_perusahaan }}</td>
                                <td>{{ $pengadaan->email_perusahaan }}</td>
                                <td>{{ $pengadaan->created_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold bg-lighter">Lampiran Dokumen Legalitas</td>
                                <td>
                                    @if (!$pengadaan->dokumen_legalitas)
                                        Tidak Dilampirkan
                                    @else
                                        <a class="overflow-hidden"
                                            href="{{ url('ViewPDF/' . $pengadaan->dokumen_legalitas) }}"target="_blank">
                                            Lihat Dokumen Legalitas
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold bg-lighter">Lampiran Dokumen Penawaran</td>
                                <td>
                                    @if (!$pengadaan->dokumen_penawaran)
                                        Tidak Dilampirkan
                                    @else
                                        <a class="overflow-hidden"
                                            href="{{ url('ViewPDF/' . $pengadaan->dokumen_penawaran) }}"target="_blank">
                                            Lihat Dokumen Penawaran
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold bg-lighter">Lampiran Dokume Akta Perusahaan</td>
                                <td>
                                    @if (!$pengadaan->dokumen_akta)
                                        Tidak Dilampirkan
                                    @else
                                        <a class="overflow-hidden"
                                            href="{{ url('ViewPDF/' . $pengadaan->dokumen_akta) }}"target="_blank">
                                            Lihat Dokumen Akta Perusahaan
                                        </a>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="navs-top-pengadaan" role="tabpanel">
                    <div class="ms-4 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="fw-bold my-2">
                                    <span class="text-base fw-light">Detail Pengadaan Barang</span>
                                </h4>
                                Status :
                                @if ($pengadaan->infoTender->status == 0)
                                    <span class=" badge bg-info">Lagi Proses</span>
                                @endif
                                @if ($pengadaan->infoTender->status == 1)
                                    <span class=" badge bg-danger">Gagal</span>
                                @endif
                                @if ($pengadaan->infoTender->status == 2)
                                    <span class=" badge bg-success">Selesai</span>
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
                                        <td class="col-md-10">{{ $pengadaan->infoTender->nama_infoTender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2">Harga</td>
                                        <td class="col-md-10">{{ $pengadaan->infoTender->harga_infoTender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2" style="vertical-align:  top">Syarat</td>
                                        <td class="col-md-10">
                                            {!! $pengadaan->infoTender->syarat_infoTender !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="navs-top-pengumuman" role="tabpanel">
                    @include('RiwayatPendaftaran.lihatHasil')
                </div>
            </div>
        </div>
    </div>
@endsection
