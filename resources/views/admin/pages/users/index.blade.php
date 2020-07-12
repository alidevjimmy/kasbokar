@extends('admin.app')
@section('title')
کاربر ها
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
                            <th>نام کامل</th>
                            <th>ایمیل</th>
                            <th>نام کاربری</th>
                            <th>شماره تلفن</th>
                            <th>مرحله</th>
                            <th>وضعیت شغلی</th>
                            <th>کامنت ها</th>
                            <th>علاقه مندی ها</th>
                            <th>تجربه ها</th>
                            <th>تنضیمات</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ردیف</th>
                            <th>نام کامل</th>
                            <th>ایمیل</th>
                            <th>نام کاربری</th>
                            <th>شماره تلفن</th>
                            <th>مرحله</th>
                            <th>وضعیت شغلی</th>
                            <th>کامنت ها</th>
                            <th>علاقه مندی ها</th>
                            <th>تجربه ها</th>
                            <th>تنضیمات</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$user->fullName}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{ $user->level }}</td>
                            <?php
                                switch ($user->workStatus) {
                                    case 'EMPLOYEE':
                                        $workStatus = 'کارمند';
                                        break;
                                    case 'HOMEKEEPER':
                                        $workStatus = 'خانه دار';
                                        break;
                                    case 'STUDENT':
                                        $workStatus = 'دانش آموز / دانشجو';
                                        break;
                                    case 'JOBKEEPER':
                                        $workStatus = 'جویای کار';
                                        break;
                                }
                            ?>
                            <td>{{ $workStatus }}</td>
                            <td><a href="#!" class="btn btn-sm btn-outline-dark">کامنت ها</a></td>
                            <td><a href="{{ route('admin.favs.index' , ['id' => $user->id]) }}" class="btn btn-sm btn-outline-dark">علاقه مندی ها</a></td>
                            <td><a href="{{ route('admin.expriences.index' , ['id' => $user->id]) }}" class="btn btn-sm btn-outline-dark">تجربه ها</a></td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('admin.users.destroy' , ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="btn {{ $user->deleted_at ? 'btn-success' : 'btn-danger' }}" onclick="return confirm('زمانی که کاربر را غیر فعال کنید ، تمام فعالیت های او غیر فعال میشود. \n آیا از پاک کردن کاربر اطمینان دارید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
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
