<header>
    <nav class="navbar navbar-expand-lg header" style="border-bottom: 1px solid #f1f3f8;">
        <div class="logo-div d-flex">
            <a href="{{ route('index') }}" style="margin-top: 8px">
                <img src="{{ asset ('/images/photo_2020-04-03_15-45-58.png') }}" width="40" alt="لوگو">
            </a>
            <a class="d-block mr-1 mt-2" href="{{ route('index') }}">
                <span class="f-10 old-font d-block"
                      style="color : black;font-family: IRANSans2 !important;text-align: right">ساناز رحیمی</span>
                <span class="f-12 font-weight-bold my-green-color"
                      style="color: var(--pr-green)">« مدرسه کسب و کار » </span>
            </a>
        </div>
        <div class="dropdown">
            <i class="material-icons-two-tone two-tone-icon-hover f-40 mt-3 content-menu-pointer" id="dropdownMenuButton" data-toggle="dropdown"
               aria-haspopup="true" style="font-size: 40px">account_circle</i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @auth
                    <a class="dropdown-item drop-down-item " href="#!"><i class="material-icons-two-tone partner-icon">portrait</i>پروفایل </a>
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
        <button class="navbar-toggler d-none d-lg-block" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-none d-lg-block" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown dropright">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @auth('web')
                            <a class="dropdown-item" href="{{ route('login') }}">ورود</a>
                            <a class="dropdown-item" href="{{ route('register') }}">ثبت نام</a>
                        @else
                            <a class="dropdown-item" href="#!">پروفایل</a>
                            <a class="dropdown-item" href="#!">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" disabled></button>
                                    خروج
                                </form>
                            </a>
                        @endauth
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>

