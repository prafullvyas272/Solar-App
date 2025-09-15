<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0"
    style="border-top: 1px solid #0000001a;">
    <div class="container-fluid d-flex h-100">
        <a href="#" class="menu-horizontal-prev d-none"></a>
        <div class="menu-horizontal-wrapper">
            <ul class="menu-inner" style="margin-left: 0px;">
                @foreach ($menus as $menu)
                    @if ($menu['display_in_menu'] == 1 && $menu['parent_menu_id'] == 0)
                        @php
                            // Check if there are child menus for the current menu item
                            $childMenus = collect($menus)->where('parent_menu_id', $menu['id']);
                            $hasSubMenu = $childMenus->isNotEmpty();
                            $hasMultipleSubMenus = $childMenus->count() > 1;

                            // Check if this menu or any of its child menus are active
                            $isActive =
                                request()->is(ltrim($menu['navigation_url'], '/')) ||
                                $childMenus->contains(function ($childMenu) {
                                    return request()->is(ltrim($childMenu['navigation_url'], '/'));
                                });
                        @endphp

                        @if ($hasSubMenu && $hasMultipleSubMenus)
                            {{-- Show parent menu with dropdown for multiple submenus --}}
                            <li class="menu-item {{ $isActive ? 'active' : '' }}">
                                <a href="{{ url($menu['navigation_url'] ?? '#') }}"
                                    class="menu-link @if ($menu['menu_class']) {{ $menu['menu_class'] }} @endif menu-toggle">
                                    @if ($menu['menu_icon'])
                                        <i class="menu-icon {{ $menu['menu_icon'] }}"></i>
                                    @endif
                                    <div>{{ $menu['name'] }}</div>
                                </a>

                                <ul class="menu-sub">
                                    @foreach ($childMenus as $childMenu)
                                        @php
                                            // Check if this child menu is active
                                            $isChildActive = request()->is(ltrim($childMenu['navigation_url'], '/'));
                                        @endphp
                                        <li class="menu-item {{ $isChildActive ? 'active' : '' }}">
                                            <a href="{{ url($childMenu['navigation_url'] ?? '#') }}"
                                                class="menu-link @if ($childMenu['menu_class']) {{ $childMenu['menu_class'] }} @endif">
                                                @if ($childMenu['menu_icon'])
                                                    <i class="menu-icon {{ $childMenu['menu_icon'] }}"></i>
                                                @endif
                                                <div>{{ $childMenu['name'] }}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @elseif ($hasSubMenu && !$hasMultipleSubMenus)
                            {{-- Show single submenu as a regular menu item --}}
                            @foreach ($childMenus as $childMenu)
                                @php
                                    // Check if this child menu is active
                                    $isChildActive = request()->is(ltrim($childMenu['navigation_url'], '/'));
                                @endphp
                                <li class="menu-item {{ $isChildActive ? 'active' : '' }}">
                                    <a href="{{ url($childMenu['navigation_url'] ?? '#') }}"
                                        class="menu-link @if ($childMenu['menu_class']) {{ $childMenu['menu_class'] }} @endif">
                                        @if ($childMenu['menu_icon'])
                                            <i class="menu-icon {{ $childMenu['menu_icon'] }}"></i>
                                        @endif
                                        <div>{{ $childMenu['name'] }}</div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            {{-- Show parent menu without submenus --}}
                            <li class="menu-item {{ $isActive ? 'active' : '' }}">
                                <a href="{{ url($menu['navigation_url'] ?? '#') }}"
                                    class="menu-link @if ($menu['menu_class']) {{ $menu['menu_class'] }} @endif">
                                    @if ($menu['menu_icon'])
                                        <i class="menu-icon {{ $menu['menu_icon'] }}"></i>
                                    @endif
                                    <div>{{ $menu['name'] }}</div>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <a href="#" class="menu-horizontal-next d-none"></a>
    </div>
</aside>
