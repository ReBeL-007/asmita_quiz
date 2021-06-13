<a href="{{route('home')}}" class="brand-link">
    <img src="{{asset('asmita.png')}}" alt="Asmita Logo" class="brand-image" />
    <span class="brand-text font-weight-light" style="font-weight: bold">AQuiz</span>
</a>

<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
                <a href="{{route('home')}}" class="nav-link">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('quiz_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>Test</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

{{-- <!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('/backend/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User
Image">
</div>
<div class="info">
    <a href="{{ route('admin.dashboard')}}" class="d-block">{{Auth::user()->name}}</a>
</div>
</div>


<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{ route('admin.dashboard')}}" class="nav-link {{ (request()->is('/admin')) ? 'active' : '' }}">
                <p>
                    <i class="fa-fw fas fa-tachometer-alt"></i>
                    <span> {{ trans('global.dashboard') }} </span>
                </p>
            </a>
        </li>

        <li
            class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/groups*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users">

                </i>
                <p>
                    <span>{{ trans('cruds.userManagement.title_singular') }}</span>
                    <i class="right fa fa-fw fa-angle-left" style="right:.5rem;"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 1rem;">
                <li class="nav-item">
                    <a href="{{ route("admin.permissions.index") }}"
                        class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-unlock-alt">

                        </i>
                        <p>
                            <span>{{ trans('cruds.permission.title') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.roles.index") }}"
                        class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase">

                        </i>
                        <p>
                            <span>{{ trans('cruds.role.title') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.groups.index") }}"
                        class="nav-link {{ request()->is('admin/groups') || request()->is('admin/groups/*') ? 'active' : '' }}">
                        <i class="fas fa-user-friends"></i>
                        <p>
                            <span>{{ trans('cruds.group.title') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.users.index") }}"
                        class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user">

                        </i>
                        <p>
                            <span>{{ trans('cruds.user.title') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </li>

        {{-- additional menu goes here --}}
        {{--<li
                class="nav-item has-treeview {{ request()->is('admin/categories*') ? 'menu-open' : '' }}
        {{ request()->is('admin/courses*') ? 'menu-open' : '' }}
        {{ request()->is('admin/lessons*') ? 'menu-open' : '' }}">
        <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="fa-fw fas fa-users">

            </i>
            <p>
                <span>{{ trans('cruds.courseManagement.title_singular') }}</span>
                <i class="right fa fa-fw fa-angle-left" style="right:.5rem;"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="margin-left: 1rem;">
            <li class="nav-item">
                <a href="{{ route("admin.categories.index") }}"
                    class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-list">

                    </i>
                    <span>{{ trans('cruds.category.title') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.courses.index') }}"
                    class="nav-link {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-graduation-cap"></i>
                    <span>{{trans('cruds.courses.title')}}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.lessons.index') }}"
                    class="nav-link {{ request()->is('admin/lessons') || request()->is('admin/lessons/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-book-open"></i>
                    <span>{{trans('cruds.lessons.title')}}</span>
                </a>
            </li>
        </ul>
        </li>

        <li
            class="nav-item has-treeview {{ request()->is('admin/quizzes*') ? 'menu-open' : '' }} {{ request()->is('admin/questions*') ? 'menu-open' : '' }}">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users">

                </i>
                <p>
                    <span>{{ trans('cruds.quizManagement.title_singular') }}</span>
                    <i class="right fa fa-fw fa-angle-left" style="right:.5rem;"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 1rem;">
                <li class="nav-item">
                    <a href="{{ route('admin.quizzes.index') }}"
                        class="nav-link {{ request()->is('admin/quizzes') || request()->is('admin/quizzes/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-question-circle"></i>
                        <span>{{trans('cruds.quizzes.title')}}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.questions.index') }}"
                        class="nav-link {{ request()->is('admin/questions') || request()->is('admin/questions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-question">

                        </i>
                        <span>{{trans('cruds.question.title')}}</span>
                    </a>
                </li>
            </ul>
        </li>


        {{-- menu to change password --}}
        {{--<li class="nav-item">
                <a href="{{ route('admin.password.create') }}"
        class="nav-link
        {{ request()->is('admin/change-password') || request()->is('admin/change-password/*') ? 'active' : '' }}">
        <i class="fa fa-key"></i>
        <p> <span>{{ trans('global.change_password') }}</span></p>
        </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>

<div class="sidebar sidebar_footer" style="text-align:center;">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{route('admin.logout')}}" class="nav-link">
                <p>
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <span>{{trans('global.logout')}}</span>
                </p>
            </a>
        </li>
    </ul>
</div>
<!-- /.sidebar --> --}}
