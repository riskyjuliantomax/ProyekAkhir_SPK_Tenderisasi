@extends('template.master')
@section('content')
    @foreach ($user as $data)
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Pengaturan Akun/</span> Akun
            </h4>
            <form action="{{ url('/Profile/Update/') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills flex-column flex-md-row mb-3">
                            <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                                        class="bx bx-user me-1"></i>
                                    Akun</a></li>
                        </ul>
                        <div class="card mb-4">
                            <h5 class="card-header">Detail Profile</h5>
                            <!-- Account -->
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if ($data->img_profile)
                                        <img src=" {{ asset('storage/photoProfileUser/' . $data->img_profile) }} "
                                            id="img_profile" alt class="d-block rounded" height="100" width="100" />
                                    @else
                                        <img src=" {{ asset('assets/img/default_user.jpg') }} "id="img_profile" alt
                                            class="d-block rounded" height="100" width="100" />
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="photoFile" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="photoFile" name="photoFile" class="account-file-input"
                                                onchange="loadFile(event)" hidden accept="image/png, image/jpeg">
                                        </label>
                                        <p class="text-muted mb-0">Hanya File Tipe JPG, PNG.<br> Maksimal Ukuran File 1Mb
                                        </p>
                                    </div>
                                    <div class="col mx-5">
                                        <p class="text-base mb-0">Tentang Anda</p>
                                        <textarea class="form-control" name="tentang" id="tentang" rows="3" style="resize: none">{{ $data->tentang }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input class="form-control" type="text" id="nama" name="nama"
                                            value="{{ $data->nama }}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ $data->email }}" placeholder="{{ $data->email }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="nip" class="form-label">Nip</label>
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            value="{{ $data->nip }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="no_hp">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">ID (+62)</span>
                                            <input type="text" id="no_hp" name="no_hp" class="form-control"
                                                value="{{ $data->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" id="kelamin" name="kelamin">\
                                            <option value="" {{ $data->kelamin == '' ? 'selected' : '' }}>
                                                --- Pilih Jenis Kelamin ---
                                            </option>
                                            <option value="laki-laki"
                                                {{ $data->kelamin == 'laki-laki' ? 'selected' : '' }}>Laki - Laki
                                            </option>
                                            <option value="perempuan"
                                                {{ $data->kelamin == 'perempuan' ? 'selected' : '' }}>Perampuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input class="form-control" type="text" id="tempat_lahir" name="tempat_lahir"
                                            value="{{ $data->tempat_lahir }}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir"
                                            name="tanggal_lahir" value="{{ $data->tgl_lahir }}">
                                    </div>
                                    <h5 class="header mt-3">Detail Alamat</h5>
                                    <div class="mb-3 col-md-6">
                                        <label for="provinsi" class="form-label">Pronvinsi</label>
                                        <input type="text" class="form-control" id="provinsi" name="provinsi"
                                            value="{{ $data->userAlamat->provinsi }}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="kabupaten" class="form-label">Kabupaten</label>
                                        <input type="text" class="form-control" id="kabupaten" name="kabupaten"
                                            value="{{ $data->userAlamat->kabupaten }}">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="kecamatan" class="form-label">kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            value="{{ $data->userAlamat->kecamatan }}">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="kota" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota" name="kota"
                                            value="{{ $data->userAlamat->kota }}">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="kodepos" class="form-label">Kodepos</label>
                                        <input type="number" class="form-control" id="kodepos" name="kodepos"
                                            value="{{ $data->userAlamat->kodepos }}">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="4" style="resize: none">{{ $data->userAlamat->alamat }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Simpan</button>
                            </div>
                            <!-- /Account -->
                        </div>
                        <div class="card">
                            <h5 class="card-header">Ganti Password</h5>
                            <div class="card-body">
                                <div id="formAccountDeactivation" onsubmit="return false">
                                    <a href="{{ url('/GantiPassword') }}" class="btn btn-danger deactivate-account">Ganti
                                        Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
@endsection
