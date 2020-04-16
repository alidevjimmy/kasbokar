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
        <i class="material-icons" style="position: relative;top: 10px">keyboard_arrow_left</i>
        <span>
            {{ $content->title }}
        </span>
    </div>
</div>
<div class="container mt-4 profile-div">
    <div class="row">
        <div class="col-md-12 pt-4 pb-4">
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
                @auth
                    <video id="my-video" class="video-js" controls preload="auto" width="640" height="264" poster="{{ $content->image }}" data-setup="{}">
                        <source src="{{ asset($content->video) }}" type="video/mp4" />
                        <source src="{{ asset($content->video) }}" type="video/webm" />
                        <p class="vjs-no-js">
                            برای مشاهده این ویدیو باید جاواسکرپت مرورگر خود را فعال کنید.
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                @else
                    <div class="cant-video">
                        <i class="material-icons-two-tone f-40">
                            videocam_off
                        </i>
                        <p style="font-weight: bold">
                            برای مشاهده فیلم باید 
                            <a href="{{ route('register' , ['redirect' => route('content.show' , ['content' => $content , 'type' => $type])]) }}" class="my-green-color">
                                ثبت نام کنید</a> یا <a href="{{ route('login' , ['redirect' => route('content.show' , ['content' => $content , 'type' => $type])]) }}" class="my-green-color">وارد شوید</a>
                        </p>
                    </div>
                @endauth
                <div class="container mt-4">
                    <p style="text-align: right">
                        {{ $content->body }}
                    </p>
                </div>
                <div class="mt-5">
                    <div class="custom-control custom-switch" dir="ltr">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" {{ auth()->check() ? $readed ? 'checked' : '' : '' }}>
                        <label class="custom-control-label old-font my-blue-color" style="font-weight:bold" for="customSwitch1">خوانده شد</label>

                    </div>
                </div>
            </div>
            @break
            @case('STEP')

            @break
            @case('INTRODUCTION')

            @break
            @case('JANEBI')

            @break
            @endswitch
        </div>
    </div>
</div>

<div class="container mt-3 mb-5">
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
</div>

@endsection