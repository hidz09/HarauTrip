<aside class="main-sidebar elevation-0">

<style>
    .main-sidebar{
        background:#0f261d;
        width:250px;
        border-right:1px solid rgba(255,255,255,.06);
    }

    /* BRAND */
    .brand-link{
        display:flex;
        align-items:center;
        gap:12px;
        padding:18px 20px;
        border-bottom:1px solid rgba(255,255,255,.08);
        white-space:nowrap;
    }

    .brand-link .brand-image{
        width:34px;height:34px;
        border:2px solid #d6ad73;
        opacity:1 !important;
    }

    .brand-text{
        color:#f4f1e8;
        font-size:19px;
        font-weight:700;
        letter-spacing:.02em;
        font-family: Georgia, 'Times New Roman', serif;
    }

    /* USER PANEL */
    .user-panel{
        padding:16px 20px;
        border-bottom:1px solid rgba(255,255,255,.08);
        display:flex;
        align-items:center;
        gap:12px;
        margin:0 !important;
    }

    .user-panel .image img{
        width:38px;height:38px;
        border-radius:50%;
        border:2px solid #d6ad73;
        object-fit:cover;
    }

    .user-panel .info a{
        color:#f4f1e8;
        font-size:14px;
        font-weight:600;
    }

    .user-panel .info a:hover{
        color:#d6ad73;
        text-decoration:none;
    }

    .user-panel .info small{
        display:block;
        color:#8fa196;
        font-size:11px;
        margin-top:1px;
    }

    /* NAV */
    .sidebar{padding:0 12px}

    nav.mt-2{margin-top:14px !important}

    .nav-header{
        color:#6c8378 !important;
        font-size:10.5px !important;
        font-weight:700;
        letter-spacing:.08em;
        padding:0 10px;
        margin:18px 0 6px !important;
    }

    .nav-item{margin-bottom:2px}

    .nav-sidebar .nav-link{
        display:flex;
        align-items:center;
        gap:11px;
        padding:9px 12px;
        border-radius:9px;
        color:#c3d1c9;
        font-size:13.5px;
        font-weight:500;
        transition:background .15s ease, color .15s ease;
    }

    .nav-sidebar .nav-link p{
        margin:0;
        white-space:nowrap;
    }

    .nav-sidebar .nav-link .nav-icon{
        width:17px;
        text-align:center;
        font-size:14px;
        color:#7f9689;
        transition:color .15s ease;
        margin-right:0;
    }

    .nav-sidebar .nav-link:hover{
        background:rgba(214,173,115,.08);
        color:#f4f1e8;
    }

    .nav-sidebar .nav-link:hover .nav-icon{
        color:#d6ad73;
    }

    .nav-sidebar .nav-link.active{
        background:rgba(214,173,115,.14);
        color:#f4f1e8;
        font-weight:600;
        box-shadow: inset 3px 0 0 #d6ad73;
    }

    .nav-sidebar .nav-link.active .nav-icon{
        color:#d6ad73;
    }

    /* LOGOUT */
    .nav-item form .nav-link{
        color:#c3897d;
        cursor:pointer;
    }

    .nav-item form .nav-link .nav-icon{
        color:#c3897d;
    }

    .nav-item form .nav-link:hover{
        background:rgba(214,90,90,.1);
        color:#e8a89c;
    }

    .nav-item form .nav-link:hover .nav-icon{
        color:#e8a89c;
    }
</style>

    <!-- Brand -->
    <a href="{{ route('admin.report.index') }}" class="brand-link">

        <img src="{{ asset('assets/AdminLTE/dist/img/AdminLTELogo.png') }}"
             class="brand-image img-circle elevation-0">

        <span class="brand-text">
            Nirwana
        </span>

    </a>



    <div class="sidebar">


        <!-- User -->
        <div class="user-panel">

            <div class="image">

                <img src="{{ asset('assets/AdminLTE/dist/img/user2-160x160.jpg') }}"
                     class="img-circle">

            </div>


            <div class="info">

                <a href="#">
                    {{ Auth::user()->name ?? 'Admin' }}
                </a>

                <small>Administrator</small>

            </div>

        </div>




        <!-- Menu -->

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                data-accordion="false">


                <!-- Dashboard -->
                <li class="nav-item">

                    <a href="{{ route('admin.report.index') }}"
                    class="nav-link {{ request()->routeIs('admin.report.*')?'active':'' }}">

                        <i class="nav-icon fas fa-home"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>


                <!-- Grup: Konten -->
                <li class="nav-header">
                    Konten
                </li>

                <!-- Destinasi -->

                <li class="nav-item">

                    <a href="{{ route('admin.destination.index') }}"
                    class="nav-link {{ request()->routeIs('admin.destination.*')?'active':'' }}">

                        <i class="nav-icon fas fa-map-marker-alt"></i>

                        <p>
                            Destinasi
                        </p>

                    </a>

                </li>




                <!-- Paket Wisata -->

                <li class="nav-item">

                    <a href="{{ route('admin.package.index') }}"
                    class="nav-link {{ request()->routeIs('admin.package.*')?'active':'' }}">

                        <i class="nav-icon fas fa-suitcase"></i>

                        <p>
                            Paket Wisata
                        </p>

                    </a>

                </li>


                <!-- Grup: Transaksi -->
                <li class="nav-header">
                    Transaksi
                </li>

               <!-- Booking -->
                <li class="nav-item">

                    <a href="{{ route('admin.booking.index') }}"
                    class="nav-link {{ request()->routeIs('admin.booking.*')?'active':'' }}">

                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>
                            Booking
                        </p>

                    </a>

                </li>



                <!-- Payment -->
                <li class="nav-item">

                    <a href="{{ route('admin.payment.index') }}"
                    class="nav-link {{ request()->routeIs('admin.payment.*')?'active':'' }}">

                        <i class="nav-icon fas fa-money-bill-wave"></i>

                        <p>
                            Payment
                        </p>

                    </a>

                </li>


                <!-- Grup: Lainnya -->
                <li class="nav-header">
                    Lainnya
                </li>

                <!-- Logout -->

                <li class="nav-item">


                    <button type="button"
                        class="nav-link"
                        data-toggle="modal"
                        data-target="#logoutModal"
                        style="
                        background:none;
                        border:none;
                        width:100%;
                        text-align:left;
                        cursor:pointer;
                        ">

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>
                            Logout
                        </p>

                    </button>


                </li>



            </ul>


        </nav>


    </div>


</aside>

@include('partials.logout-modal')