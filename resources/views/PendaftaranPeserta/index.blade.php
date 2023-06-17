@extends('template.master')
@section('content')
    <div class="flex-grow-1 ">
        <h4 class="fw-bold mb-4">
            <span class="text-base fw-light">Info Tentang Tender</span>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Tentang Tender</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        @if (count($infoTender) > 0)
                            @include('PendaftaranPeserta.pendafataran')
                        @else
                            Belum Ada Informasi Saat Ini
                        @endif
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow-1 ">
        <h4 class="fw-bold mb-4">
            <div class="row">
                <div class="col-6">
                    <span class="text-base ">Daftar Sebagai Peserta</span>
                    @if ($i = 0 > 3)
                        <span class="ms-2 badge bg-primary">Primary</span>
                    @endif
                </div>
            </div>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="nama" class="form-label">Nama Tender</label>
                                <label for="harga" class="form-label">Harga Penawaran</label>
                                <input type="number" class="form-control formattedNumberField" id="hargaPenawaran"
                                    name="hargaPenawaran" value="" />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="harga" class="form-label">Harga Penawaran</label>
                                <input type="number" class="form-control formattedNumberField" id="hargaPenawaran"
                                    name="hargaPenawaran" value="{{ old('hargaPenawaran') }}" />
                            </div>
                            <!-- Syarat Tender -->
                            <div class="mb-3 col-md-12">
                                <p class="text-base mb-0">Syarat</p>
                            </div>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
