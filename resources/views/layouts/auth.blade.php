<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider-radio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('icon/favicon-32x32.png') }}">

    <style>
        .sign__input.is-invalid {
            border-color: #dc3545;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .alert {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        /* Additional styles for authentication pages */

        /* Validation */
        .sign__input.is-invalid {
            border-color: #dc3545;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        /* Alerts */
        .alert {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        /* Typography */
        .sign__title {
            font-size: 24px;
            color: #fff;
            font-weight: 400;
            margin-bottom: 20px;
            text-align: center;
        }

        .sign__text {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 20px;
            line-height: 1.6;
            text-align: center;
        }

        /* Button styles */
        form .sign__btn {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            width: 100%;
            border-radius: 6px;
            background-color: #3772ff;
            font-size: 14px;
            color: #fff;
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 0.6px;
            margin-bottom: 20px;
            border: none;
            cursor: pointer;
            transition: 0.4s ease;
        }

        form .sign__btn:hover {
            background-color: #2f5edb;
        }

        .sign__logo {
            display: block;
            margin: 0 auto 30px;
            text-align: center;
        }

        .sign__logo img {
            max-width: 150px;
        }
    </style>

    <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Authentication')</title>
</head>

<body>
    <!-- sign in/up section -->
    <div class="sign section--full-bg" data-bg="{{ asset('img/bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sign in/up section -->

    <!-- JS -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/slider-radio.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/plyr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
