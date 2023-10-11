@extends('template.master')
@section('content')
    <h5>List Pengadaan Untuk Penilaian</h5>
    <div class="card">
        <div class="ms-4 mt-3 mb-1">
            <div class="float-end me-4">
                <form action="Penilaian" method="GET">
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control" placeholder="Cari Nama Pengadaan" aria-label="Cari Nama User"
                            aria-describedby="basic-addon-search31" name="search" style='width:260px'>
                        <button type="Submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>@sortablelink('nama_infoTender', 'Nama Pengadaan')</th>
                        <th>Partisipasi</th>
                        <th>@sortablelink('harga_infoTender', 'Harga')</th>
                        <th>@sortablelink('status')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengadaan as $index => $data)
                        <tr>
                            <td>{{ $pengadaan->firstItem() + $index }}</td>
                            <td>{{ $data->nama_infoTender }}</td>
                            <td>{{ count($data->pesertaAcc) }} </td>
                            <td>Rp. {{ number_format($data->harga_infoTender) }}</td>
                            <td>
                                @if ($data->status == 0)
                                    <small><span class="ms-2 badge bg-info">Lagi Proses</span></small>
                                @endif
                                @if ($data->status == 1)
                                    <small><span class="ms-2 badge bg-danger">Gagal</span></small>
                                @endif
                                @if ($data->status == 2)
                                    <small><span class="ms-2 badge bg-success">Selesai</span></small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('Penilaian/Detail/' . $data->id_infoTender) }}"
                                    class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
