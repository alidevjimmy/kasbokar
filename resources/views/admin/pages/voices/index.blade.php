@extends('admin.app')
@section('title') آلارم ها @endsection
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
                <a class="btn btn-primary" href="{{ route('admin.voices.create') }}">ایجاد آلارم جدید</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>نام</th>
                            <th>آدرس اینترنتی</th>
                            <th>تنضیمات</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>نام</th>
                            <th>آدرس اینترنتی</th>
                            <th>تنضیمات</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1 ?>
                            @foreach($voices as $voice)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$voice->name}}</td>
                                    <td><a target="_blank" href="{{$voice->url}}">{{$voice->url}}</a></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.voices.edit' , $voice->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.voices.destroy' , $voice->id) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" onclick="return confirm('آیا میخواید آلارم با نام {{ $voice->name }} را حذف کنید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
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
