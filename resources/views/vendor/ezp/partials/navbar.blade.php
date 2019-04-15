<!-- ***** Header Area Start ***** -->
<header class="header_area home-3">
    <div class="main_header_area" id="stickyHeader">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mainmenu_area">
                        <nav id="bigshop-nav" class="navigation">
                            <!-- Logo Area Start -->
                            <div class="nav-header">
                                <div class="nav-toggle"></div>
                                <div class="">
                                    <a href="{{ route('landingPage') }}"><img class="img-logo" src="{{ Voyager::image(setting('site.logo')) }}" alt="EZP"></a>
                                </div>
                            </div>
                            <div class="header_meta_info_area">
                                <div class="nav-search align-to-right">
                                    <div class="nav-search-button">
                                        <i class="nav-search-icon"></i>
                                    </div>
                                    <form>
                                        <div class="nav-search-inner">
                                            <input type="search" name="search"
                                                placeholder="{{__('Search for Products, Brands or Category')}}">
                                        </div>
                                    </form>
                                </div>
                                <div class="hero_meta_area d-flex align-items-center align-to-right">
                                    <!-- Wishlist Area -->
                                    {{-- <div class="wishlist">
                                        <a href="wishlist.html"><i class="ti-heart"></i></a>
                                    </div> --}}
                                    <!-- Cart Area -->
                                    <div class="cart">
                                        <a href="#" id="header-cart-btn" target="_blank"><i class="material-icons">
                                            add_shopping_cart
                                            </i>
                                            @if (Cart::instance('default')->count() > 0)
                                                <span class="cart_quantity">{{ Cart::instance('default')->count() }}</span>
                                            @endif
                                        </a>
                                        <!-- Cart List Area Start -->
                                        <ul class="cart-list">
                                            @if (Cart::instance('default')->count() > 0)
                                            @foreach (Cart::content() as $item)
                                            <li class="pb-4">
                                                <a href="#" class="image"><img src="{{ asset('storage/'.$item->model->image) }}"
                                                        class="cart-thumb" alt=""></a>
                                                <div class="cart-item-desc">
                                                    <h6><a href="#">{{ $item->model->name }}</a></h6>
                                                    <p>{{ $item->qty }}x - <span class="price">{{ $item->subtotal }} L.E</span></p>
                                                </div>
                                                <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                            </li>
                                            @endforeach
                                            <hr class="mb-0">
                                            <li class="total">
                                                <span>{{__('Total')}}: {{ Cart::total() }}</span>
                                                <a href="{{ route('cart.index') }}" class="btn btn-sm btn-cart">{{__('Cart')}}</a>
                                                @auth
                                                    @if (Auth::user()->user_type != 3)
                                                        <a href="{{ route('checkout.index') }}" class="btn btn-sm btn-checkout">{{__('Checkout')}}</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('checkout.index') }}" class="btn btn-sm btn-checkout">{{__('Checkout')}}</a>
                                                @endauth
                                                
                                            </li>
                                            @else
                                            <li class="total">
                                                <span>{{__('No item in your cart')}}</span>
                                                <a href="{{ route('shop') }}" class="btn btn-sm btn-checkout"><i class="fa fa-undo" aria-hidden="true"></i> {{__('Back to Shopping')}}</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    @auth
                                    <!-- User Area -->
                                    <div class="user_thumb">
                                        <a href="#" id="header-user-btn"><img class="img-fluid"
                                                src="{{ asset('img/bg-img/user.jpg') }}" alt=""></a>
                                        <!-- User Meta Dropdown Area Start -->
                                        <ul class="user-meta-dropdown">
                                            <li class="user-title"><span>{{__('Hello')}},</span> {{ strtok(trim(Auth::user()->name),  ' ') }}</li>
                                            {{-- <li class="item-menu"><a href="{{ route('users.edit')}}">{{__('Dashboard')}}</a></li> --}}
                                            <li class="item-menu"><a href="{{ route('users.edit')}}">{{__('My Profile')}}</a></li>
                                            <li class="item-menu"><a href="{{route('orders.index')}}">{{__('Orders List')}}</a></li>
                                            {{-- <li><a href="wishlist.html">Wishlist</a></li> --}}
                                            <li class="item-menu logout"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true" ></i>
                                                {{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @endauth
                                </div>
                            </div>
                            <!-- Main Menus Wrapper -->
                            <div class="nav-menus-wrapper" dir="rtl">
                                <ul class="nav-menu nav-menu-centered">
                                    @foreach($items as $menu_item)
                                    @if ($menu_item->link() === '/login')
                                    @guest
                                        <li class="{{ Request::is($menu_item->link()) ? 'active' : '' }}" ><a class="login" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
                                    @endguest
                                    @else
                                        <li class="{{ Request::is($menu_item->link() != '/' ? trim($menu_item->link(), '/') : $menu_item->link()) ? 'active' : '' }}"><a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
                                    @endif
                                    @endforeach
                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
<style>
.img-logo {
    position: absolute;
    top: 12px;
    left: 0;
    width: 64px;
}
.login {
    background: #19b5fe;
    color: #fff !important;
}
.user-title{
    padding-top: 10px;
    text-align: center;
    color: #0c84ff;
}
.user-meta-dropdown {
    padding: 0;
}
li.item-menu {
    padding: 5px 0;
    text-align: center;
}
li.item-menu>a:hover {
    color: #fff;
}
li.item-menu:hover {
    background-color: #19b5fe;
    color: #fff;
}
</style>
