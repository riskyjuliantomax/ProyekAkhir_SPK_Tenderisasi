@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('crips') }}
    <a href="{{ url('/Kriteria/Crips/' . $crips->id_kriteria) }}" class="btn btn-primary mb-2">
        <span class='bx bx-arrow-back'></span>
        Back </a>
    {{-- Check for error and session --}} @if ($errors->any())
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
    <!-- Form controls -->
    <div class="row">
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <form action="{{ url('Kriteria/Crips/update/' . $crips->id_crips) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBackdrop" class="form-label">Nama Crips</label>
                                <input type="text" id="nama_crips" name="nama_crips" class="form-control"
                                    value="{{ $crips->nama_crips }}" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailBackdrop" class="form-label">Nilai</label>
                                <input type="number" id="nilai" name="nilai" class="form-control"
                                    placeholder="Masuki Berupa Angka" value="{{ $crips->nilai }}" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal --}}
@endsection()
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

{{-- @include('Crips.modal') --}}
@include('Crips.js')
