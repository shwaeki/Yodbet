<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white  d-print-none" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  d-flex justify-content-center align-items-center">
            {{--            <a class="text-center" href="{{ route('home') }}">--}}
            <h1 class="brand-name d-block"> {{config('app.name') }}</h1>

            </a>

        </div>
        <hr class="my-0">
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}" href="{{route('home')}}">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">ראשי</span>
                        </a>
                    </li>


                    {{--                    @canany(['client-post', 'client-post'])--}}

                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('client*')) ? 'active' : '' }}" href="#navbar-client"
                           data-toggle="collapse" role="button" aria-expanded="true">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">ניהול לקוחות</span>
                        </a>
                        <div class="collapse" id="navbar-client">
                            <ul class="nav nav-sm flex-column">
                                @can('view-post')
                                    <li class="nav-item">
                                        <a href="{{route('client.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">כל הלקוחות</span></a>
                                    </li>
                                @endcan
                                @can( 'create-post')
                                    <li class="nav-item">
                                        <a href="{{route('client.create')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">הוסף לקוח חדש</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                    {{--                    @endcan--}}



                    {{--                    @canany(['view-project', 'create-project'])--}}
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('client/*/project')) ? 'active' : '' }}"
                           href="#navbar-project"
                           data-toggle="collapse" role="button" aria-expanded="true"
                           aria-controls="navbar-worker">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">ניהול פרויקטים</span>
                        </a>
                        <div class="collapse" id="navbar-project">
                            <ul class="nav nav-sm flex-column">
                                @can('view-project')
                                    <li class="nav-item">
                                        <a href="{{route('project.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">כל הפרויקטים</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                    {{--                    @endcan--}}

                    {{--                    @canany(['view-worker', 'create-worker'])--}}
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('worker*')) ? 'active' : '' }}"
                           href="#navbar-worker"
                           data-toggle="collapse" role="button" aria-expanded="true"
                           aria-controls="navbar-worker">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">ניהול עובדים</span>
                        </a>
                        <div class="collapse" id="navbar-worker">
                            <ul class="nav nav-sm flex-column">
                                @can('view-worker')
                                    <li class="nav-item">
                                        <a href="{{route('worker.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">כל העובדים</span></a>
                                    </li>
                                @endcan
                                @can('create-worker')
                                    <li class="nav-item">
                                        <a href="{{route('worker.create')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">הוסף עובד חדש</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                    {{--                    @endcan--}}


                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('attendance*')) ? 'active' : '' }}"
                           href="#navbar-attendance"
                           data-toggle="collapse" role="button" aria-expanded="true"
                           aria-controls="navbar-worker">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">ניהול דוחי שעות</span>
                        </a>
                        <div class="collapse" id="navbar-attendance">
                            <ul class="nav nav-sm flex-column">
                                @can('view-attendance')
                                    <li class="nav-item">
                                        <a href="{{route('attendance.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">דוח שעות</span></a>
                                    </li>
                                @endcan
                                @can('view-attendance-report')
                                    <li class="nav-item">
                                        <a href="{{route('attendance.report')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">דוח ריכוז</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>




                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}" href="#navbar-users"
                           data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-users">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">ניהול משתמשים</span>
                        </a>
                        <div class="collapse" id="navbar-users">
                            <ul class="nav nav-sm flex-column">
                                @can('view-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">כל המשתמשים</span></a>
                                    </li>
                                @endcan
                                @can( 'create-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.create')}}" class="nav-link">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal">הוסף משתמש חדש</span></a>
                                    </li>
                                @endcan

                                @canany(['view-role', 'create-role'])
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('roles*')) ? 'active' : '' }}"
                                           href="{{route('roles.index')}}">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal">ניהול תפקידים</span></a>
                                    </li>
                                @endcan

                                @canany(['view-permission', 'create-permission'])
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('permissions*')) ? 'active' : '' }}"
                                           href="{{route('permissions.index')}}">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal">ניהול הרשאות</span></a>
                                    </li>
                                @endcan


                            </ul>
                        </div>
                    </li>

    {{--                <li class="nav-item">
                        <hr class="my-3">
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{route('components')}}">
                            <i class="ni ni-send text-primary"></i>
                            <span class="nav-link-text">النعاصر</span>
                        </a>
                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</nav>
