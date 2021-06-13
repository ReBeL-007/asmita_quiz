<!DOCTYPE html>
<html>

<head>
    @include('student.includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <style>
        body{
            background-color: #ececf9;
        }
    </style>
    <div class="wrapper">

        <section class="content" style="padding-top: 20px">
            <!-- Content Header (Page header) -->
            {{-- <div class="content-header">

    </div> --}}
            <!-- /.content-header -->
            @section('content')
            @show
            <!-- /.content -->
        </section>
    </div>
    <!-- /.content-wrapper -->
    @section('script')
    @show
</body>

</html>
