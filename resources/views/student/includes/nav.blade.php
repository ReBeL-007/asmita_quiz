<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light-blue navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    {{-- <!-- SEARCH FORM -->

    <!-- invisible form for mobile -->
    <div id="overlay" class="background-overlay">
        <span class="close-search-btn" onClick="closeSearch()">x</span>
        <div class="form-content">
            <form action="">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    <button class="btn btn-navbar btn-mobile" type="submit" onClick="openSearch()">
        <i class="fas fa-search"></i>
    </button>
    <!-- end of mobile form -->

    <form class="form-inline ml-3 background">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search for Courses"
                aria-label="Search" />
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form> --}}
    <ul class="navbar-nav ml-auto notification-nav">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link navigation-icon" data-toggle="dropdown" href="#">
                <img src="{{asset('bell.png')}}" style="width: 1.6rem;"><span class="badge badge-danger navbar-badge notification-count"></span>
            </a>
            <div class="dropdown-menu notification-menu dropdown-menu-lg dropdown-menu-right">

                {{--<a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                --}}
            </div>
        </li>
    </ul>
    <div class="dropdown d-flex">
        <div class="align">
            <span class="admin-name">Hi, {{Auth::user()->name}}</span>
            <a href="javascript:void(0)" class="chip ml-3" data-toggle="dropdown" aria-expanded="false">
                <span class="avatar" style="
                background-image: url({{asset('User.png')}});
                background-size: cover;
              "></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="
              position: absolute;
              transform: translate3d(0px, 50px, 0px);
              top: 0px;
              left: 0px;
              will-change: transform;
            ">
                {{-- <a class="dropdown-item" href="page-profile.html"><i class="dropdown-icon fe fe-user"></i> Profile</a>
                <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fe fe-settings"></i>
                    Settings</a>
                <a class="dropdown-item" href="app-email.html"><span class="float-right"><span
                            class="badge badge-primary">6</span></span><i class="dropdown-icon fe fe-mail"></i>
                    Inbox</a>
                <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-send"></i> Message</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-help-circle"></i> Need
                    help?</a> --}}
                <a class="dropdown-item" href="{{route('logout')}}"><i class="dropdown-icon fe fe-log-out"></i> Sign
                    out</a>
            </div>
        </div>
    </div>
</nav>
