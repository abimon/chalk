<title>Health & Life Center</title>
<!-- Custom CSS -->
<link href="{{asset('storage/plugins/bower_components/chartist/dist/chartist.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('storage/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}">
<!-- Custom CSS -->
<link href="{{asset('storage/css/style.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin6">
                <a class="navbar-brand" href="/" target="_blank">
                    <span class="logo-text">
                        <b class="text-dark">Home</b>
                    </span>
                </a>
                <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class=" in">
                        <form role="search" class="app-search d-none d-md-block me-3">
                            <input type="text" placeholder="Search..." class="form-control mt-0">
                            <a href="" class="active">
                                <i class="fa fa-search"></i>
                            </a>
                        </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="#">
                            <i class="fa fa-user"></i>
                            <span class="text-white font-medium"> {{Auth()->user()->name}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item pt-2">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard" aria-expanded="false">
                            <i class="far fa-clock" aria-hidden="true"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('order.index')}}" aria-expanded="false">
                            <i class="fa fa-gifts" aria-hidden="true"></i>
                            <span class="hide-menu">Orders</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user/index" aria-expanded="false">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('product.index')}}" aria-expanded="false">
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span class="hide-menu">Products</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('article.index')}}" aria-expanded="false">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="hide-menu">Articles</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/profile" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="hide-menu">Profile</span>
                        </a>
                    </li>
                    <li class="text-center p-20 upgrade-btn">
                        <a href="/logout" class="btn d-grid btn-danger text-white">
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper">
        @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @yield('content')
        <footer class="footer text-center"> {{date('Y')}} © Health & Life Center <a href="https://apekinc.top/">APEK INC</a>
        </footer>
    </div>
</div>
<script src="{{asset('storage/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('storage/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('storage/js/app-style-switcher.js')}}"></script>
<script src="{{asset('storage/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('storage/js/waves.js')}}"></script>
<script src="{{asset('storage/js/sidebarmenu.js')}}"></script>
<script src="{{asset('storage/js/custom.js')}}"></script>
<script src="{{asset('storage/plugins/bower_components/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('storage/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('storage/js/pages/dashboards/dashboard1.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>