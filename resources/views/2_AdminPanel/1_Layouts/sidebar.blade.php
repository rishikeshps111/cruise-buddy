<!--**********************************
            Sidebar start
        ***********************************-->
@php
    use App\Helpers\MenuHelper;

    $menuData = MenuHelper::getMenuItems();
@endphp

<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            @foreach ($menuData as $menu)
                <li class="menu-title">{{ $menu['title'] }}</li>
                @foreach ($menu['items'] as $menuItem)
                    <li class="{{ request()->routeIs($menuItem['route']) ? 'active' : '' }}">
                        <a class="{{ isset($menuItem['subMenu']) ? 'has-arrow' : '' }}"
                            href="{{ isset($menuItem['subMenu']) ? 'javascript:void(0);' : route($menuItem['route']) }}"
                            aria-expanded="false">
                            <div class="menu-icon">
                                {!! $menuItem['icon'] !!}
                            </div>
                            <span class="nav-text">{{ $menuItem['name'] }}</span>
                        </a>
                        @if (isset($menuItem['subMenu']))
                            <ul aria-expanded="false">
                                @foreach ($menuItem['subMenu'] as $subItem)
                                    <li class="{{ request()->routeIs($subItem['route']) ? 'active' : '' }}">
                                        <a href="{{ route($subItem['route']) }}">{{ $subItem['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
