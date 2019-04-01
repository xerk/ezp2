@extends('vendor.ezp.layout')
@section('title', __('Homepage'))
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
        <a :class="{'active': billing, 'complated': review}" href="checkout-2.html"><i class="ti-check"></i> {{__('Billing')}}</a>
        <a :class="{'active': review}" href="checkout-5.html"><i class="ti-check"></i> {{__('Review')}}</a>
    </div>

    <!-- <<<<<<<<<<<<<<<<<<<< Checkout Area Start >>>>>>>>>>>>>>>>>>>> -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row" v-show="billing">
                <div class="col-12">
                    <div class="checkout_details_area mt-50 clearfix">
                        <h5>{{__('Billing Details')}}</h5>
                        <form action="{{ route('checkout.store') }}" method="POST" id="billing-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" id="first_name" name="billing_name" placeholder="Full Name"
                                        value="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_address">{{__('Email Address')}}</label>
                                    <input type="email" class="form-control" name="billing_email" id="email_address"
                                        placeholder="{{__('Email Address')}}" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">{{__('Phone Number')}}</label>
                                    <input type="number" class="form-control" id="phone_number" name="billing_phone" placeholder="{{__('Phone Number')}}" min="0" value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city">{{__('City')}}</label>
                                    <select class="custom-select d-block w-100" name="city_id" id="city">
                                        @foreach (App\City::all() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="street_address">{{__('Street address')}}</label>
                                    <input type="text" class="form-control" name="billing_address" id="street_address"
                                        placeholder="{{__('Street Address')}}" value="">
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
                        <a href="checkout-complate.html" onclick="event.preventDefault();document.getElementById('billing-form').submit();" class="btn bigshop-btn">{{__('Confirm')}}</a>
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
