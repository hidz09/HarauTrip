<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<style>
    .main-header.navbar{
        background:#ffffff;
        border-bottom:1px solid #eee8dc;
        box-shadow:none;
        padding:0 18px;
    }

    .main-header .nav-link{
        color:#39443e;
    }

    .main-header .nav-link:hover{
        color:#a4773c;
    }

    .main-header .nav-item > a[data-widget="pushmenu"]{
        font-size:16px;
    }

    /* PROFILE DROPDOWN */
    .navbar-profile-toggle{
        display:flex;
        align-items:center;
        gap:9px;
        padding:6px 10px !important;
        border-radius:9px;
    }

    .navbar-profile-toggle:hover{
        background:#f5f1e8;
    }

    .navbar-profile-toggle img{
        width:30px;height:30px;
        border-radius:50%;
        border:2px solid #d6ad73;
        object-fit:cover;
    }

    .navbar-profile-toggle span{
        font-size:13.5px;
        font-weight:600;
        color:#26332b;
    }

    .navbar-profile-toggle .fa-chevron-down{
        font-size:10px;
        color:#8b9089;
        margin-left:2px;
    }

    .profile-dropdown-menu{
        border:1px solid #eee8dc;
        border-radius:10px;
        box-shadow:0 8px 24px rgba(16,44,34,.08);
        padding:6px;
        min-width:180px;
    }

    .profile-dropdown-menu .dropdown-item{
        border-radius:7px;
        font-size:13.5px;
        color:#39443e;
        padding:8px 10px;
        display:flex;
        align-items:center;
        gap:9px;
    }

    .profile-dropdown-menu .dropdown-item:hover{
        background:#f5f1e8;
        color:#26332b;
    }

    .profile-dropdown-menu .dropdown-item.text-danger:hover{
        background:#f8ecec;
        color:#a33d3d !important;
    }

    .profile-dropdown-menu .dropdown-item i{
        width:14px;
        text-align:center;
        color:#8b9089;
    }
</style>

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Fullscreen -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">

            <a class="nav-link navbar-profile-toggle" data-toggle="dropdown" href="#">

                <img src="{{ asset('assets/AdminLTE/dist/img/user2-160x160.jpg') }}" alt="Avatar">

                <span>{{ Auth::user()->name ?? 'Admin' }}</span>

                <i class="fas fa-chevron-down"></i>

            </a>

            <div class="dropdown-menu dropdown-menu-right profile-dropdown-menu">

                <a href="{{ route('admin.report.index') }}" class="dropdown-item">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>

                <div class="dropdown-divider"></div>

                <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target="#logoutModal" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>

            </div>

        </li>

    </ul>

</nav>