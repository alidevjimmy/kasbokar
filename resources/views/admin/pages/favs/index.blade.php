@extends('admin.app')
@section('title')
علاقه مندی ها
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
                            <th>توضیحات</th>

                            <th>تنضیمات</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ردیف</th>
                            <th>کاربر</th>
                            <th>توضیحات</th>
                            <th>تنضیمات</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($favs as $fav)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$fav->user->phone}}</td>
                            <td>{{$fav->description}}</td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('admin.favs.destroy' , ['id' => $fav->id]) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="btn {{ $fav->deleted_at ? 'btn-success' : 'btn-danger' }}" onclick="return confirm('آیا از پاک کردن تجربه اطمینان دارید؟')" style="border-radius: 0"><i class="fa fa-trash"></i></button>
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
