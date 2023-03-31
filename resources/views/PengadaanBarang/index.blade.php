@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('PengadaanBarang') }}
    <div class="card">
        <div class="ms-4 mt-3 mb-2">
            <a href='#' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">Tambah
                Pengadaan</a>
        </div>

        <div class="d-flex flex-wrap">
            <div class="row ms-2 mt-2 mb-2 me-2 ">
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-header">Penambahan </div>
                        <div class="card-body">
                            <h5 class="card-title text-white">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up.</p>
                            <div class="mt-3">
                                <a href='{{ url('Peserta') }}' class="btn btn-dark" data-base-toggle="modal"
                                    data-base-target="#modalForm">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title text-white">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title text-white">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title text-white">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@include('PengadaanBarang.modal')
