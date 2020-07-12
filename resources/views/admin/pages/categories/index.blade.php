@extends('admin.app')
@section('title')
مرحله ها
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
            <a class="btn btn-primary" href="{{ route('admin.category.create') }}">ایجاد مرحله جدید</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>مرحله</th>
                            <th>توضیحات</th>
                            <th>تصویر</th>
                            <th>تنضیمات</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>مرحله</th>
                            <th>توضیحات</th>
                            <th>تصویر</th>
                            <th>تنضیمات</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$category->name}}</td>
                            <td>{{ $category->level }}</td>
                            <td>{{ \Str::limit($category->body , 70) }}</td>
                            <td><img src="{{ asset($category->image) }}" alt="تصویر" width="100" height="100" width="100" height="100" /></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.category.edit' , ['category' => $category->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.category.destroy' , ['category' => $category->id]) }}" method="post">
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

            </div>
        </div>
    </div>

</div>
@endsection