<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <title>Sistem Informasi Inventory Control</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/darktheme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/neptune.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/neptune.png') }}" />

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">


</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <a href="#" class="logo-icon"><span class="logo-text">Inventory Control</span></a>
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="#">
                        <img src="{{ asset('assets/images/avatars/avatar.png') }}">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text">{{ Auth::user()->name }}<br><span class="user-state-info">
                                @if (Auth::user()->level == 'admin')
                                    Administrator
                                @elseif (Auth::user()->level == 'supervisor')
                                    Supervisor
                                @elseif (Auth::user()->level == 'staff')
                                    Staff
                                @endif
                            </span></span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Apps
                    </li>
                    @if (Auth::user()->level == 'admin')
                        <li class="@yield('active_dashboard')">
                            <a href="{{ route('admin.dashboard') }}"><i
                                    class="material-icons-two-tone">inbox</i>Dashboard</a>
                        </li>
                        <li class="@yield('active_product')">
                            <a href=""><i class="material-icons-two-tone">inventory_2</i>Product<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.product') }}">Product</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.product-add') }}">Add Product</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.category') }}">Kategori</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.unit') }}">Satuan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@yield('active_stock')">
                            <a href="{{ route('admin.stock') }}"><i
                                    class="material-icons-two-tone">inventory</i>Stock</a>
                        </li>
                        <li class="@yield('active_addReport')">
                            <a href=""><i class="material-icons-two-tone">summarize</i>Add Report<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.add.report.masuk') }}">Barang Masuk</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.add.report.keluar') }}">Barang Keluar</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.transfer.stock.create') }}">Transfer Stock</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.stock.opname.create') }}">Stock Opname</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@yield('active_report')">
                            <a href=""><i class="material-icons-two-tone">summarize</i>Report<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.report.masuk') }}">History Barang Masuk</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.report.keluar') }}">History Barang Keluar</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.report.surat.jalan') }}">History Surat Jalan</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.transfer.stock') }}">History Transfer Stock</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.stock.opname') }}">History Opname</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">
                            Additional Data
                        </li>
                        <li class="@yield('active_gudang')">
                            <a href="{{ route('admin.gudang') }}"><i
                                    class="material-icons-two-tone">factory</i>Gudang</a>
                        </li>
                        {{-- <li class="@yield('active_driver')">
                            <a href="{{ route('admin.driver') }}"><i
                                    class="material-icons-two-tone">local_shipping</i>Driver</a>
                        </li>
                        <li class="@yield('active_supplier')">
                            <a href="{{ route('admin.supplier') }}"><i
                                    class="material-icons-two-tone">groups</i>Supplier</a>
                        </li> --}}
                        <li class="@yield('active_konsumen')">
                            <a href="{{ route('admin.konsumen') }}"><i
                                    class="material-icons-two-tone">person</i>Konsumen</a>
                        </li>
                        <li class="sidebar-title">
                            Account
                        </li>

                        <li class="@yield('active_account')">
                            <a href=""><i class="material-icons-two-tone">person_add</i>Account<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.account.add') }}">Add Account</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.account.admin') }}">Admin</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.account.supervisor') }}">Supervisor</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.account.staff') }}">Staff</a>
                                </li>
                            </ul>
                        </li>
                    @elseif (Auth::user()->level == 'supervisor')
                        <li class="@yield('active_dashboard')">
                            <a href="{{ route('supervisor.dashboard') }}"><i
                                    class="material-icons-two-tone">inbox</i>Dashboard</a>
                        </li>
                        <li class="@yield('active_product')">
                            <a href=""><i class="material-icons-two-tone">inventory_2</i>Product<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('supervisor.product') }}">Product</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.category') }}">Kategori</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.unit') }}">Satuan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@yield('active_stock')">
                            <a href="{{ route('supervisor.stock') }}"><i
                                    class="material-icons-two-tone">inventory</i>Stock</a>
                        </li>
                        <li class="@yield('active_report')">
                            <a href=""><i class="material-icons-two-tone">summarize</i>Report<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('supervisor.report.masuk') }}">History Barang Masuk</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.report.keluar') }}">History Barang Keluar</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.report.surat.jalan') }}">History Surat Jalan</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.transfer.stock') }}">History Transfer Stock</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.stock.opname') }}">History Opname</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">
                            Additional Data
                        </li>
                        <li class="@yield('active_gudang')">
                            <a href="{{ route('supervisor.gudang') }}"><i
                                    class="material-icons-two-tone">factory</i>Gudang</a>
                        </li>
                        {{-- <li class="@yield('active_driver')">
                            <a href="{{ route('supervisor.driver') }}"><i
                                    class="material-icons-two-tone">local_shipping</i>Driver</a>
                        </li>
                        <li class="@yield('active_supplier')">
                            <a href="{{ route('supervisor.supplier') }}"><i
                                    class="material-icons-two-tone">groups</i>Supplier</a>
                        </li> --}}
                        <li class="@yield('active_konsumen')">
                            <a href="{{ route('supervisor.konsumen') }}"><i
                                    class="material-icons-two-tone">person</i>Konsumen</a>
                        </li>
                        <li class="sidebar-title">
                            Account
                        </li>

                        <li class="@yield('active_account')">
                            <a href=""><i class="material-icons-two-tone">person_add</i>Account<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('supervisor.account.supervisor') }}">Supervisor</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.account.staff') }}">Staff</a>
                                </li>
                            </ul>
                        </li>
                    @elseif (Auth::user()->level == 'staff')
                        <li class="@yield('active_dashboard')">
                            <a href="{{ route('staff.dashboard') }}"><i
                                    class="material-icons-two-tone">inbox</i>Dashboard</a>
                        </li>
                        <li class="@yield('active_addReport')">
                            <a href="{{ route('staff.add.report.keluar') }}"><i
                                    class="material-icons-two-tone">summarize</i>Add Report Keluar</a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
        <div class="app-container">
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="navbar-nav" id="navbarNav">
                            <ul class="navbar-nav">

                            </ul>

                        </div>
                        <div class="d-flex">
                            <ul class="navbar-nav">

                                <li class="nav-item hidden-on-mobile">
                                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="app-content">
                <div class="content-wrapper">

                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-custom" role="alert">
                                <div class="custom-alert-icon icon-primary"><i
                                        class="material-icons-outlined">done</i>
                                </div>
                                <div class="alert-content">
                                    <span class="alert-title">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-custom" role="alert">
                                <div class="custom-alert-icon icon-warning"><i
                                        class="material-icons-outlined">error</i>
                                </div>
                                <div class="alert-content">
                                    <span class="alert-title">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-custom" role="alert">
                                <div class="custom-alert-icon icon-warning"><i
                                        class="material-icons-outlined">error</i>
                                </div>
                                <div class="alert-content">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Javascripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>

    @yield('script')
</body>

</html>

