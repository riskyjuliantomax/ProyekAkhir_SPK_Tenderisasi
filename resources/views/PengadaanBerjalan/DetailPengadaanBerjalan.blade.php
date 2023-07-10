@extends('template.master')
@section('content')
    <div class="col-xl-12">
        <a href="{{ url('PengadaanBerjalan') }}" class="btn btn-primary mb-2">Kembali</a>
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-detail" aria-controls="navs-top-detail" aria-selected="true">Detail
                        Pengadaan
                        Berjalan</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-peserta" aria-controls="navs-top-peserta"
                        aria-selected="false">Peserta</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="navs-top-detail" role="tabpanel">
                    <div class="ms-4 mt-2">
                        <h4 class="fw-bold">
                            <span class="text-base fw-light ">Detail Pengadaan Barang</span>
                        </h4>
                        @if ($infoTender->status == 0)
                            <span class="fw-bold text-white mt-2 bg-warning px-2 py-1" style="border-radius: 5px">
                                Proses
                            </span>
                        @endif
                        @if ($infoTender->status == 1)
                            <span class="fw-bold text-white mt-2 bg-danger px-2 py-1" style="border-radius: 5px"">
                                Danger
                            </span>
                        @endif
                        @if ($infoTender->status == 2)
                            <span class="fw-bold text-white mt-2 bg-success px-2 py-1" style="border-radius: 5px"">
                                Sukses
                            </span>
                        @endif
                    </div>
                    <div>
                        <div class="card-body overflow-auto">
                            <table class="table table-bordered ">
                                <tbody>
                                    <tr>
                                        <td class="col-md-2">Nama Pengadaan </td>
                                        <td class="col-md-10">{{ $infoTender->nama_infoTender }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2">Harga</td>
                                        <td class="col-md-10">{{ number_format($infoTender->harga_infoTender) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2" style="vertical-align: top">Syarat</td>
                                        <td class="col-md-10">
                                            {!! $infoTender->syarat_infoTender !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="navs-top-peserta" role="tabpanel">
                    <div class="ms-4 mt-2">
                        <h4 class="fw-bold mb-4">
                            <span class="text-base fw-light">List Peserta</span>
                        </h4>
                    </div>
                    <div>
                        <div class="card-body overflow-auto">
                            <table class="table table-responsive table-bordered ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>@sortablelink('nama_perusahaan', 'Nama Perushaaan')</th>
                                        <th>Selisih Harga</th>
                                        <th>@sortablelink('harga_penawaran', 'Harga Penawaran')</th>
                                        <th>@sortablelink('email_perusahaan', 'Email')</th>
                                        <th>@sortablelink('telp_perusahaan', 'Telp')</th>
                                        <th>@sortablelink('created_at', 'Tanggal Pengajuan')</th>
                                        <th>@sortablelink('approve', 'Status')</th>
                                        <th>Aksi
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peserta as $index => $data)
                                        <tr>
                                            <td>{{ 1 + $index }}</td>
                                            <td>{{ $data->nama_perusahaan }}</td>
                                            <td>{{ number_format($data->selisihHarga) }}</td>
                                            <td>Rp. {{ number_format($data->harga_penawaran) }}</td>
                                            <td>{{ $data->email_perusahaan }}</td>
                                            <td>{{ $data->telp_perusahaan }}</td>
                                            <td>{{ $data->created_at->format('d/m/y') }}</td>
                                            <td>
                                                @if ($data->approve == 0)
                                                    <span class="bg-label-warning p-2">Proses</span>
                                                @endif
                                                @if ($data->approve == 1)
                                                    <span class="bg-label-danger p-2">Ditolak</span>
                                                @endif
                                                @if ($data->approve == 2)
                                                    <span class="bg-label-success p-2">Diterima</span>
                                                @endif
                                            </td>

                                            <td><a href="{{ url('PengadaanBerjalan/Detail/Peserta/' . $data->id_pendaftaran_users) }}"
                                                    class="btn btn-primary">Detail</a>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
