<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('vendor.ezp.partials.header')
        @yield('extra-css')
    </head>


<body>
    @if (\Request::is('login') || \Request::is('register'))
        @include('vendor.ezp.partials.navbar-auth')
    @else
        @include('vendor.ezp.partials.navbar')
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
