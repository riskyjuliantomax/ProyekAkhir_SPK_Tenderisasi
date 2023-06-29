@extends('template.master')
@section('content')
    <div class="flex-grow-1 ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-2">
                    <h4 class="fw-bold">
                        <span class="text-base fw-light">Riwayat Pendaftaran</span>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered">
                        <caption class="ms-4 mt-1">
                            List {{ $title }}
                            <div class="float-end me-3">
                                {{ $pendaftaran->onEachSide(3)->links() }}
                            </div>
                        </caption>
                        <thead>
                            <tr>
                                <th style="width:7%">No</th>
                                <th style="width:65%">@sortablelink('nama_infoTender', 'Nama Pengadaan')</th>
                                <th>@sortablelink('harga_infoTender', 'Harga')</th>
                                <th>@sortablelink('status', 'Status')</th>
                                <th>@sortablelink('created_at', 'Tanggal Pengajuan')</th>
                                <th style="width:2%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftaran as $index => $data)
                                <tr>
                                    <input type="hidden" class="id_infoTender" value="{{ $data->id_infoTender }}" />
                                    <td> {{ $pendaftaran->firstItem() + $index }} </td>
                                    <td>{{ ucFirst($data->nama_infoTender) }}</td>
                                    <td>{{ number_format($data->harga_infoTender) }}</td>
                                    <td>
                                        @if ($data->approve == 0)
                                            <small><span class="ms-2 badge bg-info">Lagi Proses</span></small>
                                        @endif
                                        @if ($data->approve == 1)
                                            <small><span class="ms-2 badge bg-danger">Gagal</span></small>
                                        @endif
                                        @if ($data->approve == 2)
                                            <small><span class="ms-2 badge bg-success">Selesai</span></small>
                                        @endif
                                    </td>
                                    <td>{{ $data->created_at->format('d/m/Y') }}
                                        <br />
                                        {{-- Jam : {{ $data->created_at->format('h.i') }} --}}
                                    </td>
                                    <td>
                                        @if ($data->approve == 0)
                                            <a href="{{ url('RiwayatPendaftaran/Edit/' . $data->id_pendaftaran_users) }}"
                                                class="btn btn-primary">Edit</a>
                                        @else
                                            <a href="{{ url('RiwayatPendaftaran/' . $data->id_infoTender) }}"
                                                class="btn btn-info text-white">
                                                Detail
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
