@extends('admin.app')
@section('title')
تجربه ها
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
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>کاربر</th>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th>فایل</th>
                            <th>لینک</th>
                            <th>تنضیمات</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ردیف</th>
                            <th>کاربر</th>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th>فایل</th>
                            <th>لینک</th>
                            <th>تنضیمات</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($exps as $exp)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$exp->user->phone}}</td>
                            <td>{{$exp->title}}</td>
                            <td>{{$exp->description}}</td>
                            <td><a href="{{ asset($exp->media) }}">فایل ضمیمه</a></td>
                            <td><a href="{{ asset($exp->link) }}">لینک</a></td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('admin.expriences.destroy' , ['id' => $exp->id]) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="btn {{ $exp->deleted_at ? 'btn-success' : 'btn-danger' }}" onclick="return confirm('آیا از پاک کردن تجربه اطمینان دارید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
