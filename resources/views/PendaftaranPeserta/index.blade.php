@extends('template.master')
@section('content')
    <div class="flex-grow-1 ">
        <h4 class="fw-bold mb-4">
            <span class="text-base fw-light">Info Tentang Tender</span>
        </h4>
        <a href="#DaftarPeserta" class="btn btn-primary mb-3">Daftar Sebagai Peserta</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Tentang Tender</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        @if (count($infoTender) > 0)
                            @include('PendaftaranPeserta.infoTender')
                        @else
                            Belum Ada Informasi Saat Ini
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow-1 ">
        <h4 class="fw-bold mb-4">
            <div class="row">
                <div class="col-6">
                    <span class="text-base ">Daftar Sebagai Peserta</span>
                    @if (count($approveUser) > 0)
                        @foreach ($approveUser as $data)
                            @if ($data->approve == 0)
                                <small><span class="ms-2 badge bg-warning">Proses</span></small>
                            @endif
                            @if ($data->approve == 1)
                                <small><span class="ms-2 badge bg-danger">DiTolak</span></small>
                            @endif
                            @if ($data->approve == 2)
                                <small><span class="ms-2 badge bg-success">DiTerima</span></small>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </h4>
        <div class="row" id="DaftarPeserta">
            <div class="col-md-12">
                <div class="card mb-4">
                    <hr class="my-0">
                    <form action="{{ url('PendaftaranPeserta') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (Auth::check())
                                <input type="hidden" name="id_users" id="id_users"
                                    value="{{ auth()->user()->id_users }}" />
                            @endif
                            @if (count($pendaftaranUser) > 0)
                                @include('PendaftaranPeserta.updatePendaftaran')
                            @else
                                @include('PendaftaranPeserta.formPendaftaran')
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
