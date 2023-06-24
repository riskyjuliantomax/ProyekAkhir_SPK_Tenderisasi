@extends('template.master')
@section('content')
    <div class="flex-grow-1 ">
        <h4 class="fw-bold mb-4">
            <span class="text-base fw-light">Info Tentang Tender</span>
        </h4>
        @if (count($infoTender) > 0)
            <form action="{{ url('InfoTender/Update') }}" enctype="multipart/form-data" method="POST">
                @method('PUT')
                @foreach ($infoTender as $data)
                    <input class="form-control" type="hidden" id="id_infoTender" name="id_infoTender"
                        value="{{ $data->id_infoTender }}">
                @endforeach
            @else
                <form action="{{ url('/InfoTender') }}" enctype="multipart/form-data" method="POST">
        @endif
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Tentang Tender</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="nama" class="form-label">Nama Tender</label>

                                <input class="form-control" type="text" id="nama" name="nama" />

                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="harga" class="form-label">Harga Penawaran</label>

                                <input class="form-control" type="number" id="harga" name="harga">

                            </div>
                            <!-- Syarat Tender -->
                            <div class="mb-3 col-md-12">
                                <p class="text-base mb-0">Syarat</p>

                                <textarea id="summernote" name="syarat"></textarea>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $('#summernote').summernote({
            placeholder: 'Masuk Syarat Tender',
            tabsize: 2,
            height: 600
        });
    </script>
@endsection
