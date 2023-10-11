@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('listpengadaan') }}
    <div class="col-xl-12">
        <div class="nav-align-top">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-berlangsung" aria-controls="navs-top-berlangsung"
                        aria-selected="true">Pengadaan Barang</button>
                </li>
                {{-- <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-selesai" aria-controls="navs-top-selesai"
                        aria-selected="false">Selesai</button>
                </li> --}}
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-berlangsung" role="tabpanel">
                    <div class="flex-grow-1 pb-0">
                        <div class="ms-2 mt-3">
                            <div class="float-end me-3">
                                <form action="{{ url('ListPengadaan') }}" method="GET">
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" placeholder="Cari Nama Pengadaan"
                                            aria-label="Cari Nama Pengadaan" aria-describedby="basic-addon-search31"
                                            name="search" style='width:260px'>
                                        <button type="Submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <h5 class="ms-3 mt-3">{{ $title }}</h5>
                        </div>
                        <div class="card-body pb-0">
                            <table class="table table-responsive table-bordered">
                                <caption class="ms-4 mt-1">
                                    List {{ $title }}
                                    <div class="float-end me-3">
                                        {{ $infoTender->onEachSide(3)->links() }}
                                    </div>
                                </caption>
                                <thead>
                                    <tr>
                                        <th style="width:5%">No</th>
                                        <th>@sortablelink('nama_infoTender', 'Nama Pengadaan')</th>
                                        <th>@sortablelink('harga_infoTender', 'Harga')</th>
                                        <th>Partisipasi</th>
                                        <th>@sortablelink('status', 'Status')</th>
                                        <th>@sortablelink('created_at', 'Tanggal Dibuat')</th>
                                        <th style="width:2%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infoTender as $index => $data)
                                        <tr>
                                            <input type="hidden" class="id_infoTender"
                                                value="{{ $data->id_infoTender }}" />
                                            <td> {{ $infoTender->firstItem() + $index }} </td>
                                            <td>
                                                <a href="{{ url('DetailPengadaan/' . $data->id_infoTender) }}">
                                                    {{ ucFirst($data->nama_infoTender) }}
                                                </a>
                                            </td>
                                            <td>Rp. {{ number_format($data->harga_infoTender) }}</td>
                                            <td>{{ count($data->peserta) }}</td>
                                            <td>
                                                @if ($data->status == 0)
                                                    <small><span class="ms-2 badge bg-info">Lagi
                                                            Proses</span></small>
                                                @endif
                                                @if ($data->status == 1)
                                                    <small><span class="ms-2 badge bg-danger">Gagal</span></small>
                                                @endif
                                                @if ($data->status == 2)
                                                    <small><span class="ms-2 badge bg-success">Selesai</span></small>
                                                @endif
                                            </td>
                                            <td>{{ $data->created_at->format('d/m/Y') }}
                                                <br />
                                                {{-- Jam : {{ $data->created_at->format('h.i') }} --}}
                                            </td>
                                            <td>
                                                <a href="{{ url('DetailPengadaan/' . $data->id_infoTender) }}"
                                                    class="btn btn-info text-white">
                                                    Detail
                                                </a>
                                            </td>
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
