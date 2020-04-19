@extends('layouts.app')
@section('title')
{{ $content->title }}
@endsection
@section('back-icon')
<button onclick="return history.go(-1)" class="back-icon d-sm-block d-md-none">
    <i class="material-icons-two-tone">arrow_forward</i>
</button>
@endsection
@section('content')
<div class="steper div-scrolable">
    <div class="container">
        <a href="{{ route('index') }}">
            <i class="material-icons" style="position: relative;top: 8px">home</i>
        </a>
        <i class="material-icons" style="position: relative;top: 10px">keyboard_arrow_left</i>
        <a href="#!">
            <?php
            switch ($type) {
                case 'EVENT':
                    echo 'جالش ها';
                    break;
                case 'PREREQUISITES':
                    echo 'پیش نیاز ها';
                    break;
                case 'STEP':
                    echo 'محتواهای مرحله';
                    break;
                case 'INTRODUCTION':
                    echo 'معرفی کسب و کار ها';
                    break;
                case 'JANEBI':
                    echo 'محتواهای جانبی';
                    break;
            };
            ?>
        </a>
        @switch($content->type)
        @case('STEP')
        @case('EVENT')
        <i class="material-icons" style="position: relative;top: 10px">keyboard_arrow_left</i>
        <a href="{{ route('category.show' , ['category' => $content->category->id]) }}">
            مرحله {{ $content->category->level }} - {{ $content->category->name }}
        </a>
        @break
        @endswitch
        <i class="material-icons" style="position: relative;top: 10px">keyboard_arrow_left</i>
        <span>
            {{ $content->title }}
        </span>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 pt-4 pb-4 profile-div">
            <div style="text-align:center;width:100%">
                <h5 align="center" class="old-font" style="font-weight:bold">{{ $content->title }}</h5>
                <i class="material-icons-two-tone" style="    font-size: 16px;
    vertical-align: middle;">schedule</i>
                <span>{{ jdate($content->created_at)->format('%A, %d %B %y') }}</span>
            </div>
            @switch($type)
            @case('EVENT')

            @break
            @case('PREREQUISITES')
            @section('style')
            <link href="{{ asset('/css/videojs.css') }}" rel="stylesheet">
            @endsection
            @section('script')
            <script type="text/javascript" src="{{ asset('/js/videojs.js') }}"></script>
            @endsection

            <div style="width: 100%" class="video-div mt-3">
                <video id="my-video" class="video-js vjs-theme-forest" controls preload="auto" width="640" height="264" poster="{{ $content->image }}" data-setup="{}">
                    <source src="{{ asset($content->video) }}" type="video/mp4" />
                    <source src="{{ asset($content->video) }}" type="video/webm" />
                    <p class="vjs-no-js">
                        برای مشاهده این ویدیو باید جاواسکرپت مرورگر خود را فعال کنید.
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                <hr>
                <div class="mt-4">
                    <p style="text-align: right">
                        {!! $content->body !!}
                    </p>
                </div>
            </div>
            @break
            @case('STEP')
            @section('style')
            <link href="{{ asset('/css/videojs.css') }}" rel="stylesheet">
            @endsection
            @section('script')
            <script type="text/javascript" src="{{ asset('/js/videojs.js') }}"></script>
            <script type="text/javascript">
                window.HELP_IMPROVE_VIDEOJS = false;
                var options = {
                    autoplayfalse : false,
                };

                var player = videojs('my-video', options, function onPlayerReady() {
                    videojs.log('Your player is ready!');

                    // In this context, `this` is the player that was created by Video.js.
                    this.play();

                    // How about an event listener?
                    this.on('ended', function() {
                        videojs.log('Awww...over so soon?!');
                    });
                });
            </script>
            @endsection
            <div style="width: 100%" class="video-div mt-3">
                <video id="my-video" class="video-js vjs-theme-forest" controls preload="auto" width="640" height="264" poster="{{ $content->preImage }}" data-setup="{}">
                    <source src="{{ asset($content->video) }}" type="video/mp4" />
                    <source src="{{ asset($content->video) }}" type="video/webm" />
                    <p class="vjs-no-js">
                        برای مشاهده این ویدیو باید جاواسکرپت مرورگر خود را فعال کنید.
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                <hr>
                <div class="mt-4">
                    <p style="text-align: right">
                        {!! $content->body !!}
                    </p>
                </div>
                <hr>
                <h6 align="center" class="my-blue-color">ارسال پاسخ</h6>
                <br>
                <form action="{{ route('save.answer' , ['content_id' => $content->id]) }}" method="post" class="form-group">
                    @csrf
                    <textarea class="form-control" name="answer" id="answer" cols="30" rows="10" placeholder="پاسخ خود را تایپ کنید"></textarea>
                    <br>
                    <button type="submit" class="btn-back float-left">ارسال</button>
                </form>
            </div>
            @break
            @case('INTRODUCTION')

            @break
            @case('JANEBI')

            @break
            @endswitch
        </div>
        <div class="col-md-4 d-none d-sm-block">
            <div class="profile-div">
                <ul class="ul-cat p-0">
                    @foreach($categories as $cat)
                    <li class="li-cat"><a href="{{ route('category.show' , ['category' => $cat->id]) }}" class="f-12">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container mt-3 mb-5">
    <div class="row">
        <div style="width: 50%">
            @if(isset($pre))
            <a href="{{ route('content.show' , ['content' => $pre , 'type' => $pre->type]) }}" class="btn-back">
                قبلی
            </a>
            @else
            <a href="#!" style="background-color: #f1f3f8" class="btn-back">
                قبلی
            </a>
            @endif
        </div>
        <div style="text-align: left;width: 50%">
            @if(isset($next))
            <a href="{{ route('content.show' , ['content' => $next , 'type' => $next->type]) }}" class="btn-back">
                بعدی
            </a>
            @else
            <a href="#!" style="background-color: #f1f3f8" class="btn-back">
                بعدی
            </a>
            @endif
        </div>
    </div>
</div> -->
<div style="height: 100px"></div>
@endsection