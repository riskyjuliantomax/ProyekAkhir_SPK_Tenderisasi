@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('pendaftaran') }}
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
        <a href="{{ url('RiwayatPendaftaran') }}" class="btn btn-primary mb-3">
            <span class='bx bx-arrow-back'></span> Kembali
        </a>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-detailPengajuan" aria-controls="navs-top-detailPengajuan"
                        aria-selected="true">Edit Pengajuan</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-pengadaan" aria-controls="navs-top-pengadaan" aria-selected="false">Detail
                        Pengadaan</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-detailPengajuan" role="tabpanel">
                    <div class="flex-grow-1 ">
                        <h4 class="fw-bold mb-4">
                            <span class="text-base fw-light">{{ $title }}
                                {{ $pendaftaran->infoTender->nama_infoTender }}</span>
                        </h4>
                        <div class="row" id="DaftarPeserta">

                            <hr class="my-0">
                            <form action="{{ url('RiwayatPendaftaran/Update/' . $pendaftaran->id_pendaftaran_users) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">

                                    <input type="hidden" name="id_users" id="id_users"
                                        value="{{ auth()->user()->id_users }}" />
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                            <input type="text" class="form-control " id="nama_perusahaan"
                                                name="nama_perusahaan" placeholder="PT.XXX XXXXX"
                                                value="{{ $pendaftaran->nama_perusahaan }}" required />
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="nama_perusahaan" class="form-label">Harga Penawaran <small
                                                    class="text-muted">tanpa
                                                    berkoma</small></label></label>
                                            <input type="number" class="form-control " id="harga_penawaran"
                                                name="harga_penawaran" placeholder="XXXXXXXX"
                                                value="{{ $pendaftaran->harga_penawaran }}" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                                            <input type="number" class="form-control " id="tahun_berdiri"
                                                name="tahun_berdiri" placeholder="1990"
                                                value="{{ $pendaftaran->tahun_berdiri }}" required />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="telp_perusahaan" class="form-label">Telp Perusahaan</label>
                                            <input type="text" class="form-control " id="telp_perusahaan"
                                                name="telp_perusahaan" placeholder="xxxxxxxxx"
                                                value="{{ $pendaftaran->telp_perusahaan }}" />

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="nama_kontak" class="form-label">Nama Bisa Di Kontak</label>
                                            <input type="text" class="form-control " id="nama_kontak" name="nama_kontak"
                                                placeholder="xxxxx"value="{{ $pendaftaran->nama_kontak }}" required />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email_perusahaan" class="form-label">Email
                                                Perusahaan</label>
                                            <input type="text" class="form-control " id="email_perusahaan"
                                                name="email_perusahaan" placeholder="xxxxx@xxxx.com"
                                                value="{{ $pendaftaran->email_perusahaan }}" required />

                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="nama" class="form-label">Alamat Perusahaan</label>
                                        <textarea class="form-control" rows="5" style="resize: none" name="alamat_perusahaan" id="alamat_perusahaan"
                                            required>{{ $pendaftaran->alamat_perusahaan }}</textarea>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="dokumen_perusahaan" class="form-label">Lampiran <small
                                                class="text-muted">
                                                Hanya PDF</small></label>
                                        <input type="file" class="form-control" name="dokumen_perusahaan"
                                            id="dokumen_perusahaan" accept="application/pdf" />
                                        @if (!$pendaftaran->dokumen_perusahaan)
                                            Tidak Dilampirkan
                                        @else
                                            <a class="overflow-hidden"
                                                href="{{ url('ViewPDF/' . $pendaftaran->id_pendaftaran_users) }}"target="_blank">
                                                File Lampiran, Klik Untuk Lihat
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary float-end mb-4">Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-pengadaan" role="tabpanel">
                    <div class="ms-4 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="fw-bold my-2">
                                    <span class="text-base fw-light">Detail Pengadaan Barang</span>
                                </h4>
                                Status :
                                @if ($pendaftaran->infoTender->status == 0)
                                    <span class=" badge bg-info">Lagi Proses</span>
                                @endif
                                @if ($pendaftaran->infoTender->status == 1)
                                    <span class=" badge bg-danger">Gagal</span>
                                @endif
                                @if ($pendaftaran->infoTender->status == 2)
                                    <span class=" badge bg-success">Selesai</span>
                                @endif
                            </div>
                            <div class="col-6">
                                @if ($pendaftaran->status == 2)
                                    <div class="float-end me-3">
                                        <a href="{{ url('DetailPengadaan/LihatHasil/' . $pendaftaran->id_infoTender) }}"
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
                                        <td class="col-md-10">{{ $pendaftaran->infoTender->nama_infoTender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2">Harga</td>
                                        <td class="col-md-10">{{ $pendaftaran->infoTender->harga_infoTender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2" style="vertical-align: top">Syarat</td>
                                        <td class="col-md-10">
                                            {!! $pendaftaran->infoTender->syarat_infoTender !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
