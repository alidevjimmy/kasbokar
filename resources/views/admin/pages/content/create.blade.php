@extends('admin.app')
@section('title') اضافه کردن
<?php
switch ($type) {
    case 'EVENT':
        echo 'چالش';
        break;
    case 'PREREQUISITES':
        echo 'پیش نیاز';
        break;
    case 'STEP':
        echo 'مرحله ای';
        break;
    case 'INTRODUCTION':
        echo 'معرفی کسب و کار';
        break;
    case 'JANEBI':
        echo 'جانبی';
        break;
};
?>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'PREREQUISITES']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var({{ $type == 'PREREQUISITES' ? '--pr-blue' : '--pr-green' }});color : var({{ $type == 'PREREQUISITES' ? '--pr-green' : '--pr-blue' }});width: 100%;margin-top: 10px;font-size: 12px">پیش نیاز</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'STEP']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var({{ $type == 'STEP' ? '--pr-blue' : '--pr-green' }});color : var({{ $type == 'STEP' ? '--pr-green' : '--pr-blue' }});width: 100%;margin-top: 10px;font-size: 12px">مرحله ای</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'EVENT']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var({{ $type == 'EVENT' ? '--pr-blue' : '--pr-green' }});color : var({{ $type == 'EVENT' ? '--pr-green' : '--pr-blue' }});width: 100%;margin-top: 10px;font-size: 12px">چالش</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'JANEBI']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var({{ $type == 'JANEBI' ? '--pr-blue' : '--pr-green' }});color : var({{ $type == 'JANEBI' ? '--pr-green' : '--pr-blue' }});width: 100%;margin-top: 10px;font-size: 12px">جانبی</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'INTRODUCTION']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var({{ $type == 'INTRODUCTION' ? '--pr-blue' : '--pr-green' }});color : var({{ $type == 'INTRODUCTION' ? '--pr-green' : '--pr-blue' }});width: 100%;margin-top: 10px;font-size: 12px">معرفی کسب و کار</a>
            </div>

        </div>
    </div>
    <form style="margin: auto" class="col-md-6 mt-3" action="{{ route('admin.content.store' , ['type' => $type]) }}"
          enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            <?php
            switch ($type) {
            case 'EVENT':
            ?>
            <label for="title">عنوان :</label>
            <input type="text" value="{{ old('title') }}" name="title"
                   class="form-control @error('title') is-invalid @enderror" id="title">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label for="level">سطح دسترسی :</label>
            <input type="number" value="{{ old('level') }}" name="level"
                   class="form-control @error('level') is-invalid @enderror" id="level">
            @error('level')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label for="body">متن :</label>
            <textarea type="text" name="body"
                      class="form-control @error('body') is-invalid @enderror" id="body">{{ old('body') }}</textarea>
            @error('body')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label for="image">تصویر :</label>
            <input name="image" value="{{ old('image') }}" type="file"
                   class="form-control-file @error('image') is-invalid @enderror" id="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <?php
            break;
            case 'PREREQUISITES':
            ?>
            <label for="title">عنوان :</label>
            <input type="text" value="{{ old('title') }}" name="title"
                   class="form-control @error('title') is-invalid @enderror" id="title">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label for="level">سطح دسترسی :</label>
            <input type="number" value="{{ old('level') }}" name="level"
                   class="form-control @error('level') is-invalid @enderror" id="level">
            @error('level')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label for="body">متن :</label>
            <textarea type="text" name="body"
                      class="form-control @error('body') is-invalid @enderror" id="body">{{ old('body') }}</textarea>
            @error('body')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label for="video">فیلم :</label>
            <input name="video" value="{{ old('video') }}" type="file"
                   class="form-control-file @error('video') is-invalid @enderror" id="video">
            @error('video')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <label for="image">تصویر پیش نمایش فیلم:</label>
            <input name="image" value="{{ old('image') }}" type="file"
                   class="form-control-file @error('image') is-invalid @enderror" id="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>

            </span>
            @enderror
            <?php
            break;
            case 'STEP':
                ?>
                <label for="title">عنوان :</label>
                <input type="text" value="{{ old('title') }}" name="title"
                       class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="shortText">متن پیش نمایش :</label>
                <input type="text" value="{{ old('shortText') }}" name="shortText"
                       class="form-control @error('shortText') is-invalid @enderror" id="shortText">
                @error('shortText')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="level">سطح دسترسی :</label>
                <input type="number" value="{{ old('level') }}" name="level"
                       class="form-control @error('level') is-invalid @enderror" id="level">
                @error('level')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body"
                          class="form-control @error('body') is-invalid @enderror" id="body">{{ old('body') }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="shouldJibs">مشاغل ضروری :</label>
                <select multiple
                    name="shouldJobs[]"
                    class="form-control @error('shouldJibs') is-invalid @enderror" >
                    <option value="" disabled {{ !old('shouldJobs') ? 'selected' : '' }}>وضعیت
                        شغلی
                    </option>
                    <option
                        value="EMPLOYEE" {{ old('shouldJobs') == 'EMPLOYEE' ? 'selected' : '' }}>
                        کارمند
                    </option>
                    <option
                        value="HOMEKEEPER" {{ old('shouldJobs') == 'HOMEKEEPER' ? 'selected' : '' }}>
                        خانه دار
                    </option>
                    <option value="STUDENT" {{ old('shouldJobs') == 'STUDENT' ? 'selected' : '' }}>
                        دانشجو / دانش آموز
                    </option>
                    <option
                        value="JOBKEEPER" {{ old('shouldJobs') == 'JOBKEEPER' ? 'selected' : '' }}>
                        جویای کار
                    </option>
                </select>
                @error('shouldJobs')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br/>
                <label for="video">فیلم :</label>
                <input name="video" value="{{ old('video') }}" type="file" multiple
                       class="form-control-file @error('video') is-invalid @enderror" id="video">
                @error('video')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
                <br>
                <label for="preImage">تصویر پیش نمایش فیلم:</label>
                <input name="preImage" value="{{ old('preImage') }}" type="file" multiple
                       class="form-control-file @error('preImage') is-invalid @enderror" id="preImage">
                @error('preImage')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="image">تصویر:</label>
                <input name="image" value="{{ old('image') }}" type="file"
                       class="form-control-file @error('image') is-invalid @enderror" id="image">
                @error('image')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="banerImage">تصویر بنر:</label>
                <input name="banerImage" value="{{ old('banerImage') }}" type="file"
                       class="form-control-file @error('banerImage') is-invalid @enderror" id="banerImage">
                @error('banerImage')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror

            <?php
                break;
            case 'INTRODUCTION':
                ?>
                <label for="title">عنوان :</label>
                <input type="text" value="{{ old('title') }}" name="title"
                       class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body"
                          class="form-control @error('body') is-invalid @enderror" id="body">{{ old('body') }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br/>
                <label for="logo">لوگو:</label>
                <input name="logo" value="{{ old('logo') }}" type="file"
                       class="form-control-file @error('logo') is-invalid @enderror" id="logo">
                @error('logo')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror

            <?php
                break;
            case 'JANEBI':
                ?>
                <label for="title">عنوان :</label>
                <input type="text" value="{{ old('title') }}" name="title"
                       class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="shortText">متن پیش نمایش :</label>
                <input type="text" value="{{ old('shortText') }}" name="shortText"
                       class="form-control @error('shortText') is-invalid @enderror" id="shortText">
                @error('shortText')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body"
                          class="form-control @error('body') is-invalid @enderror" id="body">{{ old('body') }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="video">فیلم :</label>
                <input name="video" value="{{ old('video') }}" type="file" multiple
                       class="form-control-file @error('video') is-invalid @enderror" id="video">
                @error('video')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
                <br>
                <label for="preImage">تصویر پیش نمایش فیلم:</label>
                <input name="preImage" value="{{ old('preImage') }}" type="file" multiple
                       class="form-control-file @error('preImage') is-invalid @enderror" id="preImage">
                @error('preImage')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="image">تصویر:</label>
                <input name="image" value="{{ old('image') }}" type="file"
                       class="form-control-file @error('image') is-invalid @enderror" id="image">
                @error('image')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="banerImage">تصویر بنر:</label>
                <input name="banerImage" value="{{ old('banerImage') }}" type="file"
                       class="form-control-file @error('banerImage') is-invalid @enderror" id="banerImage">
                @error('banerImage')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
    <?php
                break;
            };
            ?>
        </div>

        <button onclick="uploading()" type="submit" class="btn btn-primary">ثبت</button>
        <br>
        <br>
        <span id="uploadingtext" class="text-xs font-weight-bold border-left-success p-1 alert-success text-success">در حال آپلود کردن...</span>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        let uploadingText = document.getElementById('uploadingtext');
        uploadingText.style.display = 'none';
        const uploading = () => {
            uploadingText.style.display = "inline";
        }
    </script>
@endsection
