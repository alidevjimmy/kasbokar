@extends('admin.app')
@section('title') ویرایش کردن نوتیفیکیشن @endsection
@section('content')
    <form style="margin: auto" class="col-md-6" action="{{ route('admin.notifications.update' , $notification->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="title">عنوان نوتیفیکیشن :</label>
            <input type="text" value="{{ $notification->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                   aria-describedby="emailHelp" placeholder="عنوان نوتیفیکیشن را وارد کنید ...">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <label for="link">لینک نوتیفیکیشن :</label>
            <input type="text" value="{{ $notification->link }}" name="link" class="form-control @error('link') is-invalid @enderror" id="link"
                   aria-describedby="emailHelp" placeholder="لینک نوتیفیکیشن را وارد کنید ...">
            @error('link')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <label for="body">متن نوتیفیکیشن :</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body"
                      placeholder="متن نوتیفیکیشن را وارد کنید ...">{{ $notification->body }}</textarea>
            @error('body')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <label for="sendDate">زمان ارسال نوتیفیکیشن :</label>
            <input type="datetime-local" name="sendDate" class="form-control @error('sendDate') is-invalid @enderror" id="sendDate"
                   placeholder="زمان ارسال نوتیفیکیشن را وارد کنید ...">
            @error('sendDate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            زمان قبلی : {{ $notification->sendDate }}
            <br>
            الان : {{ \Carbon\Carbon::now() }}
            <br>
        </div>

        <button type="submit" class="btn btn-primary">ویرایش</button>
    </form>
@endsection
