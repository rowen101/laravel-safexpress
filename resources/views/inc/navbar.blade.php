@php
    use Illuminate\Support\Facades\Request;
@endphp
<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
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
                        <li class="dropdown"><a href="{{ $item->menu_route }}"><span>{{ $item->menu_title }}</span> <i
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
