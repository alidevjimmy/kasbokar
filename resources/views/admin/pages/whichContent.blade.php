@extends('admin.app')
@section('title')
    انتخاب نوع محتوا
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'PREREQUISITES']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var(--pr-green);color : var(--pr-blue);width: 100%;margin-top: 10px;font-size: 12px">پیش نیاز</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'STEP']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var(--pr-green);color : var(--pr-blue);width: 100%;margin-top: 10px;font-size: 12px">مرحله ای</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'EVENT']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var(--pr-green);color : var(--pr-blue);width: 100%;margin-top: 10px;font-size: 12px">چالش</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'JANEBI']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var(--pr-green);color : var(--pr-blue);width: 100%;margin-top: 10px;font-size: 12px">جانبی</a>
            </div>
            <div class="col-sm-6 col-md-2">
                <a href="{{ route('admin.content.create' , ['type' => 'INTRODUCTION']) }}" class="btn btn-primary" style="border-radius: 50px;background-color: var(--pr-green);color : var(--pr-blue);width: 100%;margin-top: 10px;font-size: 12px">معرفی کسب و کار</a>
            </div>

        </div>
    </div>
@endsection
