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
                                    <a href="{{ route('landingPage') }}"><img class="img-logo" src="{{ asset('img/logo.png')}}" alt="EZP"></a>
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
                                                placeholder="Search for Products, Brands or Catagory">
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
                                        <a href="#" id="header-cart-btn" target="_blank"><i class="ti-bag"></i>
                                            @if (Cart::instance('default')->count() > 0)
                                                <span class="cart_quantity">{{ Cart::instance('default')->count() }}</span>
                                            @endif
                                        </a>
                                        <!-- Cart List Area Start -->
                                        <ul class="cart-list">
                                            @if (Cart::instance('default')->count() > 0)
                                            @foreach (Cart::content() as $item)
                                            <li>
                                                <a href="#" class="image"><img src="{{ asset('storage/'.$item->model->image) }}"
                                                        class="cart-thumb" alt=""></a>
                                                <div class="cart-item-desc">
                                                    <h6><a href="#">{{ $item->model->name }}</a></h6>
                                                    <p>{{ $item->qty }}x - <span class="price">{{ $item->subtotal }} L.E</span></p>
                                                </div>
                                                <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                            </li>
                                            @endforeach
                                            <li class="total">
                                                <span>Total: {{ Cart::total() }}</span>
                                                <a href="{{ route('cart.index') }}" class="btn btn-sm btn-cart">Cart</a>
                                                <a href="{{ route('checkout.index') }}" class="btn btn-sm btn-checkout">Checkout</a>
                                            </li>
                                            @else
                                            <li class="total">
                                                <span>Not item in your cart</span>
                                                <a href="{{ route('shop') }}" class="btn btn-sm btn-checkout text-center"><i class="fa fa-undo" aria-hidden="true"></i> Back to Shopping</a>
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
                                            <li class="user-title"><span>{{__('Hello')}},</span> {{ Auth::user()->name }}</li>
                                            <li><a href="profile.html">{{__('My Profile')}}</a></li>
                                            <li><a href="order-list.html">{{__('Orders List')}}</a></li>
                                            {{-- <li><a href="wishlist.html">Wishlist</a></li> --}}
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true" ></i>
                                                {{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @else
                                    <a href="{{ route('login') }}" class="btn bigshop-btn bigshop-btn-sm">{{ __('Login') }}</a>
                                    @endauth
                                </div>
                            </div>

                            <!-- Main Menus Wrapper -->
                            <div class="nav-menus-wrapper">
                                <ul class="nav-menu nav-menu-centered">
                                    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('landingPage') }}">Home</a></li>
                                    <li class="{{ request()->is('shop') ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a></li>
                                    <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ route('landingPage') }}">About Us</a></li>
                                    <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ route('landingPage') }}">Contact</a></li>
                                    <li class="{{ request()->is('fqa') ? 'active' : '' }}"><a href="{{ route('landingPage') }}">FAQ</a></li>
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
</style>
