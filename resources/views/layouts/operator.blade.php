<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Operator') | Harau Trip</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --op-green-900: #102c22;
            --op-green-800: #16392c;
            --op-tan: #d6ad73;
            --op-cream: #f5f1e8;
            --op-ink: #26332b;
            --op-ink-soft: #7a8580;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--op-cream);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
        }

        /* SIDEBAR */
        .op-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: var(--op-green-900);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform 0.25s ease;
        }

        .op-sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .op-sidebar-brand .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(214, 173, 115, 0.15);
            color: var(--op-tan);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .op-sidebar-brand div span {
            display: block;
            font-weight: 700;
            font-size: 15px;
            line-height: 1.2;
        }

        .op-sidebar-brand div small {
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
        }

        .op-sidebar-section {
            padding: 16px 20px 6px;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: rgba(255, 255, 255, 0.35);
            text-transform: uppercase;
        }

        .op-sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 12px;
        }

        .op-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: 0.15s ease;
            position: relative;
        }

        .op-nav-link i {
            width: 18px;
            text-align: center;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.55);
        }

        .op-nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }

        .op-nav-link.active {
            background: rgba(214, 173, 115, 0.12);
            color: #ffffff;
            font-weight: 600;
        }

        .op-nav-link.active i {
            color: var(--op-tan);
        }

        .op-nav-link.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 3px;
            background: var(--op-tan);
            border-radius: 0 3px 3px 0;
        }

        .op-nav-link.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        .op-nav-badge {
            margin-left: auto;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.55);
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .op-sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .op-logout-btn {
            width: 100%;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8);
            padding: 9px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .op-logout-btn:hover {
            background: var(--op-tan);
            border-color: var(--op-tan);
            color: var(--op-green-900);
        }

        /* NAVBAR */
        .op-navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #eee9df;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 900;
        }

        .op-navbar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 18px;
            color: var(--op-ink);
            margin-right: 14px;
        }

        .op-navbar-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--op-ink);
        }

        .op-navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .op-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--op-green-900);
            color: var(--op-tan);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .op-navbar-user .text-block {
            line-height: 1.2;
        }

        .op-navbar-user strong {
            display: block;
            font-size: 13px;
            color: var(--op-ink);
        }

        .op-navbar-user .badge-role {
            font-size: 9.5px;
            font-weight: 700;
            color: #b3844f;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* CONTENT */
        .op-content {
            margin-left: 250px;
            padding-top: 64px;
            min-height: 100vh;
        }

        /* MOBILE */
        .op-sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 999;
        }

        @media (max-width: 900px) {
            .op-sidebar {
                transform: translateX(-100%);
            }

            .op-sidebar.open {
                transform: translateX(0);
            }

            .op-navbar,
            .op-content {
                left: 0;
                margin-left: 0;
            }

            .op-navbar-toggle {
                display: inline-block;
            }

            .op-sidebar-overlay.show {
                display: block;
            }
        }
    </style>

    @stack('css')
</head>
<body>

    <div class="op-sidebar-overlay" id="opSidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- SIDEBAR --}}
    <aside class="op-sidebar" id="opSidebar">

        <div class="op-sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-mountain"></i>
            </div>
            <div>
                <span>Harau Trip</span>
                <small>Operator Panel</small>
            </div>
        </div>

        <nav class="op-sidebar-menu">

            <div class="op-sidebar-section">Menu</div>

            <a href="{{ route('operator.today') }}"
               class="op-nav-link {{ request()->routeIs('operator.today') ? 'active' : '' }}">
                <i class="fas fa-calendar-day"></i>
                Booking Hari Ini
            </a>

            <a href="{{ route('operator.scan') }}"
               class="op-nav-link {{ request()->routeIs('operator.scan') ? 'active' : '' }}">
                <i class="fas fa-qrcode"></i>
                Scan Voucher
            </a>

            <a href="{{ route('operator.history') }}"
               class="op-nav-link {{ request()->routeIs('operator.history') ? 'active' : '' }}">
                <i class="fas fa-clock-rotate-left"></i>
                Riwayat Check-in
            </a>

        </nav>

        <div class="op-sidebar-footer">
            <button type="button" class="op-logout-btn" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>

    </aside>

    {{-- NAVBAR --}}
    <div class="op-navbar">
        <div class="d-flex align-items-center">
            <button class="op-navbar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="op-navbar-title">@yield('title', 'Operator')</div>
        </div>

        <div class="op-navbar-user">
            <div class="text-block text-right">
                <strong>{{ auth()->user()->name }}</strong>
                <span class="badge-role">{{ auth()->user()->role }}</span>
            </div>
            <div class="op-user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="op-content">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('opSidebar').classList.toggle('open');
            document.getElementById('opSidebarOverlay').classList.toggle('show');
        }
    </script>

    {{-- Modal Konfirmasi Logout --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border:0;border-radius:16px;overflow:hidden">

                <div class="modal-body text-center" style="padding:32px 28px 20px">

                    <div style="width:56px;height:56px;border-radius:50%;background:#f8ecec;
                                display:flex;align-items:center;justify-content:center;
                                margin:0 auto 16px">
                        <i class="fas fa-sign-out-alt" style="color:#a33d3d;font-size:20px"></i>
                    </div>

                    <h5 style="font-weight:700;color:#1c2a22;margin-bottom:8px">
                        Keluar dari akun?
                    </h5>

                    <p style="color:#68736d;font-size:13.5px;margin-bottom:0">
                        Anda yakin ingin keluar? Anda perlu login kembali untuk mengakses halaman operator.
                    </p>

                </div>

                <div class="modal-footer" style="border:0;padding:16px 28px 28px;gap:8px">

                    <button type="button"
                            class="btn"
                            data-dismiss="modal"
                            style="flex:1;background:#f0f1ee;color:#59625c;border:0;
                                   border-radius:9px;font-weight:600;padding:10px">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST" style="flex:1;margin:0">
                        @csrf
                        <button type="submit"
                                style="width:100%;background:#a33d3d;color:#fff;border:0;
                                       border-radius:9px;font-weight:600;padding:10px">
                            Ya, Keluar
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

    @stack('js')
</body>
</html>