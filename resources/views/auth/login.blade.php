@extends('vendor.ezp.layout')
@section('title', __('Login'))
@section('content')
<!-- ***** Login Area Start ***** -->
<div class="bigshop_reg_log_area bg-img section_padding_100" style="background-image: url({{asset('img/bg-img/login.jpg')}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="login_form">
                    <!-- sign in with social site -->
                    <div class="signin_with_social">
                        <a href="{{ route('provider.login') }}" class="facebook-logo"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                        {{-- <a href="#" class="twitter-logo"><i class="fa fa-twitter"></i>Sign in with Twitter</a> --}}
                    </div>
                    <!-- sign in manual form -->
                    <div class="login_manual_form">
                        <p>or</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-check">
                                <div class="custom-control custom-checkbox mb-3">
                                    <div class="form-check">
                                        <input class="custom-control-input" type="checkbox" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bigshop-btn w-100">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
