<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable"
    @if (app()->currentLocale() == 'ar') dir="rtl"
      @else
      dir="" @endif>
   

<x-head />

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <x-logo />
                    </div>

                    <x-btn-nav />

                    <!-- App Search-->
                    @yield('search')
                    {{-- <x-search /> --}}
                </div>

                <div class="d-flex align-items-center">

                    <x-dropdown-topbar />
                </div>
            </div>
        </header>
    </div>


    <x-removeNotification />
    <!-- ========== App Menu ========== -->
    <div
    class="app-menu navbar-menu">
        <!-- LOGO -->
        <x-navbar />

        <x-scrollbar />

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('content')

        <!-- End Page-content -->

        <x-footer />
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- Theme Settings -->
    <x-theme />

    <!-- JAVASCRIPT -->
    <x-js />


    @yield('alerts')
    {{-- @section('alerts')

    <x-alerts-js/>

    @endsection --}}


</body>

</html>
