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
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{!! asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/vendor/libs/apex-charts/apex-charts.css') !!}" />
</head>

<body>
    <div class=" mt-5 pt-5">
        <div class="text-center">
            <h2 class="display-1" style="color:#f1828d">404</h2>
            <p class="display-5">Oops! Something is wrong.</p>
            <a href="{{ url('Dashboard') }}" class="btn btn-danger">Kembali Dashboard</a>
        </div>
    </div>
</body>

</html>
