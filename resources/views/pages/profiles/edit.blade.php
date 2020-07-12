@extends('layouts.app')
@section('title')
    ویرایش کردن
    <?php
    switch ($section) {
        case 'name&about&avatar':
            $section_fa = 'مشخصات';
            break;
        case 'username':
            $section_fa = 'نام کاربری';
            break;
        case 'favs':
            $section_fa = 'علاقه مندی';
            break;
        case 'expriences':
            $section_fa = 'تجربه';
            break;
    }
    ?>
    {{ $section_fa }}
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
            <a href="{{ route('profile' , ['user' => $user , 'page' => 'resume']) }}">
                پروفایل
            </a>
            <i class="material-icons" style="position: relative;top: 10px">keyboard_arrow_left</i>
            <span href="{{ route('profile' , ['user' => $user->id]) }}">
             ویرایش کردن {{ $section_fa }}
        </span>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row profile-div p-4">
            <h5 class="old-font">ویرایش کردن {{ $section_fa }}</h5>
            <div class="col-md-6 mt-4" style="margin: auto">
                <form method="POST"
                      action="
    @if($section == 'favs')
                      {{ route('user.resume.update' , ['section' => $section , 'user' => $user , 'fav' => $fav->id]) }}
                      @elseif($section == 'expriences')
                      {{ route('user.resume.update' , ['section' => $section , 'user' => $user , 'ex' => $ex->id]) }}
                      @else
                      {{ route('user.resume.update' , ['section' => $section , 'user' => $user]) }}
                      @endif
                          "
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @switch($section)
                        @case('username')
                        <div class="form-group row">
                            <label for="username"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('نام کاربری') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <input id="username" type="text"
                                                                             placeholder="نام کاربری..."
                                                                             class="form-control f-size-12 @error('username') is-invalid @enderror"
                                                                             name="username"
                                                                             value="{{ $user->username }}"
                                                                             style="padding-right: 30px"
                                                                             autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        @break
                        @case('favs')
                        <div class="form-group row">
                            <label for="description"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('توضیحات') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <input id="description" type="text"
                                                                             placeholder="توضیحات..."
                                                                             class="form-control f-size-12 @error('description') is-invalid @enderror"
                                                                             name="description"
                                                                             value="{{ $fav->description }}"
                                                                             style="padding-right: 30px"
                                                                             autocomplete="description" autofocus>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        @break
                        @case('name&about&avatar')
                        <div class="form-group row">
                            <label for="fullName"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('نام کاربری') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <input id="fullName" type="text"
                                                                             placeholder="نام کاربری..."
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
                            <label for="about"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('درباره من') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <textarea id="about" type="text"
                                                                                placeholder="درباره من..."
                                                                                class="form-control f-size-12 @error('about') is-invalid @enderror"
                                                                                name="about"
                                                                                style="padding-right: 30px"
                                                                                autocomplete="about"
                                                                                autofocus>{{ $user->about }}</textarea>

                                @error('about')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="avatar"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('آواتار') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <input id="avatar" type="file"
                                                                             placeholder="آواتار..."
                                                                             class="form-control f-size-12 @error('avatar') is-invalid @enderror"
                                                                             name="avatar"
                                                                             value="{{ $user->avatar }}"
                                                                             style="padding-right: 30px"
                                                                             autocomplete="avatar" autofocus>

                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        @break
                        @case('expriences')

                        <div class="form-group row">
                            <label for="title"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('عنوان') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <input id="title" type="text"
                                                                             placeholder="عنوان..."
                                                                             class="form-control f-size-12 @error('title') is-invalid @enderror"
                                                                             name="title" value="{{ $ex->title }}"
                                                                             style="padding-right: 30px"
                                                                             autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('توضیحات') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <textarea rows="5" id="description" type="text"
                                                                                placeholder="توضیحات..."
                                                                                class="form-control f-size-12 @error('description') is-invalid @enderror"
                                                                                name="description"
                                                                                style="padding-right: 30px"
                                                                                autocomplete="description"
                                                                                autofocus>{{ $ex->description }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="media"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('فایل ضمیمه') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <input id="media" type="file"
                                                                             placeholder="فایل ضمیمه..."
                                                                             class="form-control f-size-12 @error('media') is-invalid @enderror"
                                                                             name="media" value="{{ $ex->media }}"
                                                                             style="padding-right: 30px"
                                                                             autocomplete="media" autofocus>

                                @error('media')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="link"
                                   class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('لینک') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-user input-icon"></i> <input id="link" type="text" placeholder="لینک..."
                                                                             class="form-control f-size-12 @error('link') is-invalid @enderror"
                                                                             name="link" value="{{ $ex->link }}"
                                                                             style="padding-right: 30px"
                                                                             autocomplete="link" autofocus>

                                @error('link')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                                <small>لینک اجباری نیست.</small>
                            </div>
                        </div>
                        @break
                    @endswitch
                    <div class="form-group row mb-0">
                        <div class="col-md-12 btn-group" style="direction: ltr">
                            <div class="float-left">
                                <button style="width: 100%" type="submit" class="btn-back">
                                    {{ __('ذخیره') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
