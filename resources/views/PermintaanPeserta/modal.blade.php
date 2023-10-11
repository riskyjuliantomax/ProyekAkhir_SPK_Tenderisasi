<!-- Modal Create-->
@foreach ($pendaftaranUser as $data)
    <div id="modalDetail{{ $data->id_pendaftaran_users }}" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{ url('PermintaanPeserta') }}" class="modal-content" method="post">
                @csrf
                <input type="hidden" name="id_pendaftaran_users" value="{{ $data->id_pendaftaran_users }}" />
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
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Nama
                                Perusahaan</label>
                            <div>
                                <label>{{ ucFirst($data->nama_perusahaan) }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class="col-form-label text-light fw-semibold">Email</label>
                            <div>
                                <label>{{ ucFirst($data->email_perusahaan) }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">No
                                Telp</label>
                            <div>
                                <label>{{ ucFirst($data->telp_perusahaan) }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tahun Berdiri
                            </label>
                            <div>
                                <label>{{ $data->tahun_berdiri }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">
                                Harga Penawaran</label>
                            <div>
                                <label>{{ number_format($data->harga_penawaran) }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tanggal
                                Pengajuan</label>
                            <div>
                                <label>{{ ucFirst($data->created_at) }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tanggal
                                Update</label>
                            <div>
                                <label>{{ ucFirst($data->updated_at) }}</label>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <label class="modal-title mb-3" id="modalTitle">Detail Akun Pengajuan</label>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Nama
                                Lengkap</label>
                            <div>
                                <label>{{ $data->user->nama }}<br>
                            </div>
                        </div>
                        <div class="col">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Email
                                User</label>
                            <div>
                                <label>{{ $data->user->email }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Lampiran
                                Dokumen</label>
                            <div>
                                <a class="overflow-hidden"
                                    href="{{ url('ViewPDF/' . $data->id_pendaftaran_users) }}"target="_blank">{{ $data->dokumen_perusahaan }}</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="html5-text-input"
                                class=" col-form-label text-light fw-semibold">Persetujuan</label>
                            <select name="approve" class="form-select">
                                <option value="0" @if ($data->approve == 0) selected @endif>Proses
                                </option>
                                <option value='1' @if ($data->approve == 1) selected @endif>Tidak
                                    Terima</option>
                                <option value='2' @if ($data->approve == 2) selected @endif>Terima
                                </option>
                            </select>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Create --}}
@endforeach
