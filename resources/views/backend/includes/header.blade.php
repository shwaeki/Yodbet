<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom d-print-none">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Sidenav toggler -->
            <div class="pr-3">
                <a class="btn btn-white rounded-pill d-flex align-items-center" href="{{route('home')}}">
                    <i class="ni ni-shop text-primary"></i>
                    <span class="nav-link-text">ראשי</span>
                </a>
            </div>

            <!-- Search form -->
            <livewire:main-search />

            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">

                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>

            </ul>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="media align-items-center">
                          <span class="avatar avatar-sm rounded-circle">
                                  <i class="far avatar avatar-sm rounded-circle fa-user"></i>
                          </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">שלום</h6>
                        </div>
                        <a href="{{ route('profile.edit', auth()->user()) }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>החשבון שלי</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span>להתנתק</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        $("#search").focus(function(){
            window.livewire.emit('changeStatus', true);
        });

        $("#search").focusout(function(){
            window.livewire.emit('changeStatus', false);
        });

    </script>
@endpush
