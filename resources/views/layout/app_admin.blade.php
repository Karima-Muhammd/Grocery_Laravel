<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backEnd/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backEnd/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('backEnd/css/vendor.bundle.addons.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('backEnd/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('backEnd/images/logo_2H_tech.png')}}" />
    @yield('style')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('inc.inc_admin.nav_top')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('inc.inc_admin.nav_side')
        <div class="main-panel">
            <div class="content-wrapper">
             <!-- content -->
          @yield('content')
            </div>
        </div>
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('inc.inc_admin.footer_admin')

<!-- plugins:js -->
<script src="{{asset('backEnd/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('backEnd/js/vendor.bundle.addons.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('backEnd/js/off-canvas.js')}}"></script>
<script src="{{asset('backEnd/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('backEnd/js/template.js')}}"></script>
<script src="{{asset('backEnd/js/settings.js')}}"></script>
<script src="{{asset('backEnd/js/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('backEnd/js/dashboard.js')}}"></script>
<!-- End custom js for this page-->
@yield('script')
</body>

</html>

