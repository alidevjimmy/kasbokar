@extends('admin.app')
@section('title') تغییر رمز عبور @endsection
@section('content')
    <form style="margin: auto" action="{{ route('admin.changePass') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">رمزعبور جدید :</label>
            <input type="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   aria-describedby="emailHelp" placeholder="رمز جدید را وارد کنید...">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br/>
            <label for="name">تایید رمزعبور جدید :</label>
            <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password"
                   aria-describedby="emailHelp" placeholder="رمز جدید را وارد کنید...">
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">ویرایش</button>
    </form>
@endsection
