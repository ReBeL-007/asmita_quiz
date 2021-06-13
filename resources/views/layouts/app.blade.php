<!DOCTYPE html>
<html>

<head>
    @include('student.includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="loading">
            <img class="loading-gif" src="{{ asset ('loading.gif') }}">
        </div>
        <!-- Navbar -->
        @include('student.includes.nav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-indigo">
            @include('student.includes.sidebar')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content" style="padding-top: 20px">
                <!-- Content Header (Page header) -->
                {{-- <div class="content-header">

    </div> --}}
                <!-- /.content-header -->
                <div class="col-lg-8">
                    @include('student.includes.messages')
                </div>
                @section('content')
                @show
                <!-- /.content -->
            </section>
        </div>
        <!-- /.content-wrapper -->
        @include('student.includes.footer')
        @section('script')
        @show
</body>

</html>
