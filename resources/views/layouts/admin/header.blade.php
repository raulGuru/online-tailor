<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
    </a>
    <form class="d-none d-sm-inline-block">
        <div class="input-group input-group-navbar">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search">
            <button class="btn" type="button">
                <i class="align-middle" data-feather="search"></i>
            </button>
        </div>
    </form>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <img src="<?php echo asset('public/assets/img/avatars/avatar.jpg') ?>" class="avatar img-fluid rounded" alt="Charles Hall" />
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">
                        <i class="align-middle me-1" data-feather="user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('user.index') }}">
                        <i class="align-middle me-1" data-feather="user"></i> Users
                    </a>
                    <div class="dropdown-divider"></div>
                    <form class="form-inline" action="{{ route('login.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn mb-1 dropdown-item">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Log out
                        </button>
                     </form>
                </div>
            </li>
        </ul>
    </div>
</nav>