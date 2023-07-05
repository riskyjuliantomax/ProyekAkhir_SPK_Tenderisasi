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
                <label class="modal-title mb-3 fw-bold" id="modalTitle">Detail Perusahaan</label>
                <div class="col">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Nama
                        Perusahaan</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->nama_perusahaan) }}</label>
                    </div>
                </div>
                <div class="col">
                    <label for="html5-text-input" class="col-form-label text-light fw-semibold">NPWP</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->npwp_perusahaan) }}</label>
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
                    <label for="html5-text-input" class="col-form-label text-light fw-semibold">Email</label>
                    <div>
                        <label>{{ ucFirst($pesertaPengadaan->email_perusahaan) }}</label>
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
                <div class="col-md-6">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">
                        Harga Penawaran</label>
                    <div>
                        <label class="fw-bold text-white bg-info py-1 px-2 ">Rp.
                            {{ number_format($pesertaPengadaan->harga_penawaran) }}</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Alamat
                        Perusahaan</label>
                    <textarea class="form-control" rows="4" style="resize: none;">{{ $pesertaPengadaan->alamat_perusahaan }}</textarea>
                </div>
            </div>
            <hr />
            <label class="modal-title mb-3 fw-bold" id="modalTitle">Detail Akun Pengajuan</label>
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
                @if ($pesertaPengadaan->infoTender->status == 0 || $pesertaPengadaan->approve == 0)
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
                @elseif ($pesertaPengadaan->infoTender->status > 0 || $pesertaPengadaan->approve != 0)
                    <div class="col-sm-2">
                        <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Persetujuan</label>
                        <select name="approve" class="form-select border-1 border-primary" disabled>
                            <option value="0" @if ($pesertaPengadaan->approve == 0) selected @endif>Proses
                            </option>
                            <option value='1' @if ($pesertaPengadaan->approve == 1) selected @endif>Tidak
                                Terima</option>
                            <option value='2' @if ($pesertaPengadaan->approve == 2) selected @endif>Terima
                            </option>
                        </select>
                    </div>
                @endif
            </div>
            <hr />
            <label class="modal-title mb-3 fw-bold" id="modalTitle">Lampiran</label>
            <div class="col-md-12">
                <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Lampiran
                    Dokumen Penawaran</label>
                <div>
                    @if (!$pesertaPengadaan->dokumen_penawaran)
                        Tidak Dilampirkan
                    @else
                        <a class="overflow-hidden"
                            href="{{ url('ViewPDF/' . $pesertaPengadaan->dokumen_penawaran) }}"target="_blank">
                            {{ $pesertaPengadaan->dokumen_penawaran }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Lampiran
                    Dokumen Akta Perusahaan</label>
                <div>
                    @if (!$pesertaPengadaan->dokumen_akta)
                        Tidak Dilampirkan
                    @else
                        <a class="overflow-hidden"
                            href="{{ url('ViewPDF/' . $pesertaPengadaan->dokumen_akta) }}"target="_blank">
                            {{ $pesertaPengadaan->dokumen_akta }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <label for="html5-text-input" class=" col-form-label text-light fw-semibold">Lampiran
                    Dokumen Administrasi</label>
                <div>
                    @if (!$pesertaPengadaan->dokumen_legalitas)
                        Tidak Dilampirkan
                    @else
                        <a class="overflow-hidden"
                            href="{{ url('ViewPDF/' . $pesertaPengadaan->dokumen_legalitas) }}"target="_blank">
                            {{ $pesertaPengadaan->dokumen_legalitas }}
                        </a>
                    @endif
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

    {{-- End Modal Create --}}
@endsection
