@extends('layouts.app')
@section('title')
مرحله {{ $category->level }} - {{ $category->name }}
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
            مرحله {{ $category->level }} - {{ $category->name }}
        </span>
    </div>
</div>
<div class="container mt-4">
    <h4 class="my-blue-color pb-3" style="font-weight: bold" align="center"> مرحله {{ $category->level }}</h5>
        <div class="row">
            @foreach($catContents as $c)
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
                                $contentReaded = Illuminate\Support\Facades\DB::table('user_content')->where('user_id', auth()->user()->id)->where('content_id', $c->id)->where('read' , true)->exists();
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