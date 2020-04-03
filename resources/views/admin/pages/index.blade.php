@extends('admin.app')
@section('title') صفحه اصلی @endsection
@section('content')
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">تعداد کل آلارم ها
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count(\App\Voice::all()) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-microphone fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">تعداد کل نوتیفیکیشن ها
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count(\App\Notification::all()) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-ad fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">کاربران اپلیکیشن
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ count(\Illuminate\Support\Facades\DB::table('users')
                                ->select('phone')->groupBy('phone')->get()) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
