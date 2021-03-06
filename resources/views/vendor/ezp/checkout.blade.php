@extends('vendor.ezp.layout')
@section('title', __('Checkout'))
@section('content')
<div id="checkout">
    <!-- ***** Breadcumb Area Start ***** -->
    <div class="breadcumb_area bg-img background-overlay-white"
        style="background-image: url(img/bg-img/breadcumb.jpg);">
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

    <div class="checkout_steps_area  justify-content-center">
        <a :class="{'active': billing, 'complated': review}" href="#"><i class="ti-check"></i> {{__('Billing')}}</a>
        <a :class="{'active': review}" href="#"><i class="ti-check"></i> {{__('Review')}}</a>
    </div>

    <!-- <<<<<<<<<<<<<<<<<<<< Checkout Area Start >>>>>>>>>>>>>>>>>>>> -->
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
            <div class="row" v-show="billing">
                <div class="col-12">
                    <div class="checkout_details_area mt-10 clearfix">
                        <div class="rwo col-md-12 mb-12 text-right">
                            <div class="shortcodes_area">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="shortcodes_content">
                                                <blockquote class="bigshop-blockquote br-10">
                                                    <p class="">{{ __('Call Number') }}: <span class="text-info">{{setting('site.phone_number_1')}}, {{setting('site.phone_number_2')}}</span></p>
                                                    <p class="my-2">{{ __('Etisalat cash Number') }}: <span class="text-primary">213456798</span></p>
                                                    <p>{{ __('Vodafone cash Number') }}: <span class="text-primary">123456789</span></p>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>{{__('Billing Details')}}</h5>
                        <form action="{{ route('checkout.store') }}" method="POST" id="billing-form">
                                @csrf
                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                        name="name" value="{{ old('name') }}" placeholder="{{__('Full Name')}}"
                                        srequired>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">{{__('Email Address')}}</label>
                                    @if (auth()->user())
                                    <input type="email"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{__('Email Address')}}" id="email" name="email"
                                        value="{{ auth()->user()->email }}" readonly>
                                    @else
                                    <input type="email"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="email"
                                        name="email" value="{{ old('email') }}" placeholder="{{__('Email Address')}}"
                                        required>
                                    @endif
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">{{__('Phone Number')}}</label>
                                    <input type="number"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        id="phone_number" name="phone" placeholder="{{__('Phone Number')}}" min="0"
                                        value="{{ old('phone') }}">
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city">{{__('City')}}</label>
                                    <select class="custom-select d-block w-100" name="city" id="city">
                                        @foreach (App\City::all() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="street_address">{{__('Street address')}}</label>
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        name="address" id="street_address" placeholder="{{__('Address')}}"
                                        value="{{ old('address') }}">
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="payment_method">{{__('Payment method')}}</label>
                                    <select class="custom-select d-block w-100" name="payment_method" v-model="payment"
                                        id="payment_method">
                                        <option value="" {{ (old("payment_method") == '' ? "selected":"") }}>{{ __('Choose payment method') }}</option>
                                        <option value="1" {{ (old("payment_method") == 1 ? "selected":"") }}> {{__('Vodafone cash')}}</option>
                                        <option value="2" {{ (old("payment_method") == 2 ? "selected":"") }}> {{__('Etisalat cash')}}</option>
                                        <option value="3" {{ (old("payment_method") == 3 ? "selected":"") }}> {{__('Fawery')}}</option>
                                    </select>
                                    @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payment_method') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-12 text-right">
                                    <transition name="fade">
                                        <div class="shortcodes_area" v-if="payment == 3">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="shortcodes_content">
                                                            <blockquote class="bigshop-blockquote br-10">
                                                                <p class="text-danger">{{ __('Important notice, please call before making payment If you do not call to confirm the order, the payment currency will be canceled by fawery') }}
                                                                </p>
                                                                <p class="my-2">{{ __('Call Number') }}: <span class="text-info">{{setting('site.phone_number_1')}}, {{setting('site.phone_number_2')}}</span></p>
                                                                <p>{{ __('Vodafone cash Number') }}: <span class="text-primary">123456789</span></p>
                                                            </blockquote>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                                <div class="col-md-6 mb-3" v-if="payment != 3 && payment != ''">
                                            <label for="shipping_phone">{{__('Shipping phone number')}}</label>
                                            <input type="number" required
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="shipping_phone" name="shipping_phone" placeholder="{{__('Shipping phone number')}}" min="0"
                                                value="{{ old('shipping_phone') }}">
                                            @if ($errors->has('shipping_phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('shipping_phone') }}</strong>
                                            </span>
                                            @endif
                                </div>
                                <div class="col-md-6 mb-3" v-if="payment != 3 && payment != ''">
                                            <label for="payment_number">{{__('Payment number')}}</label>
                                            <input type="number" required
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="payment_number" name="payment_number" placeholder="{{__('Payment number')}}" min="0"
                                                value="{{ old('payment_number') }}">
                                            @if ($errors->has('payment_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('payment_number') }}</strong>
                                            </span>
                                            @endif
                                </div>
                                {{-- <div class="col-md-12">
                                <label for="order-notes">Order Notes</label>
                                <textarea class="form-control" id="order-notes" cols="30" rows="10"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div> --}}
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="checkout_pagination mt-50">
                        <a href="{{ route('cart.index') }}" class="btn bigshop-btn">{{__('Go To Cart')}}</a>
                        <a href="#" @click.prevent="hideBilling" class="btn bigshop-btn">{{__('Continue')}}</a>
                    </div>
                </div>
            </div>
            <div class="row" v-show="review">
                <div class="col-12">
                    <div class="checkout_details_area mt-50 clearfix">
                        <h5>{{__('Review')}}</h5>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th><i class="ti-bag" aria-hidden="true"></i></th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Product')}}</th>
                                        <th>{{__('Price')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                    <tr>
                                        <td class="action">

                                        </td>
                                        <td class="cart_product_img">
                                            <a href="#"><img src="{{ asset('storage/'.$item->model->image) }}"
                                                    alt="Product"></a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5>{{ $item->model->name }}</h5>
                                        </td>
                                        <td class="price"><span>{{ $item->subtotal }} L.E</span></td>
                                        <td class="qty">
                                            <div class="quantity">
                                                {{ $item->qty }}
                                            </div>
                                        </td>
                                        <td class="total_price"><span>{{$item->price}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td><strong>{{ Cart::total() }} L.E</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="checkout_pagination mt-50">
                        <a href="#" @click.prevent="hidereview" class="btn bigshop-btn">{{__('Go Back')}}</a>
                        <a href="#" onclick="event.preventDefault();document.getElementById('billing-form').submit();"
                            class="btn bigshop-btn">{{__('Confirm')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <<<<<<<<<<<<<<<<<<<< Checkout Area End >>>>>>>>>>>>>>>>>>>> -->
</div>
@endsection
@section('extra-js')
<script src="https://unpkg.com/vue"></script>
<script>
    const app = new Vue({
        el: '#checkout',
        data() {
            return {
                billing: true,
                review: false,
                showAttendContent: false,
                showExpensesContent: false,
                payment: '',
            }
        },
        methods: {
            hideBilling() {
                this.billing = false
                this.review = true
            },
            hidereview() {
                this.billing = true
                this.review = false
            }
        }
    })

</script>
@endsection
@section('extra-css')
<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter,
    .fade-leave-to

    /* .fade-leave-active below version 2.1.8 */
        {
        opacity: 0;
    }

</style>
@endsection
