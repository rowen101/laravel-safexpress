<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Safexpress</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

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
    <style>
        .container-iframe {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
        }

        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
                /* CSS to remove space between header and section */
        header#header {
            margin-bottom: 0; /* Set the margin-bottom to 0 */
        }

        section {
            margin-top: 0; /* Set the margin-top to 0 */
        }
    </style>
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

            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
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
                    @if (Auth::check())
                        <!-- Check if the user is logged in -->
                        <li class="dropdown"> <a href="#">Hi!&nbsp;{{ auth()->user()->name }}</a>
                            <ul>

                                <li>
                                    <a href="/admin" target="_blank">Admin Dashboard</a>
                                </li>

                            </ul>
                        </li>
                    @endif
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <section style=" margin-top: 0;">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
                @foreach ($carousel as $index => $item)

                <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{$index + 1 }}"></button>

                @endforeach
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/bg1.jpeg') }}" alt="Warehouse1" class="d-block" style="width:100%">
                </div>
                @foreach ($carousel as $item)

                <div class="carousel-item">
                    <img src="{{ asset('/carousel/' . $item->image) }}" alt="{{$item->caption}}" class="d-block" style="width:100%">
                    <div class="carousel-caption">
                        <h3>{{$item->caption}}</h3>
                        <p>{{$item->detail}}</p>
                      </div>
                </div>

                @endforeach
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>


    </section>

    <main id="id">
        <section class="about">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">


                    <div class="container-iframe" data-aos="fade-up" data-aos-delay="100">
                        <iframe class="responsive-iframe"
                            src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2F100088724413065%2Fvideos%2F158192447341024%2F&show_text=false&width=560&t=0"
                            width="560" height="314" style="border:none;overflow:hidden" scrolling="no"
                            frameborder="0" allowfullscreen="true"
                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                            allowFullScreen="true"></iframe>
                    </div>

                </div>
        </section>
        @include('pages.partial_page.company')


        <section class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Quality Policy</h2>

                </div>
                <div class="row gy-4">
                    <div class="col-lg-5" data-aos="fade-right">
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
                        <div class="content ps-lg-5" data-aos="fade-left">

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

                <div class="row gy-5 mt-2" data-aos="fade-up">

                    <div class="row text-center text-lg-start col-md-12 border-none">
                        @if (count($clientlogo) > 0)
                            @foreach ($clientlogo as $item)

                                    <div class="col-lg-3 col-md-4 col-6 ">
                                        <a href="{{ asset('clients/' . $item->image) }}"
                                            data-gallery="portfolio-gallery-logo"
                                            class="d-block mb-4 h-100 glightbox preview-link">
                                            <img class="img-fluid img-thumbnail "
                                                src="{{ asset('clients/' . $item->image) }}" alt="">
                                        </a>
                                    </div>


                            @endforeach
                        @else
                            <p class="text-center">No client logo..</p>
                        @endif



                    </div>

                </div>

            </div>
        </section>
        <!-- ======= board Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Board Of Directors</h2>

                </div>

                <div class="row gy-4">

                    @foreach ($directors as $item)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset('/storage/img/' . $item->image) }}"
                                        class="img-fluid img-fluid border border-0 " alt="{{ $item->name }}">
                                    @if ($item->is_social != '')
                                        <div class="social">

                                            @if ($item->fb == '')
                                                <a href="{{ $item->fb_url }}" target="_blank"> <i
                                                        class="bi bi-facebook"></i></a>
                                            @endif

                                            @if ($item->instagram == '')
                                                <a href="{{ $item->instagram_url }}" target="_blank"> <i
                                                        class="bi bi-instagram"></i></a>
                                            @endif

                                            @if ($item->tw == '')
                                                <a href="{{ $item->tw_url }}" target="_blank"> <i
                                                        class="bi bi-twitter"></i></a>
                                            @endif

                                            @if ($item->linkin == '')
                                                <a href="{{ $item->linkin_url }}" target="_blank"> <i
                                                        class="bi bi-linkedin"></i></a>
                                            @endif

                                        </div>
                                    @endif
                                </div>
                                <div class="member-info">
                                    <h4>{{ $item->name }}</h4>
                                    <span>{{ $item->position }}</span>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                    @endforeach
                </div>

            </div>
        </section><!-- End Team Section -->

        <!-- ======= mancom Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Mancom Organizational Structure</h2>

                </div>

                <div class="row gy-4">

                    @foreach ($mancom as $item)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset('/storage/img/' . $item->image) }}"
                                        class="img-fluid border border-0 " alt="{{ $item->name }}">
                                    @if ($item->is_social != '')
                                        <div class="social">

                                            @if ($item->fb == '')
                                                <a href="{{ $item->fb_url }}" target="_blank"> <i
                                                        class="bi bi-facebook"></i></a>
                                            @endif

                                            @if ($item->instagram == '')
                                                <a href="{{ $item->instagram_url }}" target="_blank"> <i
                                                        class="bi bi-instagram"></i></a>
                                            @endif

                                            @if ($item->tw == '')
                                                <a href="{{ $item->tw_url }}" target="_blank"> <i
                                                        class="bi bi-twitter"></i></a>
                                            @endif

                                            @if ($item->linkin == '')
                                                <a href="{{ $item->linkin_url }}" target="_blank"> <i
                                                        class="bi bi-linkedin"></i></a>
                                            @endif

                                        </div>
                                    @endif

                                </div>
                                <div class="member-info">
                                    <h4>{{ $item->name }}</h4>
                                    <span>{{ $item->position }}</span>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                    @endforeach
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
                        <a href="#" class="logo d-flex align-items-center">
                            <span>Safexpress</span>
                        </a>
                        <p>{{ $setting->site_address }}</p>
                        <div class="social-links d-flex  mt-3">
                            {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a> --}}
                            <a href="https://www.facebook.com/SafexpressLogisticsInc/" target="_blank"
                                class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.linkedin.com/company/safexpress-logistics-inc/" target="_blank"
                                class="linkedin"><i class="bi bi-linkedin"></i></a>
                            <a href="https://www.youtube.com/@safexpressphilippines" target="_blank"
                                class="youtube"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-dash"></i> <a href="{{ url('/') }}">Home</a></li>
                            <li><i class="bi bi-dash"></i> <a href="{{ url('/about') }}">About us</a></li>
                            <li><i class="bi bi-dash"></i> <a href="{{ url('/services') }}">Services</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-dash"></i> <a href="{{ url('/warehouse-management') }}">Warehouse
                                    Management</a></li>
                            <li><i class="bi bi-dash"></i> <a href="{{ url('/transport-services') }}">Tranport
                                    Services</a></li>
                            <li><i class="bi bi-dash"></i> <a href="{{ url('/other-services') }}">Other Service</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>

                            <strong>Phone:</strong>&nbsp;{{ $setting->site_phone }}<br>
                            <strong>Email:</strong>&nbsp;{{ $setting->site_email }}<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="footer-legal">
            <div class="container">
                <div class="copyright">
                    Copyright &copy; {{ now()->year }} <strong><span>Safexpress</span></strong>. All Rights Reserved
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
