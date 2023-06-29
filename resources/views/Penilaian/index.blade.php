@extends('template.master')
@section('content')
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
    <a href="{{ url('Penilaian') }}" class="btn btn-primary mb-3">Kembali</a>
    {{-- End Check --}}
    <div class="card">
        <h5 class="card-header">{{ $title }}</h5>
        <div class="table-responsive  text-nowrap">
            <table class="table" style="overflow-x:scroll">
                <form action="{{ url('Penilaian/' . $id_infoTender->id_infoTender) }}" method="POST" class="ms-4 mt-1">
                    @if ($id_infoTender->status == 2)
                        <a href="{{ url('Penilaian/LihatHasil/' . $id_infoTender->id_infoTender) }}"
                            class="btn btn-success me-3 mb-2 float-end">Lihat Hasil</a>
                    @else
                        <input type="submit" value="Simpan" class="btn btn-primary me-3 mb-2 float-end" />
                    @endif
                    <caption>
                        @csrf
                        <label class="ms-3">List {{ $title }}</label>
                        <div class="float-end me-3">
                            {{-- {{ $perusahaan->onEachSide(3)->links() }} --}}
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <input type="hidden" name="id_infoTender" value="{{ $id_infoTender->id_infoTender }}" />
                            <th style="width:7%">No</th>
                            <th style="width: 30%">Nama Perusahaan</th>
                            @foreach ($kriteria as $dataKriteria)
                                <th>
                                    {{ $dataKriteria->nama_kriteria }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perusahaan as $index => $valt)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $valt->nama_perusahaan }}</td>
                                @if (count($valt->penilaian) > 0)
                                    @foreach ($kriteria as $key => $value)
                                        <td>
                                            <select name="id_crips[{{ $valt->id_perusahaan }}][]" class="form-select"
                                                @if ($id_infoTender->status == 2) disabled @endif>
                                                @foreach ($value->crips as $k_1 => $v_1)
                                                    <option
                                                        value="{{ $v_1->id_crips }}"{{ $v_1->id_crips == $valt->penilaian[$key]->id_crips ? 'selected' : '' }}>
                                                        {{ $v_1->nama_crips }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </td>
                                    @endforeach
                                @else
                                    @foreach ($kriteria as $key => $value)
                                        <td>
                                            <select name="id_crips[{{ $valt->id_perusahaan }}][]" class="form-select"
                                                @if ($id_infoTender->status == 2) disabled @endif>>
                                                @foreach ($value->crips as $k_1 => $v_1)
                                                    <option value="{{ $v_1->id_crips }}">{{ $v_1->nama_crips }}
                                                    </option>
                                                @endforeach

                                            </select>
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
