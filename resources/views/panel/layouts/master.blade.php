<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <link rel="stylesheet" href="/date/persian-datepicker.min.css"/>
    <script src="/date/jquery-1.12.0.min.js"></script>
    <script src="/date/persian-date.min.js"></script>
    <script src="/date/persian-datepicker.min.js"></script>
    <title>پنل مدیریت - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="images/logo.png" rel="shortcut icon"/>
{!! SEO::generate(true) !!}
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" src_type="url"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <title>{{ getOption('site_information.website_name',config('settings.website_name')) .' | ' . 'پنل مدیریت' }}</title> --}}

<!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/persianfonts.css') }}" rel="stylesheet">
    @yield('head')
    @toastr_css
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fad fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('home')}}" class="nav-link text-nowrap">مشاهده وبسایت</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->


        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-danger" title="خروج" href=""
                   onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
                    <i class="fad fa-power-off"></i>
                </a>

                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

@include('panel.layouts.sidebar')

@yield('content')

<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            @yield('sidebar')
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-left d-none d-sm-inline">
            <a class="" href="https://www.instagram.com/_hoseinsatari/" target="_blank">hoseinsatari</a>
        </div>
        <!-- Default to the left -->
        طراحی و پیاده سازی شده توسط <strong><a href="https://www.instagram.com/_hoseinsatari/">حسین ستاری</a></strong>
    </footer>
</div>
{{--
<div class="snackbar dynamic shadow bg-success">
    <span class="p-3 d-inline-block">
    </span>
    <span class="closeSnackbar d-inline-block p-3">
        <i class="fad fa-times"></i>
    </span>
</div> --}}

<!-- ./wrapper -->
@yield('bottom')
@stack('bottom')

<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@yield('scripts')
@stack('scripts')
@include('sweet::alert')
@jquery
@toastr_js
@toastr_render

</body>
</html>
