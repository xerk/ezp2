@extends('vendor.ezp.layout')
@section('title', __('Homepage'))
@section('content')

<!-- ***** Breadcumb Area Start ***** -->
<div class="breadcumb_area bg-img background-overlay-white" style="background-image: url({{ asset('img/bg-img/breadcumb.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
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
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="order_complated_area clearfix">
                    <h5>Thank You For Your Order.</h5>
                    <p>You will receive an email of your order details</p>
                    <p class="orderid">Your Order id # <b class="text-danger">{{ $order->id }}</b></p>
                    <p><span class="text-danger">Please keep your order id</span></p>
                </div>
            </div>

            <div class="col-12">
                <div class="checkout_pagination mt-50">
                    <a href="{{ route('shop') }}" class="btn bigshop-btn">Go Back Shop</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Checkout Area End ***** -->
@endsection
