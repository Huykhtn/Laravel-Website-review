<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{ route('admin.dashboard.index') }}" class="logo">
            <img src="{{ URL::asset('assets/img/logo.png')}}" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard.index') }}" class="logo logo-small">
            <img src="{{ URL::asset('assets/img/logo-small.png')}}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <!-- /Logo -->
    <div class="menu-toggle">
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>
    </div>
                  
    
    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->
    
    <!-- Header Right Menu -->
    <ul class="nav user-menu">      
        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ URL::asset('assets/img/profiles/avatar-01.jpg')}}" width="31" alt="Ryan Taylor">
                    <div class="user-text">
                        <h6>{{ Auth::user()->user_name }}</h6>
                        
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ URL::asset('assets/img/profiles/avatar-01.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->user_name }}</h6>
                        <php>
                            @if(Auth::user()->role_id == 1)
                                <h6>Role: Admin</h6>
                            @elseif(Auth::user()->role_id == 2)
                            <h6>Role: Teacher</h6>
                            @else
                            <h6>Role: Student</h6>
                            @endif
                        </php>
                        
                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a>
            </div>
        </li>
        <!-- /User Menu -->
        
    </ul>
    <!-- /Header Right Menu -->
    
</div>
<!-- /Header -->