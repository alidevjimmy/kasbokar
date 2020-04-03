@extends('admin.app')
@section('title') نوتیفیکیشن ها ها @endsection
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
                <a class="btn btn-primary" href="{{ route('admin.notifications.create') }}">ایجاد آلارم جدید</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>عنوان</th>
                            <th>لینک</th>
                            <th>متن</th>
                            <th>زمان ارسال</th>
                            <th>تنضیمات</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>عنوان</th>
                            <th>لیمک</th>
                            <th>متن</th>
                            <th>زمان ارسال</th>
                            <th>تنضیمات</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1 ?>
                            @foreach($notifications as $notification)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$notification->title}}</td>
                                    <td><a href="{{$notification->link}}">{{$notification->link}}</a></td>
                                    <td>{{ $notification->body }}</td>
                                    <td>{{ $notification->sendDate }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.notifications.edit' , $notification->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.notifications.destroy' , $notification->id) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" onclick="return confirm('آیا میخواید نوتیفیکیشن با عنوان {{ $notification->name }} را حذف کنید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
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
