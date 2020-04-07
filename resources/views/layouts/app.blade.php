<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>مدرسه کسب و کار -@yield('title') </title>

    <!-- Scripts -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        @include('fixes.header')
        @yield('canvas')
        @yield('content')
        @include('fixes.footer')
    </div>

    <script type="text/javascript" src="{{ '/js/jquery.min.js' }}"></script>
    <script type="text/javascript" src="{{ '/js/bootstrap.bundle.min.js' }}"></script>
@yield('script')
</body>
</html>
