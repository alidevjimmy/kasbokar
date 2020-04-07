@extends('layouts.app')
@section('title')
    صفحه اصلی
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/js/animate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/owl.theme.default.min.css') }}"></script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            stagePadding: 50,
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
@endsection
@section('canvas')
    <div id="back-canvas" style="height: 300px;width: 100%;background: linear-gradient(90deg,var(--pr-blue),var(--pr-blue2));">

        <div id="particle-canvas">
            <span style="font-size: 1.73333rem;top: 45px;" align="center" class="old-font text-white mt-2 font-weight-bold">
                تو کارت حرفه ای شو
            </span>
            <section class="container" style="margin-top: 60px">
                <section class="row">
                    <form action="#" style="width: 100%" class="form-search">
                        <input type="text" class="search-input" placeholder="جستوجو در بین چالش ها ، پیش نیاز ها و ...">
                        <i class="material-icons-two-tone f-40 icon-search">search</i>
                    </form>
                </section>
            </section>
        </div>
    </div>
@endsection
@section('content')
    <section id="content" class="content">
        <div class="kasbokar">
            <div class="owl-carousel owl-theme">
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>1</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>2</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>3</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>4</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>5</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>6</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>7</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>8</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>9</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>10</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>11</h4></div>
                <div class="item" style="width: 100px;height: 100px;background-color: #0c5460"><h4>12</h4></div>
            </div>
        </div>
    </section>
@endsection
