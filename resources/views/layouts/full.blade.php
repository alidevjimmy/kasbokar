<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <style>
        body {
            box-sizing: border-box !important;
            max-width: 100% !important;
            background-color: rgb(250, 250, 250) !important;
            overflow-x: hidden !important;
            background-image: url("/images/photo_2020-04-03_15-45-58.png") !important;
            background-size: cover !important;
            margin: 0px !important;
            background-position: 100% 100% !important;
            background-repeat: no-repeat !important;
            background-position: bottom !important;
            background-size: cover !important;
            background-blend-mode: soft-light !important;
        }
    </style>
    @yield('style')
    <title>@yield('title') - مدرسه کسب و کار </title>
</head>
<body>

@yield('content')

<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset("/admin/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset('/admin/js/sb-admin-2.min.js') }}"></script>
@yield('script')
</body>
</html>
