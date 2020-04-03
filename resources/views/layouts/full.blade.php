<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <style>
        body {
            box-sizing: border-box;
            max-width: 100%;
            background-color: rgb(250, 250, 250) !important;
            overflow-x: hidden;
            background-image: url("/images/photo_2020-04-03_15-45-58.jpg") !important;
            background-size: cover;
            margin: 0px;
            background-position: 100% 100%;
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            background-blend-mode: soft-light;
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
