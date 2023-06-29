@extends('template.master')
@section('content')
    <a href="{{ url('PengadaanBerjalan/Detail/' . $pesertaPengadaan->id_infoTender) }}" class="btn btn-primary mb-2">
        Kembali</a>
    <form action="{{ url('PengadaanBerjalan/UpdatePeserta/' . $pesertaPengadaan->id_infoTender) }}" class="card"
        method="post">
        @csrf
        <input type="hidden" name="id_pendaftaran_users" value="{{ $pesertaPengadaan->id_pendaftaran_users }}" />
        <div class="modal-body">
            <div class="row mb-2">
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Nama
                        Perusahaan</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->nama_perusahaan) }}</label>
                    </div>
                </div>
                <div class="col">
                    <label for="html5-text-input" class="col-form-label text-light fw-semibold">Email</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->email_perusahaan) }}</label>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">No
                        Telp</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->telp_perusahaan) }}</label>
                    </div>
                </div>
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tahun Berdiri
                    </label>
                    <div>
                        <label>{{ $pesertaPengadaan->tahun_berdiri }}</label>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tanggal
                        Pengajuan</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->created_at) }}</label>
                    </div>
                </div>
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Tanggal
                        Update</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->updated_at) }}</label>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">
                        Harga Penawaran</label>
                    <div>
                        <label class="fw-bold text-white bg-info py-1 px-2 ">Rp.
                            {{ number_format($pesertaPengadaan->harga_penawaran) }}</label>
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
                        <label>{{ $pesertaPengadaan->user->nama }}<br>
                    </div>
                </div>
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Email
                        User</label>
                    <div>
                        <label>{{ $pesertaPengadaan->user->email }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Lampiran
                        Dokumen</label>
                    <div>
                        @if (!$pesertaPengadaan->dokumen_perusahaan)
                            Tidak Dilampirkan
                        @else
                            <a class="overflow-hidden"
                                href="{{ url('ViewPDF/' . $pesertaPengadaan->id_pendaftaran_users) }}"target="_blank">
                                {{ $pesertaPengadaan->dokumen_perusahaan }}
                            </a>
                        @endif
                    </div>
                </div>
                {{-- @if ($pesertaPengadaan->approve == 0 || $pesertaPengadaan->approve == 1) --}}
                <div class="col-sm-2">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Persetujuan</label>
                    <select name="approve" class="form-select border-1 border-primary">
                        <option value="0" @if ($pesertaPengadaan->approve == 0) selected @endif>Proses
                        </option>
                        <option value='1' @if ($pesertaPengadaan->approve == 1) selected @endif>Tidak
                            Terima</option>
                        <option value='2' @if ($pesertaPengadaan->approve == 2) selected @endif>Terima
                        </option>
                    </select>
                </div>
                {{-- @endif --}}
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

    {{-- End Modal Create --}}
@endsection
