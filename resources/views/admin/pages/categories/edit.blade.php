@extends('admin.app')
@section('title') ویرایش کردن
مرحله
@endsection
@section('content')
<form style="margin: auto" class="col-md-6" action="{{ route('admin.category.update' , ['category' => $category->id]) }}" enctype="multipart/form-data" method="post">
    @csrf
    {{ method_field('PATCH') }}
    <div class="form-group">
        <label for="name">نام :</label>
        <input type="text" value="{{ $category->name }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <br>
        <label for="level">مرحله :</label>
        <input type="number" value="{{ $category->level }}" name="level" class="form-control @error('level') is-invalid @enderror" id="level">
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
        <label for="image">تصویر :</label>
        <input name="image" value="{{ $category->image }}" type="file" class="form-control-file @error('image') is-invalid @enderror" id="image">
        @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
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
@endsection