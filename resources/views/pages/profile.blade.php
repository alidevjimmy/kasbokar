@extends('layouts.app')
@section('title')
    پروفایل
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
            <span href="{{ route('profile' , ['user' => $user->id]) }}">
            پروفایل
        </span>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">

            @switch($page)
                @case('myInformation')
                <div class="col-md-12 profile-div">
                    @if(auth()->check())
                        @if(auth()->user()->id == $user->id)
                            <div class="col-md-12 div-scrolable">
                                <ul class="profile-ul">
                                    <li>
                                        <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myInformation']) }}"
                                           class="{{ $page == 'myInformation' ? 'profile-page' : null }}">اطلاعات
                                            شخصی</a></li>
                                    <li>
                                        <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'readedContent']) }}"
                                           class="{{ $page == 'readedContent' ? 'profile-page' : null }}">محتواهای
                                            خوانده شده</a>
                                    </li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myAnswers']) }}"
                                           class="{{ $page == 'myAnswers' ? 'profile-page' : null }}">مشاهده پاسخ ها</a>
                                    </li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'resume']) }}"
                                           class="{{ $page == 'resume' ? 'profile-page' : null }}">رزومه</a></li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'contents']) }}"
                                           class="{{ $page == 'contents' ? 'profile-page' : null }}">محتواهای منتشر
                                            شده</a></li>
                                </ul>
                            </div>
                        @endif
                    @endif
                    <div class="col-md-12 mt-5">
                        <div class="col-md-6" style="margin: auto">
                            <h5 class="my-blue-color font-weight-bold old-font" align="center">مرحله شما
                                : {{ $user->level }}</h5>
                            <form method="POST" action="{{ route('profile.edit' , ['user' => $user->id]) }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="fullName"
                                           class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('نام کامل') }}</label>

                                    <div class="col-md-12">
                                        <i class="fa fa-user input-icon"></i> <input id="fullName" type="text"
                                                                                     placeholder="نام کامل..."
                                                                                     class="form-control f-size-12 @error('fullName') is-invalid @enderror"
                                                                                     name="fullName"
                                                                                     value="{{ $user->fullName }}"
                                                                                     style="padding-right: 30px"
                                                                                     autocomplete="fullName" autofocus>

                                        @error('fullName')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="workStatus"
                                           class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('وضعیت شغلی') }}</label>

                                    <div class="col-md-12">
                                        <i class="fa fa-users input-icon"></i>
                                        <select name="workStatus" style="padding-right: 30px"
                                                class="form-control f-size-12 @error('workStatus') is-invalid @enderror">
                                            <option value="" disabled {{ !$user->workStatus ? 'selected' : '' }}>وضعیت
                                                شغلی
                                            </option>
                                            <option
                                                value="EMPLOYEE" {{ $user->workStatus == 'EMPLOYEE' ? 'selected' : '' }}>
                                                کارمند
                                            </option>
                                            <option
                                                value="HOMEKEEPER" {{ $user->workStatus == 'HOMEKEEPER' ? 'selected' : '' }}>
                                                خانه دار
                                            </option>
                                            <option
                                                value="STUDENT" {{ $user->workStatus == 'STUDENT' ? 'selected' : '' }}>
                                                دانشجو / دانش آموز
                                            </option>
                                            <option
                                                value="JOBKEEPER" {{ $user->workStatus == 'JOBKEEPER' ? 'selected' : '' }}>
                                                جویای کار
                                            </option>
                                        </select>

                                        @error('workStatus')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 btn-group" style="direction: ltr">
                                        <div class="float-left">
                                            <button style="width: 100%" type="submit" class="btn-back">
                                                {{ __('ویرایش') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
                @break
                @case('readedContent')
                <div class="col-md-12 profile-div">
                    @if(auth()->check())
                        @if(auth()->user()->id == $user->id)
                            <div class="col-md-12 div-scrolable">
                                <ul class="profile-ul">
                                    <li>
                                        <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myInformation']) }}"
                                           class="{{ $page == 'myInformation' ? 'profile-page' : null }}">اطلاعات
                                            شخصی</a></li>
                                    <li>
                                        <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'readedContent']) }}"
                                           class="{{ $page == 'readedContent' ? 'profile-page' : null }}">محتواهای
                                            خوانده شده</a>
                                    </li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myAnswers']) }}"
                                           class="{{ $page == 'myAnswers' ? 'profile-page' : null }}">مشاهده پاسخ ها</a>
                                    </li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'resume']) }}"
                                           class="{{ $page == 'resume' ? 'profile-page' : null }}">رزومه</a></li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'contents']) }}"
                                           class="{{ $page == 'contents' ? 'profile-page' : null }}">محتواهای منتشر
                                            شده</a></li>
                                </ul>
                            </div>
                        @endif
                    @endif
                    <div class="col-md-12 mt-5">
                        <div class="container">
                            <div class="row">
                                @if(count($readedContents) > 0)
                                    @foreach($readedContents as $rc)
                                        <a href="{{ route('content.show' , ['content' => $rc->id , 'type' => $rc->type]) }}">
                                            <div class="col-md-12 box-readed mt-2 mb-2">
                                                <div class="col-md-3 col-xs-6">
                                                    <?php
                                                    switch ($rc->type) {
                                                        case 'STEP':
                                                            $image = 'banerImage';
                                                            $type = 'مرحله ای';
                                                            break;
                                                        case 'EVENT':
                                                            $image = 'image';
                                                            $type = 'چالش';
                                                            break;
                                                        case 'PREREQUISITES':
                                                            $image = 'image';
                                                            $type = 'پیش نیاز';
                                                            break;
                                                    }
                                                    ?>
                                                    <img src="{{ asset($rc[$image]) }}" alt="{{ $rc->title }}"
                                                         style="width: 100%;height: 100%;border-radius: 5px">
                                                </div>
                                                <div class="col-md-9 col-xs-6">
                                                    <h6 class="f-14 font-weight-bold old-font">{{ $rc->title }}</h6>
                                                    <p class="f-10">{{ \Str::limit($rc->body , 70) }}</p>
                                                    <br>
                                                    <span class="f-12 text-black-50">نوع : {{ $type }}</span>

                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div style="text-align: center;width: 100%">
                                        <h4 align="center">شما محتوای خوانده شده ندارید </h4>
                                        <h2 class="f-40" align="center"><i class="material-icons-two-tone">remove_red_eye</i>
                                        </h2>
                                        <br>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @break
                @case('myAnswers')
                <div class="col-md-12 profile-div">
                    @if(auth()->check())
                        @if(auth()->user()->id == $user->id)
                            <div class="col-md-12 div-scrolable">
                                <ul class="profile-ul">
                                    <li>
                                        <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myInformation']) }}"
                                           class="{{ $page == 'myInformation' ? 'profile-page' : null }}">اطلاعات
                                            شخصی</a></li>
                                    <li>
                                        <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'readedContent']) }}"
                                           class="{{ $page == 'readedContent' ? 'profile-page' : null }}">محتواهای
                                            خوانده شده</a>
                                    </li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myAnswers']) }}"
                                           class="{{ $page == 'myAnswers' ? 'profile-page' : null }}">مشاهده پاسخ ها</a>
                                    </li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'resume']) }}"
                                           class="{{ $page == 'resume' ? 'profile-page' : null }}">رزومه</a></li>
                                    <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'contents']) }}"
                                           class="{{ $page == 'contents' ? 'profile-page' : null }}">محتواهای منتشر
                                            شده</a></li>
                                </ul>
                            </div>
                        @endif
                    @endif
                    <div class="col-md-12 mt-5">
                        @if(count($myAnswers) > 0)
                            @foreach($myAnswers as $ans)
                                <div
                                    class="{{ isset($_GET['event']) ? $_GET['event'] == $ans->id ? 'ans-border' : '' : '' }}">
                                    <h6>جواب های شما به<a
                                            href="{{ route('content.show' , ['content' => $ans , 'type' => $ans->type]) }}"
                                            class="my-green-color"> {{ $ans->title }}</a></h6>
                                    <p>
                                        @foreach($ans->answers as $a)
                                            <?php $reps = $a->replays ?>
                                            <div class="col-md-12 box-readed mt-2 mb-2 d-block">
                                    <p><small>پاسخ شما در
                                            تاریخ {{ jdate($a->created_at)->format('%A, %d %B %y') }}</small></p>
                                    <span class="ans-status">
                                @if($a->accepted == true)
                                            تایید شد
                                        @else
                                            @if(!count($reps) > 0)
                                                در انتطار تایید
                                            @else
                                                رد شد
                                            @endif
                                        @endif
                            </span>
                                    <p>{{ $a->answer }}</p>
                                    @foreach($reps as $rep)
                                        <div class="col-md-12 div-rep mt-2">
                                            <p><small>پاسخ ادمین در
                                                    تاریخ {{ jdate($rep->created_at)->format('%A, %d %B %y') }}</small>
                                            </p>
                                            <p>{!! $rep->replay !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                                @endforeach
                                </p>
                    </div>
                    @endforeach
                    @else
                        <div style="text-align: center;width: 100%">
                            <h4 align="center">شما پاسخی ثبت نکرده اید </h4>
                            <br>
                        </div>
                    @endif
                </div>
        </div>

    @break
    @case('resume')
    <div class="col-md-12">
        <div class="profile-div">
            @if(auth()->check())
                @if(auth()->user()->id == $user->id)
                    <div class="col-md-12 div-scrolable">
                        <ul class="profile-ul">
                            <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myInformation']) }}"
                                   class="{{ $page == 'myInformation' ? 'profile-page' : null }}">اطلاعات شخصی</a>
                            </li>
                            <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'readedContent']) }}"
                                   class="{{ $page == 'readedContent' ? 'profile-page' : null }}">محتواهای خوانده
                                    شده</a>
                            </li>
                            <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myAnswers']) }}"
                                   class="{{ $page == 'myAnswers' ? 'profile-page' : null }}">مشاهده پاسخ ها</a>
                            </li>
                            <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'resume']) }}"
                                   class="{{ $page == 'resume' ? 'profile-page' : null }}">رزومه</a></li>
                            <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'contents']) }}"
                                   class="{{ $page == '' ? 'profile-page' : null }}">محتواهای منتشر شده</a></li>
                        </ul>
                    </div>
                @endif
            @endif
        </div>
    </div class="col-md-12">
    <div class="col-md-4 mt-2">
        <div class="profile-div border-radius-def">
            <div class="profile-header border-radius-def" style="border-radius : 5px 5px 0 0 !important">
                @auth
                    @if(auth()->user()->id == $user->id)
                        <a href="{{ route('user.resume.edit' , ['section' => 'name&about&avatar' , 'user' => $user]) }}"
                           style="position: absolute;
    top: 10px;
    right: 34px;"><i class="material-icons-two-tone f-16">create</i></a>
                    @endif
                @endauth
                <span class="material-icons level-icon">
