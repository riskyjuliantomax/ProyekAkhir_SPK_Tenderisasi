{{-- Modal Update --}}

<div id="modalFormEdit" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <form action="{{ url('Kriteria/' . $data->id_crips) }}" class="modal-content" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Edit {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_crips" value="{{ $data->id_crips }}" />
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Kriteria</label>
                        <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control"
                            value="{{ $data->nama_crips }}" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBackdrop" class="form-label">Bobot (%)</label>
                        <input type="number" id="bobot" name="bobot" class="form-control" placeholder="1-100"
                            value="{{ $data->bobot * 100 }}" />
                    </div>
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
