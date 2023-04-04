<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title = isset($title) ? $title : '' }}</title>
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

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{!! asset('assets/vendor/js/helpers.js') !!}"></script>

</head>

<body>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Layout wrapper -->


    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('template.sidebar')

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('template.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    {{-- <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank"
                                    class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                            <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4"
                                    target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More
                                    Themes</a>

                                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank" class="footer-link me-4">Documentation</a>

                                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank" class="footer-link me-4">Support</a>
                            </div>
                        </div>
                    </footer> --}}
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- Sweet Alert-->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{!! asset('assets/vendor/libs/jquery/jquery.js') !!}"></script>
    <script src="{!! asset('assets/vendor/libs/popper/popper.js') !!}"></script>
    <script src="{!! asset('assets/vendor/js/bootstrap.js') !!}"></script>
    <script src="{!! asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') !!}"></script>

    <script src="{!! asset('assets/vendor/js/menu.js') !!}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{!! asset('assets/js/main.js') !!}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
</body>

</html>
