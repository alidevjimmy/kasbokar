@extends('admin.app')
@section('title') ویرایش کردن آلارم @endsection
@section('content')
    <form style="margin: auto" class="col-md-6" action="{{ route('admin.content.update' , $voice->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="name">نام آلارم :</label>
            <input type="text" value="{{ $voice->name }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                   aria-describedby="emailHelp" placeholder="نام آلارم را وارد کنید ...">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>فیلد نام آلارم را پر کنید</strong>
            </span>
            @enderror
            <br>
            آلارم فعلی : <a target="_blank" href="{{ $voice->url }}">{{ $voice->url }}</a>
            <br>
            <label for="voice">فایل آلارم جدید:</label>
            <input name="voice" value="{{ old('voice') }}" type="file" class="form-control-file @error('voice') is-invalid @enderror" id="voice">
            @error('voice')
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

