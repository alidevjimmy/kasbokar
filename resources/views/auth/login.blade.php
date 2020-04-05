@extends('layouts.full')
@section('title')
    ورود
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
            <div class="col-md-5 col-sm-12">
                <div class="pb-3">
                    <a href="{{ route('register') }}" class="btn-hashie font-weight-bold float-left">
                        ثبت نام
                    </a>
                    <button onclick="return history.go(-1)" class="btn-back"><i class="fa fa-arrow-right btn-icons"></i>
                        بازگشت
                    </button>
                </div>
                <div class="loginform">
                    <div class="head-form font-weight-bold">
                        <b><h6>ورود به حساب کاربری</h6></b>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('شماره تلفن') }}</label>

                                <div class="col-md-12">
                                    <i class="fa fa-phone-alt input-icon"></i>
                                    <input id="phone" type="text"
                                           class="form-control f-size-12 @error('phone') is-invalid @enderror"
                                           name="phone"
                                           value="{{ old('phone') }}" autocomplete="phone" autofocus
                                           style="padding-right: 30px" placeholder="شماره تلفن...">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('رمز عبور') }}</label>

                                <div class="col-md-12 d-flex">
                                    <i class="fa fa-fingerprint input-icon"></i>
                                    <input id="password" type="password"
                                           class="form-control f-size-12 col-md-8 @error('password') is-invalid @enderror"
                                           name="password"
                                           autocomplete="current-password" placeholder="رمز عبور..."
                                           style="padding-right: 30px;border-radius: 0px 5px 5px 0px;border-left: 0">
                                    <div
                                        style="height: 100%;border: 1px solid #ced4da;border-radius: 5px 0px 0px 5px;padding: 0;text-align: center;"
                                        class="f-size-12 col-md-4 forget-pass">
                                        <a href="{{ route('password.request') }}" class="font-weight-bold"
                                           style="width: 100%;height: 100%;color : var(--pr-blue) !important;position: relative; top: 8px;">فراموش
                                            کردید؟</a>
                                    </div>
                                    @error('password')
                                    <div class="col-md-12">

                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 btn-group" style="direction: ltr">
                                    <div class="float-left">
                                        <button style="width: 100%" type="submit" class="btn-back">
                                            {{ __('ورود') }}
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
