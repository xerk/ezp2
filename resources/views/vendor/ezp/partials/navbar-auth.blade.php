    <!-- ***** Header Area Start ***** -->
    <header class="header_area">
            <!-- Top Header Area End -->
            <div class="main_header_area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <!-- Logo Area Start -->
                        <div class="col-6 col-md-3">
                            <div class="logo_area">
                                <a href="{{ route('landingPage') }}">EZP</a>
                            </div>
                        </div>
                        <!-- Hero Meta Area Start -->
                        <div class="col-6 col-md-3 ml-md-auto text-right">
                            @if (\Request::is('login'))
                                <a href="{{ route('register') }}" class="btn bigshop-btn bigshop-btn-sm">{{ __('Register') }}</a>
                            @else
                                <a href="{{ route('login') }}" class="btn bigshop-btn bigshop-btn-sm">{{ __('Login') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->
