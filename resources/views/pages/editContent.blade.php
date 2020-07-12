@extends('layouts.app')
@section('title')
    ویرایش محتوا
@endsection
@section('back-icon')
    <button onclick="return history.go(-1)" class="back-icon d-sm-block d-md-none">
        <i class="material-icons-two-tone">arrow_forward</i>
    </button>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        const editor = CKEDITOR.replace('body', {
            filebrowserUploadUrl: "{{route('admin.upload.image', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        const preDiv = document.getElementById('pre-view')
        editor.on( 'change', function(e) {
            preDiv.innerHTML = editor.getData()
        });
    </script>
@endsection
@section('content')
    <div class="steper div-scrolable">
        <div class="container">
            <a href="{{ route('index') }}">
                <i class="material-icons" style="position: relative;top: 8px">home</i>
            </a>
            <i class="material-icons" style="position: relative;top: 10px">keyboard_arrow_left</i>
            <span>
            ویرایش محتوا
        </span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="profile-div border-radius-def p-4">
                    <h5 class="old-font"><span class="black-50">ویرایش محتوا</h5>
                    <br>
                    @auth
                        <div class="col-md-12 mt-2" style="margin: auto">
                            <form method="POST" action="{{ route('contents.update' , ['type' => 'content' , 'content' => $content]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row">
                                    <label for="title"
                                           class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('عنوان') }}</label>

                                    <div class="col-md-12">
                                        <i class="fa fa-user input-icon"></i> <input id="title" type="text"
                                                                                     placeholder="عنوان..."
                                                                                     class="form-control f-size-12 @error('title') is-invalid @enderror"
                                                                                     name="title"
                                                                                     value="{{ $content->title }}"
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
                                    <label for="shortText"
                                           class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('متن پیش نمایش') }}</label>

                                    <div class="col-md-12">
                                        <i class="fa fa-user input-icon"></i> <input id="shortText" type="text"
                                                                                     placeholder="متن پیش نمایش..."
                                                                                     class="form-control f-size-12 @error('shortText') is-invalid @enderror"
                                                                                     name="shortText"
                                                                                     value="{{ $content->shortText }}"
                                                                                     style="padding-right: 30px"
                                                                                     autocomplete="shortText" autofocus>

                                        @error('shortText')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image"
                                           class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('تصویر بنر') }}</label>

                                    <div class="col-md-12">
                                        <i class="fa fa-user input-icon"></i> <input id="image" type="file"
                                                                                     placeholder="تصویر بنر..."
                                                                                     class="form-control f-size-12 @error('image') is-invalid @enderror"
                                                                                     name="image"
                                                                                     value="{{ $content->image }}"
                                                                                     style="padding-right: 30px"
                                                                                     autocomplete="image">

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="body"
                                           class="col-md-4 col-form-label text-md-right f-size-14 font-weight-bold">{{ __('متن') }}</label>

                                    <div class="col-md-12">
                                        <i class="fa fa-user input-icon"></i> <textarea id="body" type="file" rows="10"
                                                                                     placeholder="متن..."
                                                                                     class="form-control f-size-12 @error('body') is-invalid @enderror"
                                                                                     name="body"
                                                                                     style="padding-right: 30px"
                                                                                        autocomplete="body">{{ $content->body }}</textarea>

                                        @error('body')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <h4 align="center" class="old-font font-weight-bold">پیش نمایش</h4>
                                <br>
                                <div class="pre-view" id=pre-view></div>
                                <br>
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
                    @else
                        <div class="alert alert-danger">برای ویراش محتوا باید <a href="{{ route('login' , ['redirect' => route('contents.add')]) }}">وارد شوید</a></div>
                        <div class="container mt-2 align-items-center">
                            <div class="row">
                                <p>برای ویراش محتوا باید <a href="{{ route('login' , ['redirect' => route('contents.add')]) }}">وارد شوید</a></p>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div style="height: 100px"></div>
@endsection
