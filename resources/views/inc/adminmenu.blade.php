<ul class="nav nav-pills nav-sidebar flex-column"
data-widget="treeview"
role="menu"
data-accordion="false">
    @foreach ($adminmenu as $item)
        @if (count($item->submenus) > 0)
            <li class="nav-item">
                <a class="nav-link" href="{{ $item->menu_route }}"><i class="nav-icon {{ $item->menu_icon }}"></i>
                    <p>{{ $item->menu_title }}</p>
                    <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview">
                    @foreach ($item->submenus as $submenu)
                        <li class="nav-item">
                            <a class="nav-link " href="{{ $submenu->menu_route }}"><i
                                    class="nav-icon {{ $submenu->menu_icon }}">
                                </i><p>{{ $submenu->menu_title }}</p></a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ $item->menu_route }}"><i class="nav-icon {{ $item->menu_icon }}"></i>
                    <p>{{ $item->menu_title }}</p></a>
            </li>
        @endif
    @endforeach
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout')}}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="far fas fa-sign-out-alt nav-icon"></i>
            <p>Logout</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
<!--sidebar nav end-->
