@if ($checkDaftarDoubleInsert)
    <div class="alert alert-danger alert-dismissible">
        <ul>
            <li>Kamu Sudah Melakukan Pendaftaran Pengadaan Barang Yang Lain, Harap Tunggu Pengajuan Pengadaan Barang
                Kamu Selesai</li>
            <li>Masing Masing User Hanya Diperbolehkan Daftar 1 Pengadaan Barang</li>
            <li>Untuk Ingin Mengajukan Pengadaan Lain Harap Tunggu Pengadaan Yang Kamu Ajukan Sampai Selesai</li>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </ul>
    </div>
@endif
