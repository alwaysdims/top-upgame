<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ '../../Back-end/' }}assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ '../../Back-end/' }}assets/img/favicon.png">
    <title>
        @yield('title', 'Dashboard') | Admin Panel
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ '../../Back-end/' }}assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ '../../Back-end/' }}assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ '../../Back-end/' }}assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('admin.layouts.sidebar')
        <!-- End Navbar -->
        <div class="container-fluid py-2">

            @yield('content')

            <footer class="footer py-4">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())

                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="#" class="font-weight-bold" target="_blank">Dims.Dev</a>

                            </div>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </main>

    @include('admin.layouts.footer')
</body>

</html>
