<header>
    <nav class="navbar navbar-expand-lg header" style="border-bottom: 1px solid #f1f3f8;">
        <div class="container">
            <div class="logo-div d-flex">
                @yield('back-icon')
                <a href="{{ route('index') }}" style="margin-top: 8px">
                    <img src="{{ asset ('/images/photo_2020-04-03_15-45-58.png') }}" width="40" alt="لوگو">
                </a>
                <a class="d-block mr-1 mt-2" href="{{ route('index') }}" style="    width: 108px;">
                <span class="f-10 old-font d-block"
                      style="color : black;font-family: IRANSans2 !important;text-align: right">ساناز رحیمی</span>
                    <span class="f-12 font-weight-bold my-green-color"
                          style="color: var(--pr-green)">« مدرسه کسب و کار » </span>
                </a>
            </div>
            <div class="d-none d-lg-block" id="navbarSupportedContent" style="width: 100%">
                <ul class="navbar-nav mr-auto" style="width: 100%;place-content: center">
                    <li class="nav-item">
                        <a class="nav-link top-links" href="{{ route('content.search',  ['type' => 'PREREQUISITES']) }}">چرا یادگیری کسب و کار؟</a>
                    </li><li class="nav-item">
                        <a class="nav-link top-links" href="/redirectToPath">برو به مرحله من</a>
                    </li><li class="nav-item">
                        
                        <a class="nav-link top-links" href="{{ route('content.search',  ['type' => 'PREREQUISITES']) }}">معرفی کسب و کار ها</a>
                    </li><li class="nav-item">
                        <a class="nav-link top-links" href="{{ route('content.search',  ['type' => 'JANEBI']) }}">خورده نوشته ها</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <i class="material-icons-two-tone two-tone-icon-hover f-40 mt-3 content-menu-pointer" id="dropdownMenuButton" data-toggle="dropdown"
                   aria-haspopup="true" style="font-size: 40px">account_circle</i>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @auth
                        <a class="dropdown-item drop-down-item my-green-color font-weight-bold old-font" style='text-align : center !important'>مرحله شما : {{ auth()->user()->level }} </a>
                        <a class="dropdown-item drop-down-item " href="{{ route('profile' , ['user' => auth()->user()->id , 'page' => 'myInformation']) }}"><i class="material-icons-two-tone partner-icon">portrait</i>پروفایل </a>
                        @if(auth()->user()->isAdmin)
                            <a class="dropdown-item drop-down-item" target="_blank" href="{{ route('admin.index') }}"><i class="material-icons-two-tone partner-icon">how_to_reg</i>پنل مدیریت </a>
                        @endif
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item drop-down-item">
                                <i class="material-icons-two-tone partner-icon">exit_to_app</i>  خروج
                            </button>
                        </form>
                    @else
                        <a class="dropdown-item drop-down-item" href="{{ route('login') }}"><i class="material-icons-two-tone partner-icon">person_outline</i>ورود </a>
                        <a class="dropdown-item drop-down-item" href="{{ route('register') }}"><i class="material-icons-two-tone partner-icon">person_add</i>ثبت نام </a>
                    @endauth
                </div>
            </div>

        </div>
    </nav>
</header>
<div style="width: 100%;height: 82px"></div>

