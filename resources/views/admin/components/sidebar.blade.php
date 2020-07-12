<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">پنل مدیریت</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>صفحه اصلی</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Contents
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed d-none d-md-block" href="" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-bars"></i>
            <span>محتوا ها</span>
        </a>
        <div class="d-md-none">
            <a class="nav-link collapsed" href="">
                <i class="fas fa-microphone"></i>
                <span>محتوا ها</span>
            </a>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">مدیریت محتوا ها :</h6>
                <a class="collapse-item" href="{{ route('admin.content.index' , ['type' => 'PREREQUISITES']) }}">همه پیش نیاز ها</a>
                <a class="collapse-item" href="{{ route('admin.content.index' , ['type' => 'STEP']) }}">همه محتوا های مرحله ای</a>
                <a class="collapse-item" href="{{ route('admin.content.index' , ['type' => 'EVENT']) }}">همه چالش ها</a>
                <a class="collapse-item" href="{{ route('admin.content.index' , ['type' => 'JANEBI']) }}">همه آموزش های جانبی</a>
                <a class="collapse-item" href="{{ route('admin.content.index' , ['type' => 'INTRODUCTION']) }}">همه معرفی کسب و کار ها</a>
                <a class="collapse-item" href="{{ route('admin.whichContent') }}">اضافه کردن محتوا جدید</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed d-none d-md-block" href="" data-toggle="collapse" data-target="#collapseTwo1"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-list-alt"></i>
            <span>مرحله ها</span>
        </a>
        <div class="d-md-none">
            <a class="nav-link collapsed" href="">
                <i class="fas fa-microphone"></i>
                <span>مرحله ها</span>
            </a>
        </div>
        <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">مدیریت مرحله ها :</h6>
                <a class="collapse-item" href="{{ route('admin.category.index') }}">همه مرحله ها</a>
                <a class="collapse-item" href="{{ route('admin.category.create') }}">اضافه کردن مرحله جدید</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        Answer And Replays
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed d-none d-md-block" href="" data-toggle="collapse" data-target="#collapseTwo2"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-list-alt"></i>
            <span>پاسخ ها</span>
        </a>
        <div class="d-md-none">
            <a class="nav-link collapsed" href="">
                <i class="fas fa-microphone"></i>
                <span>پاسخ ها</span>
            </a>
        </div>
        <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">مدیریت پاسخ ها :</h6>
                <a class="collapse-item" href="{{ route('admin.answer.index' , ['type' => 'ANSWER']) }}"> همه پاسخ های ارسال شده</a>
                <a class="collapse-item" href="{{ route('admin.answer.index' , ['type' => 'REPLAY']) }}">همه پاسخ های ادمین</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        Users
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed d-none d-md-block" href="" data-toggle="collapse" data-target="#collapseTwo3"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-list-alt"></i>
            <span>کاربر ها</span>
        </a>
        <div class="d-md-none">
            <a class="nav-link collapsed" href="">
                <i class="fas fa-microphone"></i>
                <span>کاربر ها</span>
            </a>
        </div>
        <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo3" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">مدیریت کاربر ها :</h6>
                <a class="collapse-item" href="{{ route('admin.users.index') }}"> همه کاربر ها</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
