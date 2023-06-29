@extends('template.master')
@section('content')
    {{ Breadcrumbs::render('user') }}
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
    <div class="card">
        <!-- Button trigger modal -->
        <div class="ms-4 mt-3 mb-1">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Tambah User
            </button>
            <div class="float-end me-4">
                <form action="User" method="GET">
                    <div class="input-group input-group-merge">

                        <input type="text" class="form-control" placeholder="Cari Nama User / Email / NIP"
                            aria-label="Cari Nama User" aria-describedby="basic-addon-search31" name="search"
                            id="search" style='width:260px' value="{{ old('search') }}">
                        <button type="Submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <caption class="ms-4 mt-1">
                        List {{ $title }}
                        <div class="float-end me-3">
                            {{ $user->onEachSide(3)->links() }}
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th style="width:7%">No</th>
                            <th>@sortablelink('nama', 'Nama')</th>
                            <th>@sortablelink('email', 'Email')</th>
                            <th>@sortablelink('nip', 'Nip')</th>
                            <th>@sortablelink('role', 'Role')</th>
                            <th>@sortablelink('last_login', 'Terakhir Login')</th>
                            <th>@sortablelink('last_logout', 'Terakhir Logout')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $index => $data)
                            <tr>
                                <input type="hidden" class="id_user" value="{{ $data->id_users }}" />
                                <td> {{ $user->firstItem() + $index }} </td>
                                <td>{{ ucFirst($data->nama) }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ ucFirst($data->nip) }}</td>
                                <td>{{ ucFirst($data->role) }}</td>
                                <td>
                                    @if ($data->last_login != null)
                                        {{ \Carbon\Carbon::parse($data->last_login)->diffForHumans() }}
                                    @else
                                        -- --
                                    @endif
                                </td>
                                <td>
                                    @if ($data->last_logout != null)
                                        {{ \Carbon\Carbon::parse($data->last_logout)->diffForHumans() }}
                                    @else
                                        -- --
                                    @endif
                                </td>
                                <td style="width:13%">
                                    <button type="button" class="btn btn-icon btn-info" data-toggle="modal"
                                        data-target="#modalDetail{{ $data->id_users }}">
                                        <span class="tf-icons bx bx-detail"></span>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-primary" data-toggle="modal"
                                        data-target="#modalFormEdit{{ $data->id_users }}">
                                        <span class="tf-icons bx bx-edit-alt"></span>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-danger btn-delete">
                                        <span class="tf-icons bx bx-trash-alt"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
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
@include('User.modal')
@include('User.modalDetail')
@include('User.js')
