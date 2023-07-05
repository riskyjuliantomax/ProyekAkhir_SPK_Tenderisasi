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
                                <div class="mb-3 col-md-12">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control " id="nama_perusahaan" name="nama_perusahaan"
                                        placeholder="PT.XXX XXXXX" value="{{ old('nama_perusahaan') }}" required />
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama_perusahaan" class="form-label">Harga Penawaran <small
                                                class="text-muted">tanpa
                                                berkoma</small></label></label>
                                        <input type="number" class="form-control " id="harga_penawaran"
                                            name="harga_penawaran" placeholder="XXXXXXXX"
                                            value="{{ old('harga_penawaran') }}" required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="npwp_perusahaan" class="form-label">NPWP Perusahaan</label>
                                        <input type="text" class="form-control " id="npwp_perusahaan"
                                            name="npwp_perusahaan" value="{{ old('npwp_perusahaan') }}"
                                            placeholder="xxxx.xxx.xxx.xxx" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="email_perusahaan" class="form-label">Email Perusahaan</label>
                                    <input type="text" class="form-control " id="email_perusahaan"
                                        name="email_perusahaan" placeholder="xxxxx@xxxx.com"
                                        value="{{ old('email_perusahaan') }}" required />

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="telp_perusahaan" class="form-label">Telp Perusahaan</label>
                                    <input type="text" class="form-control " id="telp_perusahaan" name="telp_perusahaan"
                                        placeholder="xxxxxxxxx" value="{{ old('telp_perusahaan') }}" />

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nama" class="form-label">Alamat Perusahaan</label>
                                <textarea class="form-control" rows="5" style="resize: none" name="alamat_perusahaan" id="alamat_perusahaan"
                                    required>{{ old('alamat_perusahaan') }}</textarea>
                            </div>
                            <h5 class="fw-bold">Lampiran</h5>
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="dokumen_legalitas" class="form-label">Dokumen Administrasi <small
                                            class="text-muted">
                                            .PDF</small></label>
                                    <input type="file" class="form-control" name="dokumen_legalitas"
                                        id="dokumen_legalitas" accept="application/pdf" />
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="dokumen_penawaran" class="form-label">Dokumen Penawaran <small
                                            class="text-muted">
                                            .PDF</small></label>
                                    <input type="file" class="form-control" name="dokumen_penawaran"
                                        id="dokumen_penawaran" accept="application/pdf" />
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="dokumen_akta" class="form-label">Dokumen Akta Perusahaan <small
                                            class="text-muted">
                                            .PDF</small></label>
                                    <input type="file" class="form-control" name="dokumen_akta" id="dokumen_akta"
                                        accept="application/pdf" />
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
