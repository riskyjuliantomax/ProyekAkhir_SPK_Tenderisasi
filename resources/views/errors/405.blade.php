<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found 404</title>
    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="{!! asset('assets/img/favicon/favicon.ico') !!}" /> --}}
    <link rel="icon" type="image/x-icon"
        href="https://cdn.dribbble.com/users/228301/screenshots/1964269/tender_script.jpg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{!! asset('assets/vendor/fonts/boxicons.css') !!}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{!! asset('assets/vendor/css/core.css') !!}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{!! asset('assets/vendor/css/theme-default.css') !!}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{!! asset('assets/css/demo.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/vendor/css/pages/page-misc.css') !!}" />
    <!-- Vendors CSS -->
</head>

<body>
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Halaman Tidak Dapat Di Akses </h2>
            <p class="mb-4 mx-2">Anda Tidak Memiliki Hak Untuk Akses Halaman Ini</p>
            <a href="{{ url('/Dashboard') }}" class="btn btn-primary">Kembali Dashboard</a>

        </div>
    </div>


</body>

</html>
