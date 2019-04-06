@extends('vendor.ezp.layout')
@section('title', __('Orders List'))
@section('content')
<!-- <<<<<<<<<<<<<<<<<<<< My Profile Area Start >>>>>>>>>>>>>>>>>>>>>>>> -->
<div class="my_profile_area section_padding_100">
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

            <div class="col-12 col-md-9 cart_area order_list_area">
                <!-- <<<<<<<<<<<<<<<<<<<< Cart Area Start <<<<<<<<<<<<<<<<<<<< -->

                <div class="cart-table clearfix">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Items')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                    <td class="cart_product_desc">
                                        <h5>{{$order->products_count}}</h5>
                                    </td>
                                    <td class="price"><span>{{$order->billing_total}} L.E</span></td>
                                    <td>Complated</td>
                                    <td><a href="{{ route('orders.show', $order->id) }}">Details</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        <!-- <<<<<<<<<<<<<<<<<<<< Cart Area End <<<<<<<<<<<<<<<<<<<< -->
            </div>

            <div class="col-12 col-md-3">
                <div class="sidebar_widget_menu">
                    <nav id="sidebar_wid_menu">
                        <ul>
                            <li><a href="{{route('users.edit')}}"><i class="ti-user"></i> {{__('My Profile')}}</a></li>
                            <li><a href="#"><i class="ti-menu"></i> {{__('Orders List')}}</a></li>
                            {{-- <li><a href="#"><i class="ti-headphone-alt"></i> Support</a></li> --}}
                            <li><a href="#"><i class="ti-lock"></i> {{__('Logout')}}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< My Profile Area End >>>>>>>>>>>>>>>>>>>>>>>> -->
@endsection
