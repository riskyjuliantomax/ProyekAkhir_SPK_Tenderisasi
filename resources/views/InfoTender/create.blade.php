@extends('template.master')
@section('content')
    {{-- {{ Breadcrumbs::render('perusahaan') }} --}}
    InfoTender <br />
    <a href="{{ url('InfoTender') }}" class="btn btn-primary my-2">
        Kembali
    </a>
    {{-- Check for error and session --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </ul>
        </div>
    @endif
    {{-- End Check --}}
    <div class="card">
        <!-- Button trigger modal -->
        <div class="ms-4 mt-3 mb-1">
            <!-- Button trigger modal -->
            {{-- <a href="{{ url('InfoTender/create') }}" class="btn btn-primary">
                Tambah {{ $title }}
            </a> --}}
            <div class="float-end me-4">
                <form action="Perusahaan" method="GET">
                    <div class="input-group input-group-merge">

                        <input type="text" class="form-control" placeholder="Cari Nama Perusahaan"
                            aria-label="Cari Nama User" aria-describedby="basic-addon-search31" name="search"
                            style='width:260px'>
                        <button type="Submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Tambah Informasi Tender</h5>
            <hr class="my-0">
            <form action="{{ url('InfoTender/store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
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
                            </div>
                            <div class="modal-footer">
                                <a href="{{ url('InfoTender') }}" class="btn btn-secondary my-2">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary float-end">Save</button>
                            </div>
                            <!-- /Account -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
@section('scripts')
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 600
        });
    </script>
@endsection
