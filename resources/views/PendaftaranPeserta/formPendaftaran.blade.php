<div class="row">
    <div class="mb-3 col-md-12">
        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
        <input type="text" class="form-control " id="nama_perusahaan" name="nama_perusahaan" placeholder="PT.XXX XXXXX"
            value="" />
    </div>
    <div class="mb-3 col-md-12">
        <label for="nama_perusahaan" class="form-label">Harga Penawaran <small class="text-muted">tanpa
                berkoma</small></label></label>
        <input type="number" class="form-control " id="harga_penawaran" name="harga_penawaran" placeholder="XXXXXXXX"
            value="{{ old('harga_penawaran') }}" />
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
        <input type="number" class="form-control " id="tahun_berdiri" name="tahun_berdiri" placeholder="1990"
            value="{{ old('tahun_berdiri') }}" />
    </div>
    <div class="mb-3 col-md-6">
        <label for="telp_perusahaan" class="form-label">Telp Perusahaan</label>
        <input type="text" class="form-control " id="telp_perusahaan" name="telp_perusahaan" placeholder="xxxxxxxxx"
            value="{{ old('telp_perusahaan') }}" />

    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label for="nama_kontak" class="form-label">Nama Bisa Di Kontak</label>
        <input type="text" class="form-control " id="nama_kontak" name="nama_kontak"
            placeholder="xxxxx"value="{{ old('nama_kontak') }}" />
    </div>
    <div class="mb-3 col-md-6">
        <label for="email_perusahaan" class="form-label">Email Perusahaan</label>
        <input type="text" class="form-control " id="email_perusahaan" name="email_perusahaan"
            placeholder="xxxxx@xxxx.com" value="{{ old('email_perusahaan') }}" />

    </div>
</div>
<div class="col-md-12 mb-3">
    <label for="nama" class="form-label">Alamat Perusahaan</label>
    <textarea class="form-control" rows="5" style="resize: none" name="alamat_perusahaan" id="alamat_perusahaan"
        value="{{ old('alamat_perusahaan') }}"></textarea>
</div>
<div class="col-md-5">
    <label for="dokumen_perusahaan" class="form-label">Lampiran <small class="text-muted">
            Hanya PDF</small></label>
    <input type="file" class="form-control" name="dokumen_perusahaan" id="dokumen_perusahaan"
        accept="application/pdf" />
</div>
<div class="col-md-12 mb-3">
    <button type="submit" class="btn btn-primary float-end mb-4">Submit </button>
</div>
