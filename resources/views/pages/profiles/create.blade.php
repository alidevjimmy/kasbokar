@extends('layouts.app')
@section('title')اضافه کردن
@if ($section == 'favs')
<?php $section_fa = 'علاقه مندی' ?>

@else
<?php $section_fa = 'تجربه' ?>
@endif
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
            اضافه کردن {{ $section_fa }}
        </span>
    </div>
</div>
<div class="container mt-4">
    <div class="row profile-div p-4">
        <h5 class="old-font">اضافه کردن {{ $section_fa }}</h5>
        <div class="col-md-6 mt-4" style="margin: auto">
            <form method="POST" action="#!">
                @csrf

                @if($section == 'expriences')
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('عنوان') }}</label>

                    <div class="col-md-12">
                        <i class="fa fa-user input-icon"></i> <input id="title" type="text" placeholder="عنوان..." class="form-control f-size-12 @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" style="padding-right: 30px" autocomplete="title" autofocus>

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('توضیحات') }}</label>

                    <div class="col-md-12">
                        <i class="fa fa-user input-icon"></i> <textarea rows="5" id="description" type="text" placeholder="توضیحات..." class="form-control f-size-12 @error('description') is-invalid @enderror" name="description" style="padding-right: 30px" autocomplete="description" autofocus>{{ old('description') }}</textarea>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                @if($section == 'expriences')
                <div class="form-group row">
                    <label for="media" class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('فایل ضمیمه') }}</label>

                    <div class="col-md-12">
                        <i class="fa fa-user input-icon"></i> <input id="media" type="file" placeholder="عنوان..." class="form-control f-size-12 @error('media') is-invalid @enderror" name="media" value="{{ old('media') }}" style="padding-right: 30px" autocomplete="media" autofocus>

                        @error('media')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endif
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
    </div>
</div>
@endsection