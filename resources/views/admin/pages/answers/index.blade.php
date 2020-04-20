@extends('admin.app')
@section('title')
@if($type == 'ANSWER')
پاسخ کاربران
@else
پاسخ ادمین
@endif
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
                    @if ($type == 'ANSWER')
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>پاسخ</th>
                            <th>کاربر</th>
                            <th>تایید</th>
                            <th>چالش</th>
                            <th>ریپلای ها</th>
                            <th>ارسال ریپلای</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ردیف</th>
                            <th>پاسخ</th>
                            <th>کاربر</th>
                            <th>تایید</th>
                            <th>چالش</th>
                            <th>ریپلای ها</th>
                            <th>ارسال ریپلای</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($answers as $ans)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{!! $ans->answer !!}</td>
                            <td>{{ $ans->user->fullName }} - {{ $ans->user->email }}</td>
                            <td>{{ $ans->accepted ? 'بله' : 'خیر' }}</td>
                            <td>{{ $ans->content_id }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.answer.index' , ['type' => 'REPLAY' , 'filter' => $ans->id]) }}">مشاهده</a></td>
                            <td><a class="btn btn-primary" href="{{ route('admin.answer.edit' , ['answer' => $ans->id]) }}">ارسال</a></td>

                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                    @else
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>پاسخ</th>
                            <th>به</th>
                            <th>تنضیمات</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ردیف</th>
                            <th>پاسخ</th>
                            <th>به</th>
                            <th>تنضیمات</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($answers as $ans)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{!! $ans->replay !!}</td>
                            <td>{{ $ans->answer->answer }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.replay.edit' , ['replay' => $ans->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.replay.destroy' , ['replay' => $ans->id]) }}" method="post">
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
                    @endif
                </table>

            </div>
        </div>
    </div>

</div>
@endsection