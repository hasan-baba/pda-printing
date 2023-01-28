<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/jpg" href="{{asset('/assets/img/invoice-1.png')}}"/>

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{asset('/assets/css/admin-style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/invoice.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>@yield('title')</title>
    <link href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/buttons.dataTables.min.css')}}">
</head>
<body>
<nav>
    <div class="logo-name">
        <a href="/admin" class="d-flex align-items-center">
            <div class="logo-image">
                <img src="{{asset('/assets/img/invoice-1.png')}}" alt="">
            </div>

            <span class="logo_name">ProformaDA</span>
        </a>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li>
                <a href="/admin">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a>
            </li>
            <li>
                <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="has-submenu list-group-item-action">
                    <i class="uil uil-ship"></i>
                    <span class="link-name">Trips</span>
                </a>
            </li>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="/admin/trip" class="list-group-item list-group-item-action">
                    <span class="menu-collapsed">All Trips</span>
                </a>
                <a href="/admin/trip/add" class="list-group-item list-group-item-action">
                    <span class="menu-collapsed">Add New</span>
                </a>
            </div>
            <li>
                <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="has-submenu list-group-item-action">
                    <i class="uil uil-invoice"></i>
                    <span class="link-name">Enquiries</span>
                </a>
            </li>
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="/admin/enquiry" class="list-group-item list-group-item-action">
                    <span class="menu-collapsed">International Enquiry</span>
                </a>
                <a href="/admin/lb-enquiry" class="list-group-item list-group-item-action">
                    <span class="menu-collapsed">Lebanese Enquiry</span>
                </a>
            </div>
            <li>
                <a href="/admin/report">
                    <i class="uil uil-file-graph"></i>
                    <span class="link-name">Reports</span>
                </a>
            </li>
            <li>
                <a href="/admin/setting">
                    <i class="uil uil-cog"></i>
                    <span class="link-name">Settings</span>
                </a>
            </li>
            <li>
                <a href="/admin/user">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Users</span>
                </a>
            </li>
        </ul>

        <ul class="logout-mode">
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>

<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/img/profile.png') }}" alt="">
            <p class="mb-0 ml-2">{{ Auth::user()->name }}</p>
        </div>
    </div>
    @yield('content')
</section>
<script src="{{ asset('/assets/bootstrap/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{asset('/assets/js/sweetalert.min.js')}}"></script>
<script src="{{asset('/assets/js/datatables.min.js')}}"></script>
<script src="{{asset('/assets/js/dateTime.min.js')}}"></script>
<script src="{{asset('/assets/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/assets/js/jszip.min.js')}}"></script>
<script src="{{asset('/assets/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/assets/js/pdfmake.min.js')}}"></script>
<script src="{{asset('/assets/js/vfs_fonts.js')}}"></script>
<script src="{{asset('/assets/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/assets/js/admin.js')}}"></script>
<script src="{{asset('/assets/js/trip.js')}}"></script>
<script src="{{asset('/assets/js/setting.js')}}"></script>
<script src="{{asset('/assets/js/enquiry.js')}}"></script>
<script src="{{asset('/assets/js/invoice.js')}}"></script>
@yield('custom-enq-js')
</body>
</html>
