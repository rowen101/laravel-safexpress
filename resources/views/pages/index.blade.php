<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Safexpress</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/public/favicon.png') }}" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
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

    <script src="{{ asset('js/AutoLightbox.js') }}"></script>
    @vite(['resources/css/app.css'])
</head>

<body>

    @php
        use Illuminate\Support\Facades\Request;
    @endphp
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top sticked">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
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
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <section id="why-us" class="why-us">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('img/bg1.jpeg')}}" alt="Warehouse1" class="d-block" style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('img/bg2.jpeg')}}" alt="Warehouse2" class="d-block" style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('img/bg3.jpeg')}}" alt="Warehouse3" class="d-block" style="width:100%">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>


    </section>

    <main id="id">


        <section id="why-us" class="why-us">
            <div class="container aos-init aos-animate" data-aos="fade-up">

                <div class="section-header">
                    <h2>Warehouse Management System (WMS)</h2>

                </div>

                <div class="row g-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-xl-5 img-bg"
                        style="background-image: url({{ url('img/why-us-bg.jpeg') }});background-position: center;">
                    </div>
                    <div class="col-xl-7 slides  position-relative">

                        <div class="slides-1 swiper swiper-initialized swiper-horizontal swiper-pointer-events">
                            <div class="swiper-wrapper" id="swiper-wrapper-8107df48babb07b0e" aria-live="off"
                                style="transition-duration: 0ms; transform: translate3d(-3332px, 0px, 0px);">
                                <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0"
                                    role="group" aria-label="1 / 4">
                                    <div class="item">
                                        <h3 class="mb-3">Let's grow your business together</h3>
                                        <h4 class="mb-3">Optio reiciendis accusantium iusto architecto at quia minima
                                            maiores quidem, dolorum.</h4>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, ipsam
                                            perferendis asperiores explicabo vel tempore velit totam, natus nesciunt
                                            accusantium dicta quod quibusdam ipsum maiores nobis non, eum. Ullam
                                            reiciendis dignissimos laborum aut, magni voluptatem velit doloribus quas
                                            sapiente optio.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1"
                                    role="group" aria-label="2 / 4">
                                    <div class="item">
                                        <h3 class="mb-3">Unde perspiciatis ut repellat dolorem</h3>
                                        <h4 class="mb-3">Amet cumque nam sed voluptas doloribus iusto. Dolorem eos
                                            aliquam quis.</h4>
                                        <p>Dolorem quia fuga consectetur voluptatem. Earum consequatur nulla maxime
                                            necessitatibus cum accusamus. Voluptatem dolorem ut numquam dolorum delectus
                                            autem veritatis facilis. Et ea ut repellat ea. Facere est dolores fugiat
                                            dolor.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev"
                                    data-swiper-slide-index="2" role="group" aria-label="3 / 4">
                                    <div class="item">
                                        <h3 class="mb-3">Aliquid non alias minus</h3>
                                        <h4 class="mb-3">Necessitatibus voluptatibus explicabo dolores a vitae
                                            voluptatum.</h4>
                                        <p>Neque voluptates aut. Soluta aut perspiciatis porro deserunt. Voluptate ut
                                            itaque velit. Aut consectetur voluptatem aspernatur sequi sit laborum.
                                            Voluptas enim dolorum fugiat aut.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active"
                                    data-swiper-slide-index="3" role="group" aria-label="4 / 4">
                                    <div class="item">
                                        <h3 class="mb-3">Necessitatibus suscipit non voluptatem quibusdam</h3>
                                        <h4 class="mb-3">Tempora quos est ut quia adipisci ut voluptas. Deleniti
                                            laborum soluta nihil est. Eum similique neque autem ut.</h4>
                                        <p>Ut rerum et autem vel. Et rerum molestiae aut sit vel incidunt sit at
                                            voluptatem. Saepe dolorem et sed voluptate impedit. Ad et qui sint at qui
                                            animi animi rerum.</p>
                                    </div>
                                </div>

                                <div class="swiper-slide swiper-slide-duplicate-next" data-swiper-slide-index="0"
                                    role="group" aria-label="1 / 4">
                                    <div class="item">
                                        <h3 class="mb-3"><span class='bi bi-gear-fill'></span>&nbsp;Control</h3>

                                        <p>
                                        <ul>
                                            <li>Ensure FEFO /FIFO Compliance</li>
                                            <li>Keep Track of Stock Freshness</li>
                                            <li>Total Inventory and Ageing Awareness</li>
                                            <li>Can maintain reactricted and unrestricted location</li>
                                            <li>Prevent issuance of non-conformance itema</li>
                                        </ul>
                                        </p>
                                    </div>
                                </div><!-- End slide item -->

                                <div class="swiper-slide" data-swiper-slide-index="1" role="group"
                                    aria-label="2 / 4">
                                    <div class="item">
                                        <h3 class="mb-3"><span class='bi bi-printer-fill'></span>&nbsp;Printer and
                                            Data Exort</h3>

                                        <p>All data can be exported to excel and other common data format
                                            Printing and export feature is available for all relevant transactions.</p>
                                    </div>
                                </div><!-- End slide item -->

                                <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="2"
                                    role="group" aria-label="3 / 4">
                                    <div class="item">
                                        <h3 class="mb-3"><span class='bi bi-newspaper'></span>&nbsp;Inventory</h3>

                                        <p>Maintain and provide up to date inventory records and stock movement history
                                        </p>
                                    </div>
                                </div><!-- End slide item -->
                                <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="2"
                                    role="group" aria-label="3 / 4">
                                    <div class="item">
                                        <h3 class="mb-3">Advantages and Benefits</h3>

                                        <p>
                                        <ul>
                                            <li>Easy to learn, manage and navigate</li>
                                            <li>Short period of adjustment and preparation of system requirement
                                                pre-requisites</li>
                                            <li>Faster system update and innovation as the industry upgrades for new
                                                trends and practices</li>
                                            <li>Can Extract records easyly to excel for Data analysis and report
                                                manipulation</li>
                                            <li>Modules can be tailored fit on business warehousing practices</li>
                                            <li>Cheapes and cost-effective solution for a complete driver of warehouse
                                                Mangement Solution Requirement with world call industry standard
                                                warehousing processes</li>

                                        </ul>


                                        </p>
                                    </div>
                                </div><!-- End slide item -->
                            </div>
                            <div
                                class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                <span class="swiper-pagination-bullet" tabindex="0" role="button"
                                    aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet"
                                    tabindex="0" role="button" aria-label="Go to slide 2"></span><span
                                    class="swiper-pagination-bullet" tabindex="0" role="button"
                                    aria-label="Go to slide 3"></span><span
                                    class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                    role="button" aria-label="Go to slide 4" aria-current="true"></span>
                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                        <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                            aria-controls="swiper-wrapper-8107df48babb07b0e"></div>
                        <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                            aria-controls="swiper-wrapper-8107df48babb07b0e"></div>
                    </div>

                </div>

            </div>
        </section>


        <section class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Quality Policy</h2>

                </div>
                <div class="row gy-4" data-aos="fade-up">
                    <div class="col-lg-5">
                        <div class="content ps-lg-5">
                            <h4>Safexpress is committed to run its
                                operations with utmost adherence to:</h4>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i>Food Safety</li>
                                <li><i class="bi bi-check-circle-fill"></i> Service Quality</li>
                                <li><i class="bi bi-check-circle-fill"></i> Environment Health</li>
                                <li><i class="bi bi-check-circle-fill"></i> Safety Standards</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="content ps-lg-5">

                            <p>
                                We will accomplish this by understanding the needs of our customers and
                                complying all applicable requirements, standards, and statutory regulations.
                            </p>
                            <p>
                                The management is always on top of its Team to lead and provide resources to
                                secure awareness for everyone and maintain its implementation in our operations.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section id="services-list" class="services-list">
            <div class="container aos-init aos-animate" data-aos="fade-up">

                <div class="section-header">
                    <h2>Our Partners</h2>

                </div>

                <div class="row gy-5 mt-2">

                    <div class="row text-center text-lg-start col-md-12 border-none">

                        <div class="col-lg-3 col-md-4 col-6 ">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail "
                                    src="{{asset('img/partners/1617168794_logo-header.png')}}" alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/1kx1k_LOGO_yellow.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/2560px-Logo_DB_Schenker.svg-1536x302.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/300964142_453263313486094_72733862803007486_n.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/3g-logistics-and-cold-storage-inc.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/Alfamart-Logo-1024x576.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/aljoy-300x200.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/Bounty_Fresh_Chicken_logo.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/Coca-Cola-Logo-1934-768x461.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/cropped-Potato-Corner-Logo@2x-600x200.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/Del_Monte_logo.svg-1024x795.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/KFC-logo-2006-2048x1152.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/mekeni-up.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/download-1.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/download-1_1-300x200.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/Popeyes-Logo.wine_-2048x1365.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/mother-daughter.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/Mondelez-Logo-1536x960.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/images.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/download.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/Popeyes-Logo.wine_-2048x1365.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/golden-essential-foods.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/igloo_logo.png')}}"  alt="">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-fluid img-thumbnail"
                                src="{{asset('img/partners/prose--2048x468.png')}}"  alt="">
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Board Of Directors</h2>

                </div>

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('img/team/team-1.jpg') }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>EDEN S. SATINITIGAN</h4>
                                <span>President/CEO</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('img/team/team-2.jpg') }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>DARLYN ALEJANDRO</h4>
                                <span>COO/CFO</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('img/team/team-4.jpg') }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>JOHN ANGELO CRUZ</h4>
                                <span>Director</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('img/team/team-3.jpg') }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>JULIUS VINCENT LIBANG</h4>
                                <span>Corporate Secretary/Legal</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>
        </section><!-- End Team Section -->

    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span>Safexpress</span>
                        </a>
                        <p>Unit E, Vag Bldg, Brgy. Patubig, Marilao, Bulacan</p>
                        <div class="social-links d-flex  mt-3">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="https://www.facebook.com/SafexpressLogisticsInc/" target="_blank"
                                class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-dash"></i> <a href="#">Home</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">About us</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Services</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-dash"></i> <a href="#">Web Design</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>

                            <strong>Phone:</strong><br>
                            <strong>Email:</strong> safexpress@gmail.com.ph<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="footer-legal">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>Safexpress</span></strong>. All Rights Reserved
                </div>

            </div>
        </div>
    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main-home.js') }}"></script>
    @vite('resources/js/app.js')
    <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function(e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
    </script>
