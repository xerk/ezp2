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

            <div class="col-12 col-md-9" dir="rtl">
                <div class="order-products pb-3">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{__('Name')}}</td>
                                <td>{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <td>{{__('Address')}}</td>
                                <td>{{ $order->billing_address }}</td>
                            </tr>
                            <tr>
                                <td>{{__('City')}}</td>
                                <td>{{ $order->city->name }}</td>
                            </tr>
                            <tr>
                                <td>{{__('Total')}}</td>
                                <td>{{ $order->billing_total }}</td>
                            </tr>
                            <tr>
                                    <td>{{__('Status')}}</td>
                                    <td>
                                        @if ($order->status == 1)
                                            <span class="text-primary">{{__('Pending')}}</span>
                                        @elseif ($order->status === 2)
                                           <span class="text-success"> {{__('Complated')}}</span>
                                        @else
                                            <span class="text-danger">{{__('Cancelled')}}</span>
                                        @endif
                                    </td>
                                </tr>
                            <tr>
                                <td>{{__('Comment')}}</td>
                                <td>{{ $order->comment }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-3 text-center">
                        <div><img style="height: 256px;" src="{{ Voyager::image($product->image) }}"
                                alt="Product Image"></div>
                        <div class="py-3">
                            <div>
                                <span>{{__('Name') }}: {{ $product->name }}</span>
                            </div>
                            <div>{{__('Price')}}: {{ $product->price }}</div>
                            <div>{{__('Quantity')}}: {{ $product->pivot->quantity }}</div>
                            <div>{{__('Pin Code')}}: {{ $product->pivot->pin_code }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            @include('vendor.ezp.partials.menu-profile')
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< My Profile Area End >>>>>>>>>>>>>>>>>>>>>>>> -->
@endsection
