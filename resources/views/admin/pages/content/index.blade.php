@extends('admin.app')
@section('title')
محتوای
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
@section('style')
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/datatables-demo.js') }}"></script>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a class="btn btn-primary" href="{{ route('admin.content.create' , ['type' => $type]) }}">ایجاد محتوا جدید</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                switch ($type) {
                    case 'EVENT':
                ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>مرحله</th>
                                    <th>متن</th>
                                    <th>تصویر</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>مشاهده پاسخ های چالش</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>مرحله</th>
                                    <th>متن</th>
                                    <th>تصویر</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>مشاهده پاسخ های چالش</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach($contents as $content)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$content->title}}</td>
                                    <td>{{ $content->category->level }} - {{ $content->category->name }}</td>
                                    <td>{{ \Str::limit($content->body , 70) }}</td>
                                    <td><img src="{{ asset($content->image) }}" alt="تصویر" width="100" height="100" width="100" height="100" /></td>

                                    <td><a href="{{ asset($content->video) }}" target="_blank">فیلم</a></td>
                                    <td><img src="{{ asset($content->preImage) }}" alt="تصویر" width="100" height="100" width="100" height="100" /></td>
                                    <td><a class="btn btn-primary" href="{{ route('admin.answer.index' , ['type' => 'ANSWER' , 'filter' => $content->id]) }}">مشاهده</a></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.content.edit' , ['content' => $content->id , 'type' => $type]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.content.destroy' , ['content' => $content->id , 'type' => $type]) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" onclick="return confirm('میخواهید این مورد را پاک کنید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    <?php
                        break;
                    case 'PREREQUISITES':
                    ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach($contents as $content)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$content->title}}</td>
                                    <td>{{ \Str::limit($content->body , 70) }}</td>
                                    <td><a href="{{ asset($content->video) }}" target="_blank">فیلم</a></td>
                                    <td><img src="{{ asset($content->image) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.content.edit' , ['content' => $content->id , 'type' => $type]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.content.destroy' , ['content' => $content->id , 'type' => $type]) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" onclick="return confirm('میخواهید این مورد را پاک کنید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    <?php
                        break;
                    case 'STEP':
                    ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن پیش نمایش</th>
                                    <th>مرحله</th>
                                    <th>متن</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>تصویر</th>
                                    <th> تصویر بنر</th>
                                    <th>مشاغل ضروری</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن پیش نمایش</th>
                                    <th>مرحله</th>
                                    <th>متن</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>تصویر</th>
                                    <th> تصویر بنر</th>
                                    <th>مشاغل ضروری</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach($contents as $content)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$content->title}}</td>
                                    <td>{{ $content->shortText }}</td>
                                    <td>{{ $content->category->level }} - {{ $content->category->name }}</td>
                                    <td>{{ \Str::limit($content->body , 70) }}</td>
                                    <td><a href="{{ asset($content->video) }}" target="_blank">فیلم</a></td>
                                    <td><img src="{{ asset($content->preImage) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td><img src="{{ asset($content->image) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td><img src="{{ asset($content->banerImage) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td>
                                        @if($content->shouldJobs != "null")
                                        @foreach(json_decode($content->shouldJobs) as $job)
                                        @switch($job)
                                        @case('EMPLOYEE')
                                        کارمند
                                        @break
                                        @case('HOMEKEEPER')
                                        خانه دار
                                        @break
                                        @case('STUDENT')
                                        داشنجو / دانش آموز
                                        @break
                                        @case('JOBKEEPER')
                                        جویای کار
                                        @break
                                        @endswitch
                                        ,
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.content.edit' , ['content' => $content->id , 'type' => $type]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.content.destroy' , ['content' => $content->id , 'type' => $type]) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" onclick="return confirm('میخواهید این مورد را پاک کنید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    <?php
                        break;
                    case 'INTRODUCTION':
                    ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>لوگو</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>لوگو</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach($contents as $content)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$content->title}}</td>
                                    <td>{{$content->body}}</td>
                                    <td><img src="{{ asset($content->logo) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.content.edit' , ['content' => $content->id , 'type' => $type]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.content.destroy' , ['content' => $content->id , 'type' => $type]) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" onclick="return confirm('میخواهید این مورد را پاک کنید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    <?php
                        break;
                    case 'JANEBI':
                    ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن پیش نمایش</th>
                                    <th>متن</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>تصویر</th>
                                    <th> تصویر بنر</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>متن پیش نمایش</th>
                                    <th>متن</th>
                                    <th>فیلم</th>
                                    <th>تصویر پیش نمایش</th>
                                    <th>تصویر</th>
                                    <th> تصویر بنر</th>
                                    <th>تنضیمات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach($contents as $content)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$content->title}}</td>
                                    <td>{{ $content->shortText }}</td>
                                    <td>{{ \Str::limit($content->body , 70) }}</td>
                                    <td><a href="{{ asset($content->video) }}" target="_blank">فیلم</a></td>
                                    <td><img src="{{ asset($content->preImage) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td><img src="{{ asset($content->image) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td><img src="{{ asset($content->banerImage) }}" alt="تصویر" width="100" height="100" /></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.content.edit' , ['content' => $content->id , 'type' => $type]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.content.destroy' , ['content' => $content->id , 'type' => $type]) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" onclick="return confirm('میخواهید این مورد را پاک کنید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                            </tbody>
                        </table>
                <?php
                        break;
                };
                ?>
            </div>
        </div>
    </div>

</div>
@endsection