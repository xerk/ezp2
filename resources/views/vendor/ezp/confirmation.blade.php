@extends('vendor.ezp.layout')
@section('title', __('Confirmation'))
@section('content')

<!-- ***** Breadcumb Area Start ***** -->
<div class="breadcumb_area bg-img background-overlay-white" style="background-image: url({{ asset('img/bg-img/breadcumb.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Checkout')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- ***** Breadcumb Area End ***** -->

<!-- ***** Checkout Area Start ***** -->
<div class="checkout_area section_padding_100">
    <div class="container">
        @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success text-right" dir="rtl">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('warning_message'))
            <div class="spacer"></div>
            <div class="alert alert-warning text-right" dir="rtl">
                {{ session()->get('warning_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger text-right" dir="rtl">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="order_complated_area clearfix text-right">
                    <h5>{{__('Thank You For Your Order')}}, @auth <span class="text-primary">{{strtok(trim(Auth::user()->name),  ' ')}}</span> @endauth</h5>
                    <p>{{__('You will receive an email of your order details')}}</p>
                    <p class="orderid">{{__('Your Order id')}} # <b class="text-danger">{{ $order->id }}</b></p>
                    <p><span class="text-danger">{{__('Please keep your order id')}}</span></p>
                    @guest
                    <div class="col-md-12 mb-12 text-right pt-5">
                        <div class="shortcodes_area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="shortcodes_content">
                                            <blockquote class="bigshop-blockquote br-10">
                                                <p class="">{{ __('Call Number') }}: <span class="text-info">{{setting('site.phone_number_1')}}, {{setting('site.phone_number_2')}}</span></p>
                                                <p class="text-primary my-2">{{ __('You will receive a message containing your PIN code by text or email')}}</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>

            <div class="col-12">
                <div class="checkout_pagination mt-50">
                    <a href="{{ route('shop') }}" class="btn bigshop-btn">{{__('Go Back Shop')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Checkout Area End ***** -->
@endsection
