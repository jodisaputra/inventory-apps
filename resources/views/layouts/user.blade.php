<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Dashboard')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-32x32.png') }}" sizes="32x32">

    <style>
        :root {
            --body-bg: #131720;
            --body-color: #ffffff;
            --card-bg: #151f30;
            --border-color: #222b41;
            --main-accent: #2f80ed;
        }

        body {
            background-color: var(--body-bg);
            color: var(--body-color);
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
        }

        header {
            background-color: var(--body-bg);
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .header__content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header__logo img {
            height: 30px;
        }

        .header__nav {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .header__nav-item {
            margin-right: 30px;
        }

        .header__nav-link {
            color: var(--body-color);
            text-decoration: none;
            font-weight: 500;
        }

        .header__nav-link.active {
            color: var(--main-accent);
        }

        .header__search {
            display: flex;
            align-items: center;
            background-color: #10141b;
            border-radius: 4px;
            padding: 0 15px;
        }

        .header__search input {
            background-color: transparent;
            border: none;
            color: var(--body-color);
            padding: 10px;
            width: 200px;
        }

        .header__search button {
            background-color: transparent;
            border: none;
            color: #6c757d;
        }

        .header__user {
            display: flex;
            align-items: center;
        }

        .header__user-menu {
            margin-left: 20px;
            position: relative;
        }

        .header__user-menu-btn {
            background-color: transparent;
            border: none;
            color: var(--body-color);
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .header__user-menu-btn svg {
            margin-left: 5px;
            fill: var(--body-color);
            width: 20px;
            height: 20px;
        }

        .header__user-menu-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--card-bg);
            border-radius: 4px;
            padding: 10px 0;
            min-width: 150px;
            z-index: 100;
            display: none;
        }

        .header__user-menu-dropdown.show {
            display: block;
        }

        .header__user-menu-item {
            padding: 8px 15px;
            display: block;
            color: var(--body-color);
            text-decoration: none;
        }

        .header__user-menu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 15px 0 30px;
        }

        .breadcrumb__item {
            color: #6c757d;
        }

        .breadcrumb__item a {
            color: #6c757d;
            text-decoration: none;
        }

        .breadcrumb__item:not(:last-child)::after {
            content: '→';
            margin: 0 10px;
        }

        .breadcrumb__item--active {
            color: var(--body-color);
        }

        .section-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            height: 100%;
        }

        .card__icon {
            color: var(--main-accent);
            margin-right: 10px;
        }

        .card__title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .card__content {
            margin-bottom: 15px;
        }

        .card__button {
            display: inline-block;
            background-color: #1a2436;
            color: var(--body-color);
            border: none;
            border-radius: 4px;
            padding: 8px 15px;
            text-decoration: none;
            float: right;
        }

        .stats-card {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            margin-top: 30px;
        }

        .stats-card__content {
            display: flex;
            flex-direction: column;
        }

        .stats-card__title {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .stats-card__value {
            font-size: 28px;
            font-weight: 600;
        }

        .stats-card__icon {
            color: var(--main-accent);
            font-size: 24px;
        }

        .footer {
            padding: 50px 0;
            border-top: 1px solid var(--border-color);
            margin-top: 100px;
        }

        .footer__title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer__link {
            display: block;
            color: #6c757d;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .footer__copyright {
            color: #6c757d;
            font-size: 14px;
            margin-top: 30px;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- header -->
    <header style="border-bottom: 1px solid #222b41;">
        <div class="container">
            <div class="header__content">
                <div class="d-flex align-items-center">
                    <a href="{{ route('dashboard') }}" class="header__logo">
                        <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}">

                        <ul class="header__nav ml-5">
                            <li class="header__nav-item">
                                <a class="header__nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            @can('create stores')
                                @if (!auth()->user()->hasStore())
                                    <li class="header__nav-item">
                                        <a class="header__nav-link {{ request()->routeIs('stores.create') ? 'active' : '' }}"
                                            href="{{ route('stores.create') }}">Create Store</a>
                                    </li>
                                @endif
                            @endcan
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="#" id="moreDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                </div>

                <div class="d-flex align-items-center">
                    <div class="header__search mr-4">
                        <input type="text" placeholder="I'm looking for...">
                        <button type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>

                    <div class="header__user">
                        <div class="header__user-menu" onclick="toggleUserMenu()">
                            <button class="header__user-menu-btn">
                                <span>{{ Auth::user()->name ?? 'User' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </button>
                            <div class="header__user-menu-dropdown" id="userMenu">
                                <a href="#" class="header__user-menu-item">Profile</a>
                                <a href="#" class="header__user-menu-item">Settings</a>
                                <a href="{{ route('logout') }}" class="header__user-menu-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->

    <!-- main content -->
    <main class="main">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center"
                style="margin-top: 50px; padding-top: 20px;">
                <h1 class="section-title">@yield('page_title', 'Dashboard')</h1>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    <!-- end main content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="mb-4">
                        <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}"
                            height="30">
                    </div>
                    <p>Laravel - Your Digital Platform</p>
                </div>

                <div class="col-6 col-md-4">
                    <h6 class="footer__title">Menu</h6>
                    <a href="{{ route('dashboard') }}" class="footer__link">Dashboard</a>
                    <a href="#" class="footer__link">Settings</a>
                    <a href="#" class="footer__link">Help Center</a>
                </div>

                <div class="col-6 col-md-4">
                    <h6 class="footer__title">Legal</h6>
                    <a href="#" class="footer__link">Terms of Service</a>
                    <a href="#" class="footer__link">Privacy Policy</a>
                    <a href="#" class="footer__link">Cookie Policy</a>
                </div>
            </div>

            <div class="text-center">
                <div class="footer__copyright">© Laravel, {{ date('Y') }}. All Rights Reserved.</div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <script>
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('show');
        }

        // Close the dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.header__user-menu-btn') && !event.target.matches('.header__user-menu-btn *')) {
                var dropdowns = document.getElementsByClassName("header__user-menu-dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
