<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Safexpress</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">


    <!-- Lightbox -->
    <link href="{{ asset('css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Favicons -->

    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://kit.fontawesome.com/41646a1e13.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
    </script>
    <!-- Template Main CSS File -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style>
        .container-iframe {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top:0;
            /* 16:9 Aspect Ratio */
        }

        .iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
    <script src="{{ asset('js/AutoLightbox.js') }}"></script>
    @vite(['resources/css/app.css'])
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{url('/')}}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <div class="d-flex align-items-center"><img src="{{ asset('img/logo.png') }}" /></div>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>


            <nav id="navbar" class="navbar">
                <ul>
                    @foreach ($menuItem as $item)
                        @if (count($item->submenus) > 0)
                            <li class="dropdown"><a
                                    href="{{ $item->menu_route }}"><span>{{ $item->menu_title }}</span> <i
                                        class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>
                                    @foreach ($item->submenus as $submenu)
                                        <li><a href="{{ $submenu->menu_route }}"
                                                class="{{ request()->is($item->menu_title) ? 'active' : '' }}">{{ $submenu->menu_title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li> <a href="{{ $item->menu_route }}"
                                    class="{{ request()->is($item->menu_route) ? 'active' : '' }}">{{ $item->menu_title }}</a>
                            </li>
                        @endif

                            @endforeach
                                <!-- show if login or logout -->
                            @if(Auth::check()) <!-- Check if the user is logged in -->
                            <li class="dropdown"> <a href="#">Hi!&nbsp;{{ auth()->user()->name }}</a>
                                <ul>

                                        <li>
                                            <a href="/admin" target="_blank"
                                                >Admin Dashboard</a>
                                        </li>

                                </ul>
                             </li>


                            @endif
                </ul>
            </nav><!-- .navbar -->

        </div>

    </header><!-- End Header -->

    <main id="main">

        @yield('content')
    </main>



    @include('inc.footer')

</body>

</html>
