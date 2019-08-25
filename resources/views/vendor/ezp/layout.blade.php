<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('vendor.ezp.partials.header')
        @yield('extra-css')
        @if (app()->getLocale() == 'ar')
            <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        @endif
    </head>
    <style>
            /* Paste this css to your style sheet file or under head tag */
            /* This only works with JavaScript,
            if it's not present, don't show loader */
            .no-js #loader { display: none;  }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .se-pre-con {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url("{{asset('img/loader.gif')}}") center no-repeat #fff;
            }
            </style>
<body>
    <div class="se-pre-con"></div>
    @if (\Request::is('login') || \Request::is('register'))
        @include('vendor.ezp.partials.navbar-auth')
    @else
        {{-- @include('vendor.ezp.partials.navbar') --}}
        {!! menu('site', 'vendor.ezp.partials.navbar') !!}
    @endif
    @yield('content')

    @if (\Request::is('login') || \Request::is('register'))
        @include('vendor.ezp.partials.footer-auth')
    @else
    @include('vendor.ezp.partials.footer')
    @endif
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}


    @yield('extra-js')
</body>
</html>
<script>
$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
