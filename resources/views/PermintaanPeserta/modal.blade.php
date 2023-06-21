<!-- Modal Create-->
@foreach ($pendaftaranUser as $data)
    <div id="modalDetail{{ $data->id_pendaftaran_users }}" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="#" class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <h5 class="modal-title mb-3" id="modalTitle">Detail {{ $title }}</h5>
                        <label class="modal-title" id="modalTitle">Role : {{ ucFirst($data->role) }}</label>
                    </div>
                    <div class="col my-3 float">
                        @if ($data->img_profile != '' || $data->img_profile != null)
                            <img src="{{ asset('storage/photoProfileUser/' . $data->img_profile) }}" width="120"
                                height="120" class=" rounded-circle p-2 b float-end">
                        @endif
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Nama</label>
                            <div>
                                <label>{{ ucFirst($data->nama) }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class="col-form-label text-light fw-semibold">Email</label>
                            <div>
                                <label>{{ ucFirst($data->email) }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">No
                                Handphone</label>
                            <div>
                                <label>{{ ucFirst($data->no_hp) }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Jenis
                                Kelamin</label>
                            <div>
                                <label>{{ $data->kelamin = isset($data->kelamin) ? ucFirst($data->kelamin) : 'Tidak Ada' }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tanggal
                                Lahir</label>
                            <div>
                                <label>{{ date('d-m-Y', strtotime($data->tgl_lahir)) }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tempat
                                Lahir</label>
                            <div>
                                <label>{{ $data->tempat_lahir }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tanggal
                                Dibuat Akun</label>
                            <div>
                                <label>{{ ucFirst($data->created_at) }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tentang</label>
                            <div>
                                <label>{{ $data->tentang }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Terakhir
                                Login</label>
                            <div>
                                <label>{{ ucFirst($data->last_login) }}<br>
                                    {{ \Carbon\Carbon::parse($data->last_login)->diffForHumans() }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Terakhir
                                Logout</label>
                            <div>
                                <label>{{ $data->last_logout }} <br>
                                    {{ \Carbon\Carbon::parse($data->last_logout)->diffForHumans() }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="modal-footer">
                    {{-- <button type="reset" class="btn btn-outline-danger">
                    Reset
                </button> --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Create --}}
@endforeach
