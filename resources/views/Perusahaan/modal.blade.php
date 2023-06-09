<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ url('Perusahaan') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Perusahaan *)</label>
                        <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control"
                            placeholder="Enter Name" value="{{ old('nama_perusahaan') }}" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="email" class="form-label">Email Perusahaan *)</label>
                        <input type="email" id="email_perusahaan" name="email_perusahaan" class="form-control"
                            placeholder="xxxx@xxx.xx" value="{{ old('email_perusahaan') }}" />
                    </div>
                    <div class="col mb-3">
                        <label for="notelp" class="form-label">No Telp Perusahaan</label>
                        <input type="number" id="telp_perusahaan" name="telp_perusahaan" class="form-control"
                            placeholder="016xxxx" value="{{ old('telp_perusahaan') }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Alamat *)</label>
                        <textarea class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" rows="3">{{ old('alamat') }}</textarea>
                    </div>
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

{{-- Modal Update --}}
@foreach ($perusahaan as $data)
    <div class="modal fade" id="modalFormEdit{{ $data->id_perusahaan }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ url('Perusahaan/' . $data->id_perusahaan) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Edit {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id_perusahaan" value="{{ $data->id_perusahaan }}" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Nama Perusahaan *)</label>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control"
                                value="{{ $data->nama_perusahaan }}" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email Perusahaan *)</label>
                            <input type="email" id="email_perusahaan" name="email_perusahaan" class="form-control"
                                value="{{ $data->email_perusahaan }}" />
                        </div>
                        <div class="col mb-3">
                            <label for="notelp" class="form-label">No Telp Perusahaan</label>
                            <input type="number" id="telp_perusahaan" name="telp_perusahaan" class="form-control"
                                value="{{ $data->telp_perusahaan }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Alamat *)</label>
                            <textarea class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" rows="3">{{ $data->alamat_perusahaan }}
                            </textarea>
                        </div>
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
@endforeach
