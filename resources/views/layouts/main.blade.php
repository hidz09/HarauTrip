<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | Dashboard</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=optional">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">

    {{-- AdminLTE --}}
    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{-- Tempusdominus --}}
    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    {{-- iCheck --}}
    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    {{-- DataTables --}}
    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    @stack('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        {{-- Navbar --}}
        <x-navbar />

        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Content Wrapper --}}
        <div class="content-wrapper">

            {{-- Content Header --}}
            <section class="content-header">

                <div class="container-fluid">

                    <div class="row mb-2">

                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>

                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-right">

                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    @yield('title')
                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </section>

            {{-- Main Content --}}
            <section class="content">

                <div class="container-fluid">

                    @yield('content')

                </div>

            </section>

        </div>

        {{-- Footer --}}
        <footer class="main-footer">

            <strong>
                Copyright &copy; 2026
                <a href="https://adminlte.io" target="_blank" rel="noopener">
                    AdminLTE
                </a>.
            </strong>

            All rights reserved.

            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>

        </footer>

        {{-- Control Sidebar --}}
        <aside class="control-sidebar control-sidebar-dark"></aside>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    {{-- jQuery --}}
    <script src="{{ asset('assets/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>

    {{-- jQuery UI --}}
    <script src="{{ asset('assets/AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    {{-- Bootstrap --}}
    <script src="{{ asset('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- AdminLTE --}}
    <script src="{{ asset('assets/AdminLTE/dist/js/adminlte.min.js') }}"></script>

    {{-- Overlay Scrollbars --}}
    <script src="{{ asset('assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>


    {{-- ========================================================= --}}
    {{-- DATATABLES --}}
    {{-- ========================================================= --}}

    @if(request()->is('destination*') ||
        request()->is('booking*') ||
        request()->is('payment*') ||
        request()->is('tour-package*'))

        <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/jszip/jszip.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

        <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script>
            $(function () {

                if ($("#example1").length) {

                    $("#example1").DataTable({
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        buttons: [
                            "copy",
                            "csv",
                            "excel",
                            "pdf",
                            "print",
                            "colvis"
                        ]
                    }).buttons().container()
                        .appendTo('#example1_wrapper .col-md-6:eq(0)');

                }

                if ($("#example2").length) {

                    $("#example2").DataTable({
                        paging: true,
                        lengthChange: false,
                        searching: false,
                        ordering: true,
                        info: true,
                        autoWidth: false,
                        responsive: true
                    });

                }

            });
        </script>

    @endif


    {{-- Page Specific JS --}}
    @stack('js')

</body>

</html>