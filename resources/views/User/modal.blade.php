<!-- Modal Create-->
<div id="modalForm" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <form action="{{ url('User') }}" enctype="multipart/form-data" class="modal-content" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle" data-original-title="Tambah">Tambah
                    {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="nav-align-top mb-0">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-user" aria-controls="navs-pills-user"
                                aria-selected="true">User</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-alamat" aria-controls="navs-pills-alamat"
                                aria-selected="false">Alamat</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-pills-user" role="tabpanel">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Nama Lengkap *)</label>
                                    <input type="text" id="nama" name="nama" class="form-control"
                                        placeholder="Nama Lengkap" value="{{ old('nama') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="emailBackdrop" class="form-label">Email *)</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="****@gmail.com" value="{{ old('email') }}" />
                                </div>
                                <div class="col mb-3">
                                    <label for="emailBackdrop" class="form-label">Password *)</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="********" value="{{ old('password') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="emailBackdrop" class="form-label">Tanggal Lahir *)
                                        <span class="badge badge-center rounded-pill bg-primary ms-1"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                            data-bs-html="true" title=""
                                            data-bs-original-title="<span>Perusahaan diisi tanggal berdirinya</span>"><i
                                                class='bx bx-question-mark'>
                                            </i>
                                        </span>
                                    </label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                        value="{{ old('tanggal_lahir') }}" />
                                </div>
                                <div class="col mb-33">
                                    <label for="emailBackdrop" class="form-label">Tempat Lahir *)
                                        <span class="badge badge-center rounded-pill bg-primary ms-1"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                            data-bs-html="true" title=""
                                            data-bs-original-title="<span>Perusahaan diisi tempat berdirinya</span>"><i
                                                class='bx bx-question-mark'>
                                            </i>
                                        </span>
                                    </label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                        placeholder="Sesuai KTP" value="{{ old('tempat_lahir') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="emailBackdrop" class="form-label">No Handphone *)</label>
                                    <input type="number" id="no_hp" name="no_hp" class="form-control"
                                        placeholder="08********" value="{{ old('no_hp') }}" />
                                </div>
                                <div class="col mb-3">
                                    <label for="dobBackdrop" class="form-label">Kelamin <span
                                            class="badge badge-center rounded-pill bg-primary ms-1"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                            data-bs-html="true" title=""
                                            data-bs-original-title="<span>Kosongi Jika Perusahaan</span>"><i
                                                class='bx bx-question-mark'>
                                            </i>
                                        </span></label>
                                    <select id="kelamin" name="kelamin" class="form-select">
                                        <option value="" {{ old('kelamin') == '' ? 'selected' : '' }}>
                                            --- Pilih Jenis Kelamin ---
                                        </option>
                                        <option value="laki-laki"
                                            {{ old('kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki - Laki
                                        </option>
                                        <option value="perampuan"
                                            {{ old('kelamin') == 'perampuan' ? 'selected' : '' }}>Perampuan</option>
                                        Kelainan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="dobBackdrop" class="form-label">Role *)</label>
                                    <select id="role" name="role" class="form-select">
                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                            User
                                        </option>
                                        <option value="pokja" {{ old('role') == 'pokja' ? 'selected' : '' }}>Pokja
                                        </option>
                                        <option value="admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>
                                            Admin</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Photo Profil</label>
                                        <input class="form-control" id="photoFile" name="photoFile" type="file">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="navs-pills-alamat" role="tabpanel">
                            <p> Alamat Perusahaan atau Personal
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Kenegaraan *)</label>
                                    <input type="text" id="kenegaraan" name="kenegaraan" class="form-control"
                                        placeholder="Indonesia" value="{{ old('kenegaraan') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Provinsi *)</label>
                                    <input type="text" id="provinsi" name="provinsi" class="form-control"
                                        value="{{ old('provinsi') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Kabupaten *)</label>
                                    <input type="text" id="kabupaten" name="kabupaten" class="form-control"
                                        value="{{ old('kabupaten') }}" />
                                </div>
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Kecamatan *)</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                        value="{{ old('kecamatan') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Kota *)</label>
                                    <input type="text" id="kota" name="kota" class="form-control"
                                        value="{{ old('kota') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Kodepos *)</label>
                                    <input type="number" id="kodepos" name="kodepos" class="form-control"
                                        value="{{ old('kodepos') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Alamat *)</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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
