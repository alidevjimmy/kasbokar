@extends('errors`.app')
@section('title') صفحه 500 @endsection
@section('content')
    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="500">500</div>
            <p class="lead text-gray-800 mb-5">خطا در برقراری ارتباط با سرور</p>
            <a href="{{ route('admin.index') }}">&larr;بازگشت به صفحه اصلی</a>
        </div>

    </div>
@endsection
