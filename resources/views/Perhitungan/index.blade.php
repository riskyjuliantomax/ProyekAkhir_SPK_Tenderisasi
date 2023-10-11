@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('perhitungan') }}
    {{-- Check for error and session --}}
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
    {{-- End Check --}}
    {{-- Nilai Setiap Alternatif --}}
    <div class="card">
        <div class="card">
            <h5 class="card-header">Tahap Analisa</h5>
            <div class="table-responsive  text-nowrap">
                <table class="table table-bordered" style="overflow-x:scroll">
                    <form class="ms-4 mt-1">
                        <caption>
                            @csrf
                            <label class="ms-3">List {{ $title }}</label>
                            <div class="float-end me-3">
                                {{-- {{ $perusahaan->onEachSide(3)->links() }} --}}
                            </div>
                        </caption>
                        <thead>
                            <tr>
                                <th style="width: 30%">Nama Perusahaan</th>
                                @foreach ($kriteria as $dataKriteria)
                                    <th>
                                        {{ $dataKriteria->nama_kriteria }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alternatif as $index => $valt)
                                <tr>
                                    <td>{{ $valt->nama_perusahaan }}</td>
                                    @if (count($valt->penilaian) > 0)
                                        @foreach ($valt->penilaian as $key => $value)
                                            <td>
                                                {{ $value->crips->nilai }}
                                            </td>
                                        @endforeach
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td>Tidak ada Data</td>
                                </tr>
                            @endforelse
                    </form>
                </table>
            </div>
        </div>
    </div>
    {{-- End Nilai Alternatif --}}

    {{-- Normalisasi --}}
    <div class="card mt-5">
        <div class="card">
            <h5 class="card-header">Tahap Normalisasi </h5>
            <div class="table-responsive  text-nowrap">
                <table class="table table-bordered" style="overflow-x:scroll">
                    <form class="ms-4 mt-1">
                        <caption>
                            @csrf
                            <label class="ms-3">List Normalisasi</label>
                            <div class="float-end me-3">
                                {{-- {{ $perusahaan->onEachSide(3)->links() }} --}}
                            </div>
                        </caption>
                        <thead>
                            <tr>
                                <th style="width: 30%">Nama Perusahaan</th>
                                @foreach ($kriteria as $dataKriteria)
                                    <th>
                                        {{ $dataKriteria->nama_kriteria }}
                                    </th>
                                @endforeach
                                <th rowspan="2" style="text-align: center; padding-bottom: 30px; width:100px">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($normalisasi as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    @foreach ($value as $key_1 => $value_1)
                                        <td>
                                            {{ number_format($value_1, 2) }}

                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                    </form>
                </table>
            </div>
        </div>
    </div>
    {{-- End Normalisasi --}}

    {{-- Ranking --}}
    <div class="card mt-5">
        <div class="card">
            <h5 class="card-header">Tahap Ranking </h5>
            <div class="table-responsive   text-nowrap">
                <table class="table table-bordered" style="overflow-x:scroll">
                    <form class="ms-4 mt-1">
                        <caption>
                            @csrf
                            <label class="ms-3">List Ranking </label>
                            <div class="float-end me-3">
                                {{-- {{ $perusahaan->onEachSide(3)->links() }} --}}
                            </div>
                        </caption>
                        <thead>
                            <tr>
                                <th style="width: 30%"></th>
                                @foreach ($kriteria as $dataKriteria)
                                    <th>
                                        {{ $dataKriteria->nama_kriteria }}
                                    </th>
                                @endforeach
                                <th rowspan="2" style="text-align: center; padding-bottom: 30px; width:100px">
                                    Total
                                </th>
                                <th rowspan="2" style="text-align: center; padding-bottom: 30px; width:50px">
                                    Rank
                                </th>
                            </tr>
                            <th>Bobot</th>
                            @foreach ($kriteria as $dataKriteria)
                                <th>
                                    {{ $dataKriteria->bobot * 100 }}%
                                </th>
                            @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($ranking as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    @foreach ($value as $key_1 => $value_1)
                                        <td>
                                            {{ number_format($value_1, 2) }}
                                        </td>
                                    @endforeach
                                    <td>{{ $no++ }}</td>
                                </tr>
                            @endforeach
                    </form>
                </table>
            </div>
        </div>
    </div>
    {{-- End Ranking --}}
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
@include('Penilaian.modal')
@include('Penilaian.js')
