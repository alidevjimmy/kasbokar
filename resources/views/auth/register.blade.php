@extends('layouts.full')
@section('title')
    ثبت نام
@endsection
@section('content')
    <div class="container">
        <div class="align-content-center row p-5" style="justify-content: center">
            <a href="{{ route('index') }}" style="text-decoration: none !important;color: black !important;">
                <img src="{{ asset('/images/photo_2020-04-03_15-45-58.png') }}" class="fullpagelogo" alt="Logo">
                <span style="align-self: center;margin-right: 5px;font-size: 12px;"><b>مدرسه کسب و کار</b></span>
            </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="pb-3">
                    <a href="{{ route('login') }}" class="btn-hashie font-weight-bold float-left">
                        ورود
                    </a>
                    <button onclick="return history.go(-1)" class="btn-back"><i class="fa fa-arrow-right btn-icons"></i>
                        بازگشت
                    </button>
                </div>
                <div class="loginform">
                    <div class="head-form font-weight-bold">
                        <b><h6>ایجاد حساب کاربری</h6></b>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="fullName"
                                       class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('نام کامل') }}</label>

                                <div class="col-md-12">


            <i class="fa fa-user input-icon"></i>                        <input id="fullName" type="text" placeholder="نام کامل..."
                                           class="form-control f-size-12 @error('fullName') is-invalid @enderror"
                                           name="fullName"
                                           value="{{ old('fullName') }}" style="padding-right: 30px"
                                           autocomplete="fullName" autofocus>

                                    @error('fullName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('شماره تلفن') }}</label>

                                <div class="col-md-12">
                                    <i class="fa fa-phone-alt input-icon"></i>
                                    <input id="phone" type="text" placeholder="شماره تلفن..."
                                           class="form-control f-size-12 @error('phone') is-invalid @enderror"
                                           name="phone"
                                           value="{{ old('phone') }}" style="padding-right: 30px" autocomplete="phone"
                                           autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('ایمیل') }}</label>

                                <div class="col-md-12">
                                    <i class="fa fa-envelope input-icon"></i>
                                    <input id="email" type="email" placeholder="ایمیل..."
                                           class="form-control f-size-12 @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}" style="padding-right: 30px" autocomplete="email">

                                    @error('email')
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
                                    <select name="workStatus"
                                            style="padding-right: 30px"
                                            class="form-control f-size-12 @error('workStatus') is-invalid @enderror">
                                        <option value="" disabled {{ !old('workStatus') ? 'selected' : '' }}>وضعیت
                                            شغلی
                                        </option>
                                        <option
                                            value="EMPLOYEE" {{ old('workStatus') == 'EMPLOYEE' ? 'selected' : '' }}>
                                            کارمند
                                        </option>
                                        <option
                                            value="HOMEKEEPER" {{ old('workStatus') == 'HOMEKEEPER' ? 'selected' : '' }}>
                                            خانه دار
                                        </option>
                                        <option value="STUDENT" {{ old('workStatus') == 'STUDENT' ? 'selected' : '' }}>
                                            دانشجو / دانش آموز
                                        </option>
                                        <option
                                            value="JOBKEEPER" {{ old('workStatus') == 'JOBKEEPER' ? 'selected' : '' }}>
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

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('رمز عبور') }}</label>

                                <div class="col-md-12">
                                    <i class="fa fa-lock input-icon"></i>
                                    <input id="password" type="password"
                                           placeholder="رمز عبور"
                                           class="form-control f-size-12 @error('password') is-invalid @enderror"
                                           name="password"
                                           style="padding-right: 30px" autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('تکرار رمز عبور') }}</label>

                                <div class="col-md-12">
                                    <i class="fa fa-lock-open input-icon"></i>
                                    <input placeholder="تکرار رمز عبور..." id="password-confirm" type="password" class="form-control f-size-12"
                                           name="password_confirmation" style="padding-right: 30px"
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 btn-group" style="direction: ltr">
                                    <div class="float-left">
                                        <button style="width: 100%" type="submit" class="btn-back">
                                            {{ __('ثبت نام') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
