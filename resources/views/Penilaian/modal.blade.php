{{-- <!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ url('Penilaian') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Perusahaan</label>
                        <select name="id_perusahaan" class="select2 form-select" aria-label="Default select example">
                            <option value="">-- Pilih Perusahaan --</option>
                            @foreach ($perusahaan_noexists as $data)
                                <option value="{{ $data->id_perusahaan }}">{{ $data->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    @foreach ($kriteria as $index => $data)
                        <div class="col-6 mb-3">
                            <label for="nameBackdrop" class="form-label">{{ ucFirst($data->nama_kriteria) }}
                                (%)
                                @if ($data->attribut == 'benefit')
                                    <span class="badge bg-success">{{ $data->attribut }}</span>
                                @endif
                                @if ($data->attribut == 'cost')
                                    <span class="badge bg-danger">{{ $data->attribut }}</span>
                                @endif
                            </label>
                            <input type="number" id="nilai_{{ 1 + $index }}" name="nilai_{{ 1 + $index }}"
                                class="form-control" placeholder="Masuki Nilai Berupa Angka" required />
                            <input type="hidden" value="{{ $data->id_kriteria }}"
                                name="id_kriteria_{{ 1 + $index }}" id="id_kriteria_{{ 1 + $index }}" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@foreach ($penilaian as $data)
    <!-- Modal -->
    <div class="modal fade" id="modalFormEdit{{ $data->id_perusahaan }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('Penilaian/' . $data['id_penilaian']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Tambah {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control"
                                value="{{ ucFirst($data->Perusahaan->nama_perusahaan) }}" disabled />
                            </label>
                            <input type="hidden" name="id_penilaian" id="id_penilaian"
                                value="{{ $data['id_penilaian'] }}" />
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($kriteria as $index => $dataKriteria)
                            <div class="col-6 mb-3">
                                <label for="nameBackdrop"
                                    class="form-label">{{ ucFirst($dataKriteria->nama_kriteria) }}
                                    (%)
                                    @if ($dataKriteria->attribut == 'benefit')
                                        <span class="badge bg-success">{{ $dataKriteria->attribut }}</span>
                                    @endif
                                    @if ($dataKriteria->attribut == 'cost')
                                        <span class="badge bg-danger">{{ $dataKriteria->attribut }}</span>
                                    @endif
                                </label>
                                <input type="number" id="nilai_{{ 1 + $index }}" name="nilai_{{ 1 + $index }}"
                                    class="form-control" value="{{ $data['kriteria' . (1 + $index)] }}" />
                                <input type="hidden" value="{{ $data->id_kriteria }}"
                                    name="id_kriteria_{{ 1 + $index }}" id="id_kriteria_{{ 1 + $index }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endforeach --}}
