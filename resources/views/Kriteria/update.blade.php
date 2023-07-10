@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('kriteria') }}
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
    <!-- Form controls -->
    <div class="row">
        <div class="col-4">
            <div class="card">
                <h5 class="card-header"> {{ $title }}</h5>
                <form action="{{ url('Kriteria/update/' . $kriteria->id_kriteria) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBackdrop" class="form-label">Nama Kriteria</label>
                                <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control"
                                    value="{{ $kriteria->nama_kriteria }}" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailBackdrop" class="form-label">Bobot (%)</label>
                                <input type="number" id="bobot" name="bobot" class="form-control" placeholder="1-100"
                                    value="{{ $kriteria->bobot * 100 }}" />
                            </div>
                            <div class="col mb-0">
                                <label for="dobBackdrop" class="form-label">Attribut</label>
                                <select id="attribut" name="attribut" class="form-select">
                                    <option value="" {{ $kriteria->attribut == '' ? 'selected' : '' }}>Pilih Attribut
                                    </option>
                                    <option value="benefit" {{ $kriteria->attribut == 'benefit' ? 'selected' : '' }}>Benefit
                                    </option>
                                    <option value="cost" {{ $kriteria->attribut == 'cost' ? 'selected' : '' }}>Cost
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ms-4 me-4">
                        <h5 class="fw-bold"> Petunjuk Kriteria </h5>
                        <ul class="list-unstyled" style="text-align: justify;">
                            <li class="mb-1"><b>Kriteria </b> Memiliki 2 Attribut yaitu, Benefit<b> (Keuntungan) </b> Cost
                                <b>(Biaya)</b>
                            </li>
                            <li><b>Benefit (Keuntungan)</b> merujuk pada hasil positif atau manfaat yang diharapkan dari
                                menerapkan suatu alternatif. Benefit <b>(Keuntungan)</b> dapat berupa Keuntungan finansial
                                seperti
                                peningkatan pendapatan atau pengurangan biaya, keuntungan non-finansial seperti peningkatan
                                produktivitas, kepuasan pelanggan
                            </li>
                            <li class="mb-1"><b>Cost (Biaya)</b> mengacu pada jumlah uang atau sumber daya yang diperlukan
                                untuk
                                melaksanakan atau menerapkan suatu alternatif <b>(Peserta)</b>. Cost (Biaya) bisa
                                mencakup biaya
                                langsung, seperti biaya produksi atau akuisisi, biaya operasional
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="reset" class="btn btn-outline-danger">
                    Reset
                </button> --}}
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

@include('Kriteria.js')
