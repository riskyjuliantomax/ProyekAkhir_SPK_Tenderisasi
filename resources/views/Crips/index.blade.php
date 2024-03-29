@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('crips') }}
    <a href="{{ url('Kriteria') }}" class="btn btn-primary mb-2">
        <span class='bx bx-arrow-back'></span>
        Kembali </a>
    {{-- Check for error and session --}} @if ($errors->any())
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
    <!-- Form controls -->
    <div class="row">
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Tambah {{ $title }}</h5>
                <form action="{{ url('Kriteria/Crips') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $data['kriteria']->id_kriteria }}" name="id_kriteria" />
                    <div class="modal-body">
                        <div class="row">
                            @if ($data['lock_kriteria']->lock_kriteria == 1)
                                <div class="text-danger"> Kriteria Sedang Di Kunci, Tidak Bisa Ubah Crips. </div>
                            @endif
                            <div class="col mb-3">
                                <label for="nameBackdrop" class="form-label">Nama Crips</label>
                                @if ($data['lock_kriteria']->lock_kriteria == 0)
                                    <input type="text" id="nama_crips" name="nama_crips" class="form-control"
                                        value="{{ old('nama_crips') }}" />
                                @elseif ($data['lock_kriteria']->lock_kriteria == 1)
                                    <input type="text" id="nama_crips" name="nama_crips" class="form-control"
                                        value="{{ old('nama_crips') }}" disabled />
                                @endif
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailBackdrop" class="form-label">Nilai</label>
                                @if ($data['lock_kriteria']->lock_kriteria == 0)
                                    <input type="number" id="nilai" name="nilai" class="form-control"
                                        placeholder="Masuki Berupa Angka" value="{{ old('nilai') }}" />
                                @elseif ($data['lock_kriteria']->lock_kriteria == 1)
                                    <input type="number" id="nilai" name="nilai" class="form-control"
                                        placeholder="Masuki Berupa Angka" value="{{ old('nilai') }}" disabled />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if ($data['lock_kriteria']->lock_kriteria == 0)
                            <button type="submit" class="btn btn-primary">Save</button>
                        @endif
                    </div>
                    <div class="mx-4">
                        <h5>Petunjuk Crips</h5>
                        <ul class="list-unstyled" style="text-align: justify;">
                            <li><b class="text-danger">Dipastikan Crips Harus Ada 5 Dan Semua Penamaan Harus Tepat
                                    Dahulu!!</b></li>
                            <li>Crips adalah nilai dari suatu attribut kriteria, ada beberapa <b>aturan</b> untuk Crips
                                Yaitu :</li>
                            <li>1. Penamaan Crips dibuat berdasarkan kebutuhan dari pokja</li>
                            <li>2. Pemberian nilai crips harus berupa angka </li>
                            <li>3. nilai crips diberikan disesuaikan dengan attribut kriteria,
                                apabila attribut kriteria <b>benefit</b>, nilai crips diberikan paling tinggi adalah
                                terbaik<br />
                                sebaliknya, apabila attribut kriteria <b>cost</b>, nilai crips diberikan paling rendah
                                adalah
                                terbaik
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-8">
            <!-- Button trigger modal -->
            <div class="ms-2 mt-3">
                <div class="float-end me-3">
                    <form action="Kriteria" method="GET">
                        <div class="input-group input-group-merge">
                            {{-- <input type="text" class="form-control" placeholder="Cari Nama Kriteria"
                                aria-label="Cari Nama Kriteria" aria-describedby="basic-addon-search31" name="search"
                                style='width:260px'>
                            <button type="Submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i> --}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <h5 class="ms-3">{{ $title }} {{ $data['kriteria']->nama_kriteria }}
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <caption class="ms-4 mt-1">
                        List {{ $title }}
                        <div class="float-end me-3">
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th style="width:7%">No</th>
                            <th>@sortablelink('nama_crips', 'Nama Crips')</th>
                            <th>@sortablelink('nilai', 'Nilai')</th>
                            <th style="width:15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['crips'] as $index => $datas)
                            <tr>
                                <input type="hidden" id="id_crips" name="id_crips" class="id_crips"
                                    value="{{ $datas->id_crips }}" />
                                <td> {{ 1 + $index }} </td>
                                <td>{{ ucfirst($datas->nama_crips) }}
                                </td>
                                <td>{{ $datas->nilai }}</td>
                                <td style="width:20%">
                                    @if ($data['lock_kriteria']->lock_kriteria == 0)
                                        <a href="{{ url('/Kriteria/Crips/edit/' . $datas->id_crips) }}"
                                            class="btn btn-icon btn-primary">
                                            <span class="tf-icons bx bx-edit-alt"></span>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-danger btn-delete">
                                            <span class="tf-icons bx bx-trash-alt"></span>
                                        </button>
                                    @elseif ($data['lock_kriteria']->lock_kriteria == 1)
                                        <a href="" class="btn btn-icon btn-gray">
                                            <span class="tf-icons bx bx-edit-alt"></span>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-gray">
                                            <span class="tf-icons bx bx-trash-alt"></span>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{-- Modal --}}
@endsection()
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

{{-- @include('Crips.modal') --}}
@include('Crips.js')