@foreach ($user as $data)
    <div id="modalFormEdit{{ $data->id_users }}" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{ url('User/' . $data->id_users) }}" class="modal-content" method="post">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $data->id_users }}" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle" data-original-title="Tambah">Tambah
                        {{ $title }}</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="nav-align-top mb-0">
                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-edit-user{{ $data->id_users }}"
                                    aria-controls="navs-pills-user" aria-selected="true">User</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-edit-alamat{{ $data->id_users }}"
                                    aria-controls="navs-pills-alamat" aria-selected="false">Alamat</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="navs-pills-edit-user{{ $data->id_users }}"
                                role="tabpanel">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Nama Lengkap *)</label>
                                        <input type="text" id="nama" name="nama" class="form-control"
                                            placeholder="Nama Lengkap" value="{{ $data->nama }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="emailBackdrop" class="form-label">Email *)</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="****@gmail.com" value="{{ $data->email }}" />
                                    </div>
                                    <div class="col mb-3">
                                        <label for="emailBackdrop" class="form-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="********" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="emailBackdrop" class="form-label">Tanggal Lahir *)
                                            <span class="badge badge-center rounded-pill bg-primary ms-1"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title=""
                                                data-bs-original-title="<span>Perusahaan diisi tanggal berdirinya</span>"><i
                                                    class='bx bx-question-mark'>
                                                </i>
                                            </span>
                                        </label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                            class="form-control" value="{{ $data->tgl_lahir }}" />
                                    </div>
                                    <div class="col mb-33">
                                        <label for="emailBackdrop" class="form-label">Tempat Lahir *)
                                            <span class="badge badge-center rounded-pill bg-primary ms-1"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title=""
                                                data-bs-original-title="<span>Perusahaan diisi tempat berdirinya</span>"><i
                                                    class='bx bx-question-mark'>
                                                </i>
                                            </span>
                                        </label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir"
                                            class="form-control" placeholder="Sesuai KTP"
                                            value="{{ $data->tempat_lahir }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="emailBackdrop" class="form-label">No Handphone *)</label>
                                        <input type="number" id="no_hp" name="no_hp" class="form-control"
                                            placeholder="08********" value="{{ $data->no_hp }}" />
                                    </div>
                                    <div class="col mb-3">
                                        <label for="dobBackdrop" class="form-label">Kelamin <span
                                                class="badge badge-center rounded-pill bg-primary ms-1"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title=""
                                                data-bs-original-title="<span>Kosongi Jika Perusahaan</span>"><i
                                                    class='bx bx-question-mark'>
                                                </i>
                                            </span></label>
                                        <select id="kelamin" name="kelamin" class="form-select">
                                            <option value="" {{ $data->kelamin == '' ? 'selected' : '' }}>
                                                --- Pilih Jenis Kelamin ---
                                            </option>
                                            <option value="laki-laki"
                                                {{ $data->kelamin == 'laki-laki' ? 'selected' : '' }}>Laki - Laki
                                            </option>
                                            <option value="perampuan"
                                                {{ $data->kelamin == 'perampuan' ? 'selected' : '' }}>Perampuan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="dobBackdrop" class="form-label">Role *)</label>
                                        <select id="role" name="role" class="form-select">
                                            <option value="user" {{ $data->role == 'user' ? 'selected' : '' }}>
                                                User
                                            </option>
                                            <option value="pokja" {{ $data->role == 'pokja' ? 'selected' : '' }}>
                                                Pokja
                                            </option>
                                            <option value="admin" {{ $data->role == 'Admin' ? 'selected' : '' }}>
                                                Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="navs-pills-edit-alamat{{ $data->id_users }}"
                                role="tabpanel">
                                <input type="hidden" name="id_useralamat"
                                    value="{{ $data->userAlamat->id_useralamat }}" />
                                <p> Alamat Perusahaan atau Personal
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Kenegaraan *)</label>
                                        <input type="text" id="kenegaraan" name="kenegaraan" class="form-control"
                                            placeholder="Indonesia" value="{{ $data->userAlamat->kenegaraan }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Provinsi *)</label>
                                        <input type="text" id="provinsi" name="provinsi" class="form-control"
                                            value="{{ $data->userAlamat->provinsi }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Kabupaten *)</label>
                                        <input type="text" id="kabupaten" name="kabupaten" class="form-control"
                                            value="{{ $data->userAlamat->kabupaten }}" />
                                    </div>
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Kecamatan *)</label>
                                        <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                            value="{{ $data->userAlamat->kecamatan }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Kota *)</label>
                                        <input type="text" id="kota" name="kota" class="form-control"
                                            value="{{ $data->userAlamat->kota }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Kodepos *)</label>
                                        <input type="number" id="kodepos" name="kodepos" class="form-control"
                                            value="{{ $data->userAlamat->kodepos }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBackdrop" class="form-label">Alamat *)</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $data->userAlamat->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    {{-- <button type="reset" class="btn btn-outline-danger">
                    Reset
                </button> --}}
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
{{-- End Modal Update --}}
