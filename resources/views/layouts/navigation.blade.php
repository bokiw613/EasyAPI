<div class="d-flex">
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <!-- User Profile -->
                <li class="dropdown header-profile">
                    <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('images/ion/man (1).png') }}" width="20" alt=""/>
                        <div class="header-info ms-3">
                            <span class="font-w600">Hi,<b>AC</b></span>
                            <small class="text-end font-w400">xyz@gmail.com</small>
                        </div>
                    </a>
                </li>
                <!-- Menu Items -->
                @auth
                    <li><a href="{{ route('roles.index') }}" aria-expanded="false">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Peran</span>
                    </a></li>
                    <li><a href="{{ route('permissions.index') }}" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Izin</span>
                    </a></li>
                    <li><a href="{{ route('users.index') }}" aria-expanded="false">
                        <i class="flaticon-041-graph"></i>
                        <span class="nav-text">Pengguna</span>
                    </a></li>
                    <li><a href="{{ route('data.index') }}" aria-expanded="false">
                        <i class="flaticon-086-star"></i>
                        <span class="nav-text">Data</span>
                    </a></li>
                    <!-- Logout -->
                    <li>
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="flaticon-logout"></i>
                            <span class="nav-text">Keluar</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
                @guest
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}" aria-expanded="false">
                            <i class="flaticon-025-dashboard"></i>
                            <span class="nav-text">Login</span>
                        </a></li>
                    @endif
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" aria-expanded="false">
                            <i class="flaticon-050-info"></i>
                            <span class="nav-text">Daftar</span>
                        </a></li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</div>
