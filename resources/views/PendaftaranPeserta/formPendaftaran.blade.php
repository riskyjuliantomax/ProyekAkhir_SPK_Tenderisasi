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

    <div class="flex-grow-1 ">
        <h4 class="fw-bold mb-4">
            <span class="text-base fw-light">{{ $title }} {{ $infoTender->nama_infoTender }}</span>
        </h4>
        <div class="row" id="DaftarPeserta">
            <div class="col-md-12">
                <div class="card mb-4">
                    <hr class="my-0">
                    <form action="{{ url('PendaftaranPeserta/' . $infoTender->id_infoTender) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="id_users" id="id_users" value="{{ auth()->user()->id_users }}" />
                            <div class="row">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="nama_perusahaan" class="form-label">Harga Penawaran <small
                                                class="text-muted">tanpa
                                                berkoma</small></label></label>
                                        <input type="number" class="form-control " id="harga_penawaran"
                                            name="harga_penawaran" placeholder="XXXXXXXX"
                                            value="{{ old('harga_penawaran') }}" required />
                                    </div>
                                </div>
                            </div>
                            <h5 class="fw-bold">Lampiran</h5>
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="dokumen_legalitas" class="form-label">Dokumen Administrasi <small
                                            class="text-muted">
                                            .PDF</small></label>
                                    <input type="file" class="form-control" name="dokumen_legalitas"
                                        id="dokumen_legalitas" accept="application/pdf" />
                                    <label for="dokumen_legalitas" class="form-label">
                                        Lampiran Terdiri Dari :
                                        <ul>
                                            <li>Surat Kuasa</li>
                                            <li>Surat Pengantar</li>
                                            <li>Surat Pernyataan Minat</li>
                                            <li>Surat Pernyataan </li>
                                            <li>Isian Formulir Administrasi</li>
                                        </ul>
                                    </label>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="dokumen_penawaran" class="form-label">Dokumen Penawaran <small
                                            class="text-muted">
                                            .PDF</small></label>
                                    <input type="file" class="form-control" name="dokumen_penawaran"
                                        id="dokumen_penawaran" accept="application/pdf" />
                                    <a href="{{ url('Download/lampiranPenawaran') }}">Download Template</a>

                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="dokumen_akta" class="form-label">Dokumen Akta Perusahaan <small
                                            class="text-muted">
                                            .PDF</small></label>
                                    <input type="file" class="form-control" name="dokumen_akta" id="dokumen_akta"
                                        accept="application/pdf" />
                                    <label for="dokumen_legalitas" class="form-label">
                                        Lampiran Terdiri Dari :
                                        <ul>
                                            <li>Surat Pakta Integritas</li>
                                            <li>Surat Organisasi Proyek Personil Dan Program Kerja</li>
                                        </ul>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 mt-3">
                                <button type="submit" class="btn btn-primary float-end mb-4">Submit </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
