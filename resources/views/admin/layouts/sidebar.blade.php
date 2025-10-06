<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand px-4 py-3 m-0"
                href="#" target="_blank">
                <img src="{{ '../../Back-end/' }}assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26"
                    height="26" alt="main_logo">
                <span class="ms-1 text-sm text-dark">Dims Pedia</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                @php
                    $ss = request()->segment(2)
                @endphp
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'dashboard' ? ' active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ '/admin/dashboard' }}">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'users' ? ' active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ '/admin/users' }}">
                        <i class="material-symbols-rounded opacity-5">group</i>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'brands' ? ' active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ '/admin/brands' }}">
                        <i class="material-symbols-rounded opacity-5">
                            branding_watermark
                        </i>
                        <span class="nav-link-text ms-1">Brands</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'games' ? ' active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ '/admin/games' }}">
                        <i class="material-symbols-rounded opacity-5">
                            stadia_controller
                        </i>
                        <span class="nav-link-text ms-1">Games</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'categorys' ? ' active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ '/admin/categorys' }}">
                        <i class="material-symbols-rounded opacity-5">
                            topic
                        </i>
                        <span class="nav-link-text ms-1">Categorys</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'products' ? ' active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ '/admin/products' }}">
                        <i class="material-symbols-rounded opacity-5">
                            local_mall
                        </i>
                        <span class="nav-link-text ms-1">Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'invoices' ? ' active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ '/admin/invoices' }}">
                        <i class="material-symbols-rounded opacity-5">
                            request_quote
                        </i>
                        <span class="nav-link-text ms-1">Invoices</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $ss == 'vouchers' ? ' active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ '/admin/vouchers' }}">
                        <i class="material-symbols-rounded opacity-5">
                            confirmation_number
                        </i>
                        <span class="nav-link-text ms-1">Vouchers</span>
                    </a>
                </li>

            </ul>
        </div>

    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin Panel  </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $ss }}</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav d-flex align-items-center  justify-content-end">


                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
                            </a>
                        </li>

                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ '../../Back-end/' }}pages/sign-in.html"
                                class="nav-link text-body font-weight-bold px-0">
                                <i class="material-symbols-rounded">account_circle</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
