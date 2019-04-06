<div class="col-12 col-md-3">
        <div class="sidebar_widget_menu">
            <nav id="sidebar_wid_menu">
                <ul>
                    <li><a href="{{route('users.edit')}}"><i class="ti-user"></i> {{__('My Profile')}}</a></li>
                    <li><a href="{{route('orders.index')}}"><i class="ti-menu"></i> {{__('Orders List')}}</a></li>
                    {{-- <li><a href="#"><i class="ti-headphone-alt"></i> Support</a></li> --}}
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-lock"></i> {{__('Logout')}}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
