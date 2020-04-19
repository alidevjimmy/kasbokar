@extends('admin.app')
@section('title') ویرایش کردن
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
<form style="margin: auto" class="col-md-6" action="{{ route('admin.content.update' , ['content' => $content->id , 'type' => $type]) }}" enctype="multipart/form-data" method="post">
    @csrf
    {{ method_field('PATCH') }}
    <div class="form-group">
        <?php
        switch ($type) {
            case 'EVENT':
        ?>
                <label for="title">عنوان :</label>
                <input type="text" value="{{ $content->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="category_id">مرحله :</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"  {{ $content->category_id == $category->id ? 'selected' : '' }}>مرحله {{ $category->level }} - {{ $category->name }}</option>
                    @endforeach    
                </select>
                @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body" class="form-control @error('body') is-invalid @enderror" id="body">{{ $content->body }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="video">فیلم :</label>
                <input name="video" value="{{ $content->video }}" type="file" class="form-control-file @error('video') is-invalid @enderror" id="video">
                @error('video')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="preImage">تصویر پیش نمایش فیلم:</label>
                <input name="preImage" value="{{ $content->preImage }}" type="file" class="form-control-file @error('preImage') is-invalid @enderror" id="preImage">
                @error('preImage')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>

                </span>
                @enderror
            <?php
                break;
            case 'PREREQUISITES':
            ?>
                <label for="title">عنوان :</label>
                <input type="text" value="{{ $content->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="level">سطح دسترسی :</label>
                <input type="number" value="{{ $content->level }}" name="level" class="form-control @error('level') is-invalid @enderror" id="level">
                @error('level')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body" class="form-control @error('body') is-invalid @enderror" id="body">{{ $content->body }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="video">فیلم :</label>
                <input name="video" value="{{ $content->video }}" type="file" class="form-control-file @error('video') is-invalid @enderror" id="video">
                @error('video')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="image">تصویر پیش نمایش فیلم:</label>
                <input name="image" value="{{ $content->image }}" type="file" class="form-control-file @error('image') is-invalid @enderror" id="image">
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
                <input type="text" value="{{ $content->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="shortText">متن پیش نمایش :</label>
                <input type="text" value="{{ $content->shortText }}" name="shortText" class="form-control @error('shortText') is-invalid @enderror" id="shortText">
                @error('shortText')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="category_id">مرحله :</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"  {{ $content->category_id == $category->id ? 'selected' : '' }}>مرحله {{ $category->level }} - {{ $category->name }}</option>
                    @endforeach    
                </select>
                @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body" class="form-control @error('body') is-invalid @enderror" id="body">{{ $content->body }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="shouldJibs">مشاغل ضروری :</label>
                <select multiple name="shouldJobs[]" class="form-control @error('shouldJibs') is-invalid @enderror">
                    <option value="" disabled {{ !$content->shouldJobs ? 'selected' : '' }}>وضعیت
                        شغلی
                    </option>
                    <option value="EMPLOYEE" {{ $content->shouldJobs == 'EMPLOYEE' ? 'selected' : '' }}>
                        کارمند
                    </option>
                    <option value="HOMEKEEPER" {{ $content->shouldJobs == 'HOMEKEEPER' ? 'selected' : '' }}>
                        خانه دار
                    </option>
                    <option value="STUDENT" {{ $content->shouldJobs == 'STUDENT' ? 'selected' : '' }}>
                        دانشجو / دانش آموز
                    </option>
                    <option value="JOBKEEPER" {{ $content->shouldJobs == 'JOBKEEPER' ? 'selected' : '' }}>
                        جویای کار
                    </option>
                </select>
                @error('shouldJobs')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br />
                <label for="video">فیلم :</label>
                <input name="video" value="{{ $content->video }}" type="file" multiple class="form-control-file @error('video') is-invalid @enderror" id="video">
                @error('video')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="preImage">تصویر پیش نمایش فیلم:</label>
                <input name="preImage" value="{{ $content->preImage }}" type="file" multiple class="form-control-file @error('preImage') is-invalid @enderror" id="preImage">
                @error('preImage')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="banerImage">تصویر بنر:</label>
                <input name="banerImage" value="{{ $content->banerImage }}" type="file" class="form-control-file @error('banerImage') is-invalid @enderror" id="banerImage">
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
                <input type="text" value="{{ $content->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body" class="form-control @error('body') is-invalid @enderror" id="body">{{ $content->body }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br />
                <label for="logo">لوگو:</label>
                <input name="logo" value="{{ $content->logo }}" type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo">
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
                <input type="text" value="{{ $content->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="shortText">متن پیش نمایش :</label>
                <input type="text" value="{{ $content->shortText }}" name="shortText" class="form-control @error('shortText') is-invalid @enderror" id="shortText">
                @error('shortText')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="body">متن :</label>
                <textarea type="text" name="body" class="form-control @error('body') is-invalid @enderror" id="body">{{ $content->body }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="video">فیلم :</label>
                <input name="video" value="{{ $content->video }}" type="file" multiple class="form-control-file @error('video') is-invalid @enderror" id="video">
                @error('video')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="preImage">تصویر پیش نمایش فیلم:</label>
                <input name="preImage" value="{{ $content->preImage }}" type="file" multiple class="form-control-file @error('preImage') is-invalid @enderror" id="preImage">
                @error('preImage')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <label for="banerImage">تصویر بنر:</label>
                <input name="banerImage" value="{{ $content->banerImage }}" type="file" class="form-control-file @error('banerImage') is-invalid @enderror" id="banerImage">
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

    <button onclick="uploading()" type="submit" class="btn btn-primary">ویرایش</button>
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
<script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('body', {
        filebrowserUploadUrl: "{{route('admin.upload.image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection