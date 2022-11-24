<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
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
                            <span class="nav-link-text">الرئيسية</span>
                        </a>
                    </li>


                    {{--                    @canany(['client-post', 'client-post'])--}}

                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('client*')) ? 'active' : '' }}" href="#navbar-client"
                           data-toggle="collapse" role="button" aria-expanded="true">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">ادارة الزبائن</span>
                        </a>
                        <div class="collapse" id="navbar-client">
                            <ul class="nav nav-sm flex-column">
                                @can('view-post')
                                    <li class="nav-item">
                                        <a href="{{route('client.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">جميع الزبائن</span></a>
                                    </li>
                                @endcan
                                @can( 'create-post')
                                    <li class="nav-item">
                                        <a href="{{route('client.create')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">اضافة زبون جديدة</span></a>
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
                            <span class="nav-link-text">ادارة المشاريع</span>
                        </a>
                        <div class="collapse" id="navbar-project">
                            <ul class="nav nav-sm flex-column">
                                @can('view-project')
                                    <li class="nav-item">
                                        <a href="{{route('project.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">جميع المشاريع</span></a>
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
                            <span class="nav-link-text">ادارة العاملين</span>
                        </a>
                        <div class="collapse" id="navbar-worker">
                            <ul class="nav nav-sm flex-column">
                                @can('view-worker')
                                    <li class="nav-item">
                                        <a href="{{route('worker.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">جميع العاملين</span></a>
                                    </li>
                                @endcan
                                @can('create-worker')
                                    <li class="nav-item">
                                        <a href="{{route('worker.create')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">اضافة عامل جديدة</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                    {{--                    @endcan--}}


                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('attendance*')) ? 'active' : '' }}"
                           href="{{route('attendance.index')}}">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">جدول الحضور</span>
                        </a>
                    </li>

                    {{--                    @canany(['media'])
                                            <li class="nav-item">
                                                <a class="nav-link {{ (request()->is('media*')) ? 'active' : '' }}"
                                                   href="{{route('media.index')}}">
                                                    <i class="fas fa-images text-primary"></i>
                                                    <span class="nav-link-text">إدارة الوسائط</span>
                                                </a>
                                            </li>
                                        @endcan

                                        @canany(['view-activity-log'])
                                            <li class="nav-item">
                                                <a class="nav-link {{ (request()->is('activity-log*')) ? 'active' : '' }}"
                                                   href="{{route('activity-log.index')}}">
                                                    <i class="fas fa-history text-primary"></i>
                                                    <span class="nav-link-text">سجل النشاطات</span>
                                                </a>
                                            </li>
                                        @endcan--}}


                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}" href="#navbar-users"
                           data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-users">
                            <i class="far fa-dot-circle text-primary"></i>
                            <span class="nav-link-text">ادارة المستخدمين</span>
                        </a>
                        <div class="collapse" id="navbar-users">
                            <ul class="nav nav-sm flex-column">
                                @can('view-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">جميع المستخدمين</span></a>
                                    </li>
                                @endcan
                                @can( 'create-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.create')}}" class="nav-link">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal">اضافة مستخدم جديد</span></a>
                                    </li>
                                @endcan

                                @canany(['view-role', 'create-role'])
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('roles*')) ? 'active' : '' }}"
                                           href="{{route('roles.index')}}">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal"> ادارة الادوار</span></a>
                                    </li>
                                @endcan

                                @canany(['view-permission', 'create-permission'])
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('permissions*')) ? 'active' : '' }}"
                                           href="{{route('permissions.index')}}">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal"> ادارة الصلاحيات</span></a>
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
