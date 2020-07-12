<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>yield('title') </title>
    <link href="{{ asset('/admin/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/admin/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/bootstrap.min.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    @yield('style')
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">


    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">


            <div class="container-fluid">
                @if(session('message') && session('status'))
                    <div class="alert alert-{{ session('status') == 'success' ? 'success' : 'error' }} alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                </div>

                <div class="row">
                    @yield('content')

                </div>
                 </div>

        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 2020</span>
                </div>
            </div>
        </footer>

    </div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset("/admin/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset('/admin/js/sb-admin-2.min.js') }}"></script>
@yield('script')
</body>
</html>