new_releases
</span>
                <span class="level-span">{{ $user->level }}</span>
                <img src="{{ $user->avatar ? asset($user->avatar) : asset('/images/default.png') }}" alt="آواتار"
                     width="100" class="avatar-img">
                <span class="my-blue-color username-txt">
                        @auth
                        @if(auth()->user()->id == $user->id)
                            <a href="{{ route('user.resume.edit' , ['section' => 'username' , 'user' => $user]) }}"
                               style="position: absolute;
    right: -30px;
    bottom: 3px;"><i class="material-icons-two-tone f-16">create</i></a>
                        @endif
                    @endauth
                        <a class="my-blue-color"
                           href="{{ route('user.resume' , ['user' => $user->id , 'page' => 'resume']) }}">
                            {{ $user->username }}@
                        </a>
                    </span>
            </div>
            <div class="pt-5 pr-2 pl-2 d-flex">
                <div class="col-md-4">
                    <span class="f-10" style="font-weight: bold">دنبال شونده ها</span>
                    <p style="text-align: center" class="f-14">0</p>
                </div>
                <div class="col-md-4">
                    <span class="f-10" style="font-weight: bold">دنبال کننده ها</span>
                    <p style="text-align: center" class="f-14">0</p>
                </div>
                <div class="col-md-4">
                    <span class="f-10" style="font-weight: bold">محتوای منتشر شده</span>
                    <p style="text-align: center" class="f-14">{{ $contentCount }}</p>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-md-8 mt-2 ">
        <div class="profile-div border-radius-def p-4">
            @auth
                @if(auth()->user()->id == $user->id)
                    <a href="{{ route('user.resume.edit' , ['section' => 'name&about&avatar' , 'user' => $user]) }}"
                       class="float-left"><i class="material-icons-two-tone f-16">create</i></a>
                @endif
            @endauth
            <h5 class="old-font"> {{ $user->fullName }}</h5>
            <span>{{ !$user->about ? '...' : $user->about}}</span>
        </div>
        <div class="profile-div border-radius-def p-4 mt-2">
            @auth
                @if(auth()->user()->id == $user->id)
                    <a href="{{ route('user.resume.create' , ['section' => 'expriences' , 'user' => $user]) }}"
                       class="float-left"><i class="material-icons-two-tone">add</i></a>
                @endif
            @endauth
            <h5 class="old-font"><span class="black-50">تجربیات</h5>
            <br>
            @foreach($exs as $e)
                <div class="col-md-12 box-readed mt-2 mb-2 d-block">
                    <h6 class="font-weight-bold">{{ $e->title }}</h6>
                    @auth
                        @if(auth()->user()->id == $user->id)
                            <a href="{{ route('user.resume.edit' , ['section' => 'expriences' , 'user' => $user , 'favorexid' => $e->id]) }}"
                               class="pin-link"><i class="material-icons-two-tone f-16 f-16">create</i></a>
                        @endif
                    @endauth
                    <p>{{ $e->description }}</p>
                    @if($e->media)
                        <a class="zamime-btn" href="{{ asset($e->media) }}" target="_blank">فایل ضمیمه <i
                                class="material-icons-two-tone icon-in-btn">description</i></a>
                    @endif
                    @if($e->link)
                        <a href="{{ $e->link }}" target="_blank" class="mr-4">لینک </a>
                    @endif

                    <div style="height: 10px"></div>
                </div>
            @endforeach
        </div>
        <div class="profile-div border-radius-def p-4 mt-2">
            @auth
                @if(auth()->user()->id == $user->id)
                    <a href="{{ route('user.resume.create' , ['section' => 'favs' , 'user' => $user]) }}"
                       class="float-left"><i class="material-icons-two-tone">add</i></a>
                @endif
            @endauth
            <h5 class="old-font"><span class="black-50">علاقه مندی ها</h5>
            <br>
            @foreach($favs as $f)
                <div class="col-md-12 box-readed mt-2 mb-2 d-block">
                    @auth
                        @if(auth()->user()->id == $user->id)
                            <a href="{{ route('user.resume.edit' , ['section' => 'favs' , 'user' => $user , 'favorexid' => $f->id]) }}"
                               class="pin-link"><i class="material-icons-two-tone f-16 f-16">create</i></a>
                        @endif
                    @endauth
                    <p>{{ $f->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @break
    @case('contents')
    <div class="col-md-12 profile-div">
        @if(auth()->check())
            @if(auth()->user()->id == $user->id)
                <div class="col-md-12 div-scrolable">
                    <ul class="profile-ul">
                        <li>
                            <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myInformation']) }}"
                               class="{{ $page == 'myInformation' ? 'profile-page' : null }}">اطلاعات
                                شخصی</a></li>
                        <li>
                            <a href="{{ route('profile' , ['user' => $user->id , 'page' => 'readedContent']) }}"
                               class="{{ $page == 'readedContent' ? 'profile-page' : null }}">محتواهای
                                خوانده شده</a>
                        </li>
                        <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'myAnswers']) }}"
                               class="{{ $page == 'myAnswers' ? 'profile-page' : null }}">مشاهده پاسخ ها</a>
                        </li>
                        <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'resume']) }}"
                               class="{{ $page == 'resume' ? 'profile-page' : null }}">رزومه</a></li>
                        <li><a href="{{ route('profile' , ['user' => $user->id , 'page' => 'contents']) }}"
                               class="{{ $page == 'contents' ? 'profile-page' : null }}">محتواهای منتشر شده</a></li>
                    </ul>
                </div>
            @endif
        @endif
        <div class="col-md-12 mt-5">
            <div class="container">
                <div class="row">
                    @if(count($contents) > 0)
                        @foreach($contents as $rc)
                            @auth
                                @if(auth()->user()->id == $user->id)
                                    <a href="{{ route('contents.edit' , ['content' => $rc]) }}"
                                       class="pin-link" style="z-index: 10;
    left: 34px;
    top: 28px;"><i class="material-icons-two-tone f-16 f-16">create</i></a>
                                @endif
                            @endauth
                            @auth
                                @if(auth()->user()->id == $user->id)
                                    <form action="{{ route('contents.destroy' , ['content' => $rc]) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="f-16 border-0 bg-transparent" style="    z-index: 10;
    left: 30px;
    bottom: 14px;
    position: absolute;
    top: unset;"><i class="material-icons-two-tone f-16 f-16"
                    onclick="return confirm('آیا از پاک کردن این محتوا اطمینان دارید؟')">delete</i></button>
                                    </form>
                                @endif
                            @endauth
                            <a href="{{ route('content.show' , ['content' => $rc->id , 'type' => $rc->type]) }}"
                               class="w-100">
                                <div class="col-md-12 box-readed mt-2 mb-2">
                                    <div class="col-md-3 col-xs-6">
                                        <img src="{{ asset($rc->image) }}" alt="{{ $rc->title }}"
                                             style="width: 100%;height: auto;border-radius: 5px">
                                    </div>
                                    <div class="col-md-9 col-xs-6">
                                        <h6 class="f-14 font-weight-bold old-font">{{ $rc->title }}</h6>
                                        <p class="f-10">{{ \Str::limit($rc->shortText , 70) }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div style="text-align: center;width: 100%">
                            <h4 align="center">شما محتوا ای ندارید </h4>
                            <h2 class="f-40" align="center"><i class="material-icons-two-tone">remove_red_eye</i>
                            </h2>
                            <p class="mt-2"><a href="{{ route('contents.add') }}">ایجاد محتوای جدید</a></p>
                            <br>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @break
    @endswitch
    </div>
    </div>
    </div>
    </div>
    <br>
@endsection
