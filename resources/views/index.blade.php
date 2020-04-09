@extends('layouts.app')
@section('title')
    صفحه اصلی
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/js/animate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.owl-carousel1').owlCarousel({
                stagePadding: 30,
                margin: 10,
                rtl: true,
                nav: true,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
            $('.owl-carousel2').owlCarousel({
                stagePadding: 30,
                margin: 10,
                rtl: true,
                nav: true,

                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                }
            })
            $('.owl-carousel3').owlCarousel({
                stagePadding: 30,
                margin: 10,
                rtl: true,
                nav: true,

                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                }
            })
            $('.owl-carousel4').owlCarousel({
                stagePadding: 30,
                margin: 10,
                rtl: true,
                nav: true,

                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })

            $(".owl-prev").html('<i class="material-icons">arrow_forward</i>');
            $(".owl-next").html('<i class="material-icons">arrow_back</i>');
        })
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">
@endsection
@section('canvas')
    <div id="back-canvas" style="height: 300px;width: 100%;background: var(--pr-green);">

        <div id="particle-canvas">
            <span style="font-size: 1.73333rem;top: 45px;" align="center"
                  class="old-font text-white mt-2 font-weight-bold">
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
        <section class="kasbokar" id="kasbokar">
            <div class="owl-carousel owl-carousel1 owl-theme">
                @foreach($kasbokars as $kasb)
                    <div class="item">
                        <div class="d-flex align-items-center" style="height: 100%">
                            <div class="col-xs-6 col-sm-6"
                                 style="height: 100%;border-left: 1px solid #f1f3f8;padding-right: 0 !important;"><img
                                    style="border-radius: 50px;border: 7px outset var(--pr-green);" class="mt-2"
                                    src="{{ asset($kasb->logo) }}" alt="{{ $kasb->title }}"></div>
                            <div class="col-xs-6 col-sm-6">
                                <h6 class="font-weight-bold old-font f-14">{{ $kasb->title }}</h6>
                                <p class="mt-3 f-12">{{ \Str::limit($kasb->body , 20) }}</p>
                                <a href="#!" class="btn-more f-12">بیشتر <i class="material-icons-two-tone btn-icons">arrow_back</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section id="prerequisites" class="content-section">
            <h4 class="font-weight-bold old-font" style="margin-right: 30px">پیش نیاز ها</h4>
                        <div class="dot-back"></div>
            <div class="owl-carousel owl-carousel2 owl-theme mt-4">
                @foreach($pres as $pre)
                    <div class="item">
                        <div class="d-flex align-items-center" style="height: 100%">
                            <a href="#!">

                                <img src="{{ asset($pre->image) }}" class="video-img" alt="{{ $pre->title }}">

                                <h6 class="f-10 text-white content-title">{{ $pre->title }}</h6>
                                <div class="{{ auth()->check() ? in_array($pre->_id , $contentsReadedId) ? 'play-div-check' : 'play-div' : 'play-div' }}">
                                    <i class="material-icons-two-tone">
                                        @auth
                                            @if(in_array($pre->_id, $contentsReadedId))
                                                check
                                            @else
                                                play_arrow
                                            @endif
                                        @else
                                            play_arrow
                                        @endauth
                                    </i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section id="step" class="content-section">
            <h4 class="font-weight-bold old-font" style="margin-right: 30px">محتوای مرحله ای</h4>
            <div class="dot-back"></div>
            <div class="owl-carousel owl-carousel3 owl-theme mt-4">
                @foreach($steps as $step)
                    <div class="item step-item">
                        <div class="d-flex align-items-center">
                            <div class="{{ auth()->check() ? in_array($step->_id , $contentsReadedId) ? 'open-or-not-check' : 'open-or-not' : 'open-or-not' }}">
                                <i class="material-icons-two-tone">
                                    @auth
                                        @if(auth()->user()->level >= $step->level)
                                            @if(in_array($step->_id , $contentsReadedId))
                                                check
                                            @else
                                                lock_open
                                            @endif
                                        @else
                                            lock
                                        @endif
                                    @else
                                        lock
                                    @endauth
                                </i>
                            </div>
                            <div class="col-md-12">

                                <div class="row">
                                    <a href="#!">
                                        <img style="border-radius: 5px 5px 0 0;height: 11rem;" src="{{ $step->banerImage }}" alt="{{ $step->title }}">
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-12 mt-2" style="text-align: center">
                                   <span class="my-blue-color f-12"> مرحله {{ $step->level }}</span>
                                    <br>
                                    <span class="font-weight-bold f-14 old-font">{{ $step->title }}</span>
                                    <br>
                                    <br>
                                    <p class="f-10">{{ \Str::limit($step->body , 70) }}</p>
                                    <a href="#!" class="btn-more">مطالعه</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section id="janebi" class="content-section">
            <h4 class="font-weight-bold old-font" style="margin-right: 30px">محتوای جانبی / اخبار و حواشی</h4>
            <div class="dot-back"></div>
            <div class="owl-carousel owl-carousel4 owl-theme mt-4">
                @foreach($janebies as $janebi)
                    <div class="item step-item">
                        <div class="d-flex align-items-center">
                            <div class="col-md-12">
                                <div class="row" style="border-bottom: 1px solid #f1f3f8">
                                    <a href="#!">
                                        <img style="border-radius: 5px 5px 0 0;height: 11rem;" src="{{ $janebi->banerImage }}" alt="{{ $janebi->title }}">
                                    </a>
                                    <div class="btn-see-div">
                                        <a href="#!" class="btn-see">
                                            مشاهده
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 mt-2" style="text-align: center">
                                    <br>
                                    <span class="font-weight-bold f-14 old-font">{{ $janebi->title }}</span>
                                    <br>
                                    <br>
                                    <p class="f-10">{{ \Str::limit($janebi->body , 70) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </section>

@endsection
