@extends('admin.app')
@section('title') 
ارسال ریپلای
@endsection
@section('content')
<form style="margin: auto" class="col-md-6" action="{{ route('admin.answer.update' , ['answer' => $answer->id]) }}" enctype="multipart/form-data" method="post">
    @csrf
    <p>{{ $answer->answer }}</p>
    <br>
    <div class="form-group">
        <label for="replay">متن :</label>
        <textarea type="text"  name="replay" class="form-control @error('replay') is-invalid @enderror" id="replay">
        {{ old('replay') }}
        </textarea>
        @error('replay')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <br>
        <label for="accepted">تایید :</label>
        <input type="checkbox" name="accepted" class="@error('accepted') is-invalid @enderror" id="accepted">
        <small>نزدن چک باکس به بدین معناست که پاسخ او رد شده است</small>
        @error('accepted')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button onclick="uploading()" type="submit" class="btn btn-primary">ارسال</button>
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
    CKEDITOR.replace('replay', {
        filebrowserUploadUrl: "{{route('admin.upload.image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection