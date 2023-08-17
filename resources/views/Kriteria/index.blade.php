@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('kriteria') }}
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
    <!-- Form controls -->
    <div class="row">
        <div class="col-4">
            <div class="card ">
                <h5 class="card-header">Tambah {{ $title }}</h5>
                <form action="{{ url('Kriteria') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @if ($lockKriteria->lock_kriteria == 1)
                            <div class="text-danger">Kriteria Sedang Di Kunci, Tidak Bisa Melakukan Tambah, Edit Dan
                                Hapus</div>
                        @endif
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBackdrop" class="form-label">Nama Kriteria</label>
                                @if ($lockKriteria->lock_kriteria == 0)
                                    <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control"
                                        value="{{ old('nama_kriteria') }}" />
                                @elseif($lockKriteria->lock_kriteria == 1)
                                    <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control"
                                        value="{{ old('nama_kriteria') }}" disabled />
                                @endif
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailBackdrop" class="form-label">Bobot (%)</label>
                                @if ($lockKriteria->lock_kriteria == 0)
                                    <input type="number" id="bobot" name="bobot" class="form-control"
                                        placeholder="1-100" value="{{ old('bobot') }}" />
                                @elseif($lockKriteria->lock_kriteria == 1)
                                    <input type="number" id="bobot" name="bobot" class="form-control"
                                        placeholder="1-100" value="{{ old('bobot') }}" disabled />
                                @endif
                            </div>
                            {{-- <div class="col mb-0">
                        <label for="dobBackdrop" class="form-label">Attribut</label>
                        <select id="attribut" name="attribut" class="form-select">
                            <option value="" {{ old('attribut') == '' ? 'selected' : '' }}>Pilih Attribut
                            </option>
                            <option value="benefit" {{ old('attribut') == 'benefit' ? 'selected' : '' }}>Benefit
                            </option>
                            <option value="cost" {{ old('attribut') == 'cost' ? 'selected' : '' }}>Cost</option>
                        </select>
                    </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="reset" class="btn btn-outline-danger">
                            Reset
                        </button> --}}
                        @if ($lockKriteria->lock_kriteria == 0)
                            <button type="submit" class="btn btn-primary">Save</button>
                        @endif
                    </div>
                    <div class="ms-4 me-4">
                        <h5 class="fw-bold"> Petunjuk Kriteria </h5>
                        <ul class="list-unstyled" style="text-align: justify;">
                            <li class="mb-1"><b>Kriteria </b>adalah attribut yang digunakan untuk mengevaluasi berbagai
                                peserta pengadaan barang</li>
                            <li class="mb-1">Kriteria juga diberikan <b>bobot</b> dengan total <b>100%</b>
                            </li>
                            <li>Contoh :<b> Kriteria A</b> diberikan bobot 40%, maka sisa 60% digunakan untuk kriteria lain
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-8">
            <!-- Button trigger modal -->
            <div class="ms-2 mt-3">
                <div class="float-end ">
                    <form action="Kriteria" method="GET">
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" placeholder="Cari Nama Kriteria"
                                aria-label="Cari Nama Kriteria" aria-describedby="basic-addon-search31" name="search"
                                style='width:260px'>
                            <button type="Submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <h5 class="col-6">{{ $title }}</h5>
                <div class="col-6">
                    @if ($lockKriteria->lock_kriteria == 0)
                        <a href="{{ url('Kriteria/lock') }}" class="btn btn-danger float-end"><i
                                class='bx bx-lock-open-alt'></i></a>
                    @elseif ($lockKriteria->lock_kriteria == 1)
                        <a href="{{ url('Kriteria/lock') }}" class="btn btn-danger float-end" style="opacity: 0.5"><i
                                class='bx bx-lock-alt'></i></a>
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <caption class="ms-4 mt-1">
                        List {{ $title }}
                        <div class="float-end me-3">
                            {{ $kriteria->onEachSide(3)->links() }}
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th style="width:7%">No</th>
                            <th>@sortablelink('nama_kriteria', 'Nama Kriteria')</th>
                            <th>@sortablelink('attribut', 'Attribut')</th>
                            <th>@sortablelink('bobot', 'Bobot')</th>
                            <th>Status Crips</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $index => $data)
                            <tr>
                                <input type="hidden" class="id_kriteria" value="{{ $data->id_kriteria }}" />
                                <td> {{ $kriteria->firstItem() + $index }} </td>
                                <td>{{ ucfirst($data->nama_kriteria) }}
                                </td>
                                <td>
                                    @if ($data->attribut == 'benefit')
                                        <span class="badge bg-success">{{ $data->attribut }}</span>
                                    @endif
                                    @if ($data->attribut == 'cost')
                                        <span class="badge bg-danger">{{ $data->attribut }}</span>
                                    @endif
                                </td>
                                <td>{{ $data->bobot * 100 }}%</td>
                                <td>
                                    @if ($data->crips_count == 5)
                                        <span class="badge bg-success">Terpenuhi</span>
                                    @endif
                                    @if ($data->crips_count != 5)
                                        <span class="badge bg-danger">Belum Terpenuhi</span>
                                    @endif
                                </td>
                                <td style="width:20%">
                                    <a href="{{ url('Kriteria/Crips/' . $data->id_kriteria) }}"
                                        class="btn btn-icon btn-info">
                                        <span class="tf-icons bx bx-book"></span>
                                    </a>
                                    @if ($data->lock_kriteria == 0)
                                        <a href="{{ url('Kriteria/edit/' . $data->id_kriteria) }}"
                                            class="btn btn-icon btn-primary">
                                            <span class="tf-icons bx bx-edit-alt"></span>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-danger btn-delete">
                                            <span class="tf-icons bx bx-trash-alt"></span>
                                        </button>
                                    @elseif ($data->lock_kriteria == 1)
                                        {{-- <a class="btn btn-icon btn-gray" disabled>
                                            <span class="tf-icons bx bx-book"></span>
                                        </a> --}}
                                        <a class="btn btn-icon btn-gray">
                                            <span class="tf-icons bx bx-edit-alt" disabled></span>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-gray">
                                            <span class="tf-icons bx bx-trash-alt" disabled></span>
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

@include('Kriteria.js')
