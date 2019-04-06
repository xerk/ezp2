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
                                    <td>
                                        @if ($order->status == 1)
                                            <span class="text-primary">{{__('Pending')}}</span>
                                        @elseif ($order->status === 2)
                                           <span class="text-success"> {{__('Complated')}}</span>
                                        @else
                                            <span class="text-danger">{{__('Cancelled')}}</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('orders.show', $order->id) }}">{{__('Details')}}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        <!-- <<<<<<<<<<<<<<<<<<<< Cart Area End <<<<<<<<<<<<<<<<<<<< -->
            </div>

            @include('vendor.ezp.partials.menu-profile')
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< My Profile Area End >>>>>>>>>>>>>>>>>>>>>>>> -->
@endsection
