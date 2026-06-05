<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('admin_template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body id="page-top">

    <script>
        if (localStorage.getItem('sidebarState') === 'toggled') {
            document.body.classList.add('sidebar-toggled');
        }
    </script>

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion min-vh-100" id="accordionSidebar">

            <script>
                if (localStorage.getItem('sidebarState') === 'toggled') {
                    document.getElementById('accordionSidebar').classList.add('toggled');
                }
            </script>

            <a class="sidebar-brand d-flex align-items-center justify-content-center text-decoration-none text-white mt-2 mb-2"
                href="{{ route('admin.home') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('images/resources/sate_kuu.png') }}" alt="Sate Kuu Logo"
                        class="rounded-circle shadow-sm bg-white p-1"
                        style="width: 45px; height: 45px; object-fit: cover;">
                </div>
                <div class="sidebar-brand-text mx-3 fs-5 fw-bold tracking-wide">
                    Sate Kuu
                </div>
            </a>

            <hr class="sidebar-divider my-0">
            <div hidden>{{ $route = request()->route()->getName() }}</div>

            <li class="nav-item @if ($route === 'admin.home') active @endif">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item @if ($route === 'admin.categories') active @endif">
                <a class="nav-link" href="{{ route('admin.categories') }}">
                    <i class="fa-solid fa-fw fa-circle-plus"></i>
                    <span>Category</span>
                </a>
            </li>

            <li class="nav-item @if ($route === 'admin.products.add') active @endif">
                <a class="nav-link" href="{{ route('admin.products.add') }}">
                    <i class="fa-solid fa-fw fa-plus"></i>
                    <span>Add Products</span>
                </a>
            </li>

            <li class="nav-item @if (in_array($route, ['admin.products', 'admin.products.edit', 'admin.products.view'])) active @endif">
                <a class="nav-link" href="{{ route('admin.products') }}">
                    <i class="fa-solid fa-fw fa-layer-group"></i>
                    <span>Product List</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-fw fa-credit-card"></i>
                    <span>Payment Method</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-fw fa-list"></i>
                    <span>Sale Information</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-fw fa-cart-shopping"></i>
                    <span>Order Board</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-fw fa-lock"></i>
                    <span>Change Password</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <div class="mt-auto p-3 w-100">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark text-white btn-block w-100 shadow-sm">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                    </button>
                </form>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name ?? 'Admin' }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('admin_template/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Add New Admin Account
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin List
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User List
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post" class="px-2">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold rounded">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    @yield('content')
                </div>
                </div>
            <footer class="sticky-footer bg-white mt-auto">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sate Kuu 2024</span>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    <script src="{{ asset('admin_template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin_template/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#sidebarToggle, #sidebarToggleTop').on('click', function(e) {
                setTimeout(function() {
                    if ($('.sidebar').hasClass('toggled')) {
                        localStorage.setItem('sidebarState', 'toggled');
                    } else {
                        localStorage.setItem('sidebarState', 'expanded');
                    }
                }, 100);
            });
        });
    </script>

    @yield('script')

</body>
</html>
