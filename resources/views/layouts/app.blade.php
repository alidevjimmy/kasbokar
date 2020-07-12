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
    <!-- <script language="JavaScript">
        document.oncontextmenu = new Function("return false;")
    </script> -->
</head>

<body>
    <div class="splash-screen" style="text-align: center">
        <div class="splash-logo">
        </div>
    </div>
    <div id="app">
        @include('fixes.header')
        @yield('canvas')
        @if(session('status') && session('message'))
        <div class="alert {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" role="alert">
            <span class="old-font f-14">{{ session('message') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @yield('content')
        @include('fixes.footer')
    </div>

    <script type="text/javascript" src="{{ '/js/jquery.min.js' }}"></script>
    <script type="text/javascript" src="{{ '/js/bootstrap.bundle.min.js' }}"></script>
    @yield('script')
    @yield('modal')
    @yield('suggest')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.splash-screen').css({
                display: 'none'
            })
        })
    </script>
</body>

</html>
