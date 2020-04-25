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
        <a href="{{ route('content.search' , ['type' => $type]) }}">
            <?php
            switch ($type) {
                case 'EVENT':
                    echo 'جالش ها';
                    break;
                case 'PREREQUISITES':
                    echo 'چرا یادگیری کسب و کار';
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
            @section('style')
            <link href="{{ asset('/css/videojs.css') }}" rel="stylesheet">
            @endsection
            @section('script')
            <script type="text/javascript" src="{{ asset('/js/videojs.js') }}"></script>
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
                <div style="text-align: center;width:100%">
                    <p>
                        <small>شما میتوانید پاسخ های ارسالی یا دریافتی خود را در پروفایل خود مشاهده کنید</small>
                    </p>
                    <p>
                        <small><a class="my-green-color" href="{{ route('profile' , ['page' => 'myAnswers','user' => auth()->user()->id , 'event' => $content->id]) }}">مشاهده پاسخ های ارسالی و دریافتی شما برای این چالش</a></small>
                    </p>
                </div>
                <br>
                <form action="{{ route('save.answer' , ['content_id' => $content->id]) }}" method="post" class="form-group">
                    @csrf
                    <textarea class="form-control" name="answer" id="answer" cols="30" rows="10" placeholder="پاسخ خود را تایپ کنید"></textarea>
                    <br>
                    <button type="submit" class="btn-back float-left">ارسال</button>
                </form>
            </div>
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
                <hr>
                <div class="custom-control custom-switch" dir="ltr">
                    <form action="{{ route('content.changeStatus' , ['content' => $content->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <input onchange="this.form.submit()" type="checkbox" name="read" class="custom-control-input" id="customSwitch1" {{ $readed ? 'checked' : null }}>
                        <label class="custom-control-label" for="customSwitch1">خوانده شد</label>
                    </form>
                </div>
            </div>
            @break
            @case('STEP')
            @section('style')
            <link href="{{ asset('/css/videojs.css') }}" rel="stylesheet">
            @endsection
            @section('script')
            <script type="text/javascript" src="{{ asset('/js/videojs.js') }}"></script>
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
                <div class="custom-control custom-switch" dir="ltr">
                    <form action="{{ route('content.changeStatus' , ['content' => $content->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <input onchange="this.form.submit()" type="checkbox" name="read" class="custom-control-input" id="customSwitch1" {{ $readed ? 'checked' : null }}>
                        <label class="custom-control-label" for="customSwitch1">خوانده شد</label>
                    </form>
                </div>
            </div>
            @break
            @case('INTRODUCTION')
            <div style="width: 100%" class="video-div mt-3">
                <br>
                <img src="{{ asset($content->logo) }}" width="200" height="200" alt="{{ $content->title }}" style="border-radius: 50%;border:10px solid #f1f3f8">
                <div class="mt-4">
                    <p style="text-align: right">
                        {!! $content->body !!}
                    </p>
                </div>
            </div>
            @break
            @case('JANEBI')
            @section('style')
            <link href="{{ asset('/css/videojs.css') }}" rel="stylesheet">
            @endsection
            @section('script')
            <script type="text/javascript" src="{{ asset('/js/videojs.js') }}"></script>
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
            </div>
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