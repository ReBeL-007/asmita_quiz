<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('frontend/img/Group 395.svg')}}">
        
        <title>@yield('title') | Sikaai</title>
        @include('site.head')
    </head>
<body>
    @include('site.nav')
    @section('content')
        @show
    @include('site.footer')
</body>
</html> 

