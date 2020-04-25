@extends('layouts.app')
@section('title')
جستوجو
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
        <span>
            جستوجو
        </span>
    </div>
</div>
<section class="container" style="margin-top: 60px">
    <section class="row">
        <form action="{{ route('content.search') }}" style="width: 100%" class="form-search">
            <input type="text" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" class="search-input" placeholder="دنبال چیز خاصی میگردی؟ اینجا بگرد...">
            <i class="material-icons-two-tone f-40 icon-search" style="position: relative;
    left: 30px;
    top:unset !important;
    float: left;
    bottom: 50px;">search</i>
        </form>
    </section>
</section>
@if(count($contents) == 0)
<br>
<div class="container">
    <br>
    <h4 align="center">نتیجه ای یافت نشد!</h4>
</div>
@endif
<div class="container mt-4">
    <div class="row">
        @foreach($contents as $c)
        <?php
        switch ($c->type) {
            case 'STEP':
                $image = 'banerImage';
                $body = 'shortText';
                $btnText = 'مطالعه';
                $type = 'محتوا';
                break;
            case 'EVENT':
                $image = 'image';
                $body = 'body';
                $btnText = 'حل چالش';
                $type = 'چالش';
                break;
            case 'INTRODUCTION':
                $image = 'logo';
                $body = 'body';
                $btnText = 'بیشتر';
                $type = 'معرفی کسب و کار';
                break;
            case 'PREREQUISITES':
                $image = 'image';
                $body = 'body';
                $btnText = 'مطالعه';
                $type = 'چرا یادگیری کسب و کار';
                break;
            case 'JANEBI':
                $image = 'banerImage';
                $body = 'shortText';
                $btnText = 'مطالعه';
                $type = 'خرده نوشته ها';
                break;
        }
        ?>
        <div class="col-md-6 col-sm-12 mt-3">
            <div class="container profile-div div-cat d-flex" style="border-radius: 0 50px 50px 0px;">
                <div class="col-md-4 col-sm-6 p-0">
                    <a href="{{ route('content.show' , ['type' => $c->type,  'content' => $c->id]) }}">
                        <img width="100%" height="100%" src="{{ $c[$image] }}" alt="{{ $c->title }}" style="position: relative;
    right: -16px;
    border-radius: 50px 50px 50px 0;">
                        <?php
                        $contentReaded = null;
                        if (auth()->check()) {
                            $contentReaded = Illuminate\Support\Facades\DB::table('user_content')->where('user_id', auth()->user()->id)->where('content_id', $c->id)->where('read', true)->exists();
                        }
                        ?>
                        @if($contentReaded)
                        <div class="passed-cat">
                            <div class="play-div-check">
                                <i class="material-icons-two-tone">
                                    check
                                </i>
                            </div>
                        </div>
                        @endif
                    </a>

                </div>
                <div class="col-md-8 col-sm-6 p-3">
                    @if($c->type == 'EVENT' || $c->type == 'STEP')
                        <div class="sticky-level">
                            <span>{{ $c->category->level }}</span>
                        </div>
                    @endif
                    <h6>{{ $c->title }}</h6>
                    <p class="f-12 mt-4">{{ \Str::limit($c[$body] , 23) }}</p>
                    <span class="f-12 text-black-50">نوع : {{ $type }}</span>
                    <a href="{{ route('content.show' , ['type' => $c->type,  'content' => $c->id]) }}" class="btn-more f-12" style="float: left;position: relative;bottom:unset !important;left:-19px;">{{ $btnText }}</a>

                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
<div style="height: 100px"></div>
@endsection