@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('listpengadaan') }}
    <div class="flex-grow-1 ">
        <h4 class="fw-bold mb-4">
            <span class="text-base fw-light">Info Tentang Tender</span>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <hr class="my-0">
                    <div class="card-body">
                        <table class="table">
                            <caption class="ms-4 mt-1">
                                List {{ $title }}
                                <div class="float-end me-3">
                                    {{ $infoTender->onEachSide(3)->links() }}
                                </div>
                            </caption>
                            <thead>
                                <tr>
                                    <th style="width:7%">No</th>
                                    <th style="width:65%">Nama Pengadaan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th style="width:2%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($infoTender as $index => $data)
                                    <a href="#Test">
                                        <tr>
                                            <input type="hidden" class="id_infoTender"
                                                value="{{ $data->id_infoTender }}" />
                                            <td> {{ $infoTender->firstItem() + $index }} </td>
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
                                                <a href="{{ url('DetailPengadaan/' . $data->id_infoTender) }}"
                                                    class="btn btn-info text-white">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    </a>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
