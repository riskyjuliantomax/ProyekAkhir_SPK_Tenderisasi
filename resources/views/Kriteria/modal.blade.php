<!-- Modal Create-->
<div id="modalForm" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">

        <form action="{{ url('Kriteria') }}" class="modal-content" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle" data-original-title="Tambah">Tambah
                    {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Kriteria</label>
                        <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control"
                            value="{{ old('nama_kriteria') }}" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBackdrop" class="form-label">Bobot (%)</label>
                        <input type="number" id="bobot" name="bobot" class="form-control" placeholder="1-100"
                            value="{{ old('bobot') }}" />
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
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
{{-- End Modal Create --}}

{{-- Modal Update --}}
@foreach ($kriteria as $data)
    <div id="modalFormEdit{{ $data->id_kriteria }}" class="modal fade" tabindex="-1">
        <div class="modal-dialog ">
            <form action="{{ url('Kriteria/' . $data->id_kriteria) }}" class="modal-content" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Edit {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_kriteria" value="{{ $data->id_kriteria }}" />
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Nama Kriteria</label>
                            <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control"
                                value="{{ $data->nama_kriteria }}" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailBackdrop" class="form-label">Bobot (%)</label>
                            <input type="number" id="bobot" name="bobot" class="form-control" placeholder="1-100"
                                value="{{ $data->bobot * 100 }}" />
                        </div>
                        {{-- <div class="col mb-0">
                            <label for="dobBackdrop" class="form-label">Attribut</label>
                            <select id="attribut" name="attribut" class="form-select">
                                <option value="" {{ $data->attribut == '' ? 'selected' : '' }}>Pilih Attribut
                                </option>
                                <option value="benefit" {{ $data->attribut == 'benefit' ? 'selected' : '' }}>Benefit
                                </option>
                                <option value="cost" {{ $data->attribut == 'cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
