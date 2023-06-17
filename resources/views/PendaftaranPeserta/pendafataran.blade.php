<div class="row">
    <div class="mb-3 col-md-12">
        <label for="nama" class="form-label">Nama Tender</label>
        @foreach ($infoTender as $data)
            <div class="form-control">
                {{ $data->nama_infoTender }}
            </div>
        @endforeach
    </div>
    <div class="mb-3 col-md-12">
        <label for="harga" class="form-label">Harga Penawaran</label>
        @foreach ($infoTender as $data)
            <div class="form-control">
                {{ number_format($data->harga_infoTender) }}
            </div>
        @endforeach
    </div>
    <!-- Syarat Tender -->
    <div class="mb-3 col-md-12">
        <p class="text-base mb-0">Syarat</p>
        @foreach ($infoTender as $data)
            {{-- Print Langsung tanpa Summernote --}}
            <div class="form-control">
                {!! $data->syarat_infoTender !!}
            </div>
        @endforeach
    </div>
</div>
