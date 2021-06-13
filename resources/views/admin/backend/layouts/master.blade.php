<!DOCTYPE html>
<html>

<head>
    @include('admin.backend.layouts.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed custom-scrollbar-css">
    <div class="wrapper">
        <div class="loading">
            <img class="loading-gif" src="{{ asset ('loading.gif') }}">
        </div>
        <!-- Navbar -->
        @include('admin.backend.layouts.nav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-indigo">
            @include('admin.backend.layouts.sidebar')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <!-- Content Header (Page header) -->
                {{-- <div class="content-header">

    </div> --}}
                <!-- /.content-header -->
                <div class="col-lg-8">
                    @include('admin.backend.includes.messages')
                </div>
                @section('content')
                @show
                <!-- /.content -->
            </section>
        </div>
        <!-- /.content-wrapper -->
        @include('admin.backend.layouts.footer')
</body>

</html>
