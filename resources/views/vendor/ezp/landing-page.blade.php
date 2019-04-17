@extends('vendor.ezp.layout')
@section('title', __('Home'))
@section('content')
@include('vendor.ezp.partials.slider')
<!-- ***** New Arrivals Area Start ***** -->
<section class="new_arrivals_area section_padding_50 clearfix">
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
        {{-- <div class="row">
            <div class="col-12">
                <div class="section_heading new_arrivals">
                    <h5>{{__('Brands')}}</h5>
    </div>
    </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="new_arrivals_slides">
                @foreach (App\Company::all() as $item)
                <!-- Singel Arrivals Slide Start -->
                <div class="single_arrivals_slide">
                    <a href="{{ route('shop', [ 'company' => $item->id ]) }}" class="product_image">
                        <!-- Product Image -->
                        <img class="normal_img" width="128" src="{{ asset('storage/'. $item->image)}}" alt="">

                        <!-- Product Badge -->
                        <div class="product_badge">
                            <span class="badge-new">{{ $item->name }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
<!-- ***** New Arrivals Area End ***** -->
<!-- ***** Best Rated/Onsale/Top Sale Area Start ***** -->
<section class="best_rated_onsale_top_sellares home-2 section_padding_50" dir="rtl">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tabs_area">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="product-tab">
                        <li class="nav-item">
                            <a href="#on-sale" class="nav-link active" data-toggle="tab" role="tab">Featured</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="on-sale">
                            <div class="on_sale_area">
                                <div class="row">
                                    @foreach (App\Product::where('featured', true)->take(8)->inRandomOrder()->get() as
                                    $item)
                                    <div class="col-6 col-md-6 col-lg-3">
                                        <div class="single_top_sellers">
                                            <div class="top_seller_image">
                                                <!-- Product Image -->
                                                <img width="100%" src="{{ asset('storage/'.$item->image) }}" alt="">

                                                <!-- Wishlist -->
                                                <div class="product_wishlist">
                                                    <a href="{{ route('map.index') }}" target="_blank"><i class="ti-location-pin"></i> {{ __('Distributor locations') }}</a>
                                                </div>
                                                <!-- Add to cart -->
                                                @auth
                                                @if (Auth::user()->user_type == 3)
                                                <div class="product_add_to_cart">
                                                    <a href="{{ route('cart.store', $item) }}"
                                                        onclick="event.preventDefault();document.getElementById('cart-form-{{$item->id}}').submit();"><i
                                                            class="ti-shopping-cart" aria-hidden="true"></i>
                                                        {{__('Buy as Distributor')}}</a>
                                                </div>
                                                <form id="cart-form-{{$item->id}}"
                                                    action="{{ route('cart.store', $item) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                @else
                                                <div class="product_add_to_cart">
                                                    <a href="{{ route('cart.store', $item) }}"
                                                        onclick="event.preventDefault();document.getElementById('cart-form-{{$item->id}}').submit();"><i
                                                            class="ti-shopping-cart" aria-hidden="true"></i>
                                                        {{__('Add to Cart')}}</a>
                                                </div>
                                                <form id="cart-form-{{$item->id}}"
                                                    action="{{ route('cart.store', $item) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                @endif
                                                @else
                                                <div class="product_add_to_cart">
                                                    <a href="{{ route('cart.store', $item) }}"
                                                        onclick="event.preventDefault();document.getElementById('cart-form-{{$item->id}}').submit();"><i
                                                            class="ti-shopping-cart" aria-hidden="true"></i>
                                                        {{__('Add to Cart')}}</a>
                                                </div>
                                                <form id="cart-form-{{$item->id}}"
                                                    action="{{ route('cart.store', $item) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                @endauth
                                            </div>
                                            <!-- Product Description -->
                                            <div class="top_seller_desc">
                                                <h5><a href="#">{{ $item->name }}</a></h5>
                                                <p>{{ $item->company->name }}</p>
                                                <h6>{{ $item->price }} <span>{{ $item->price }}</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Best Rated/Onsale/Top Sale Area End ***** -->

<!-- ***** Popular Brands Area Start ***** -->
<section class="popular_brands_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular_section_heading mb-30">
                    <h5>{{__('Popular Brands')}}</h5>
                </div>
            </div>
            <div class="col-12">
                <div class="popular_brands_slide">
                    @foreach (App\Company::all() as $item)
                    <div class="single_brands filter-grey">
                        <img src="{{ asset('storage/'. $item->image)}}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- ***** Popular Brands Area End ***** -->
@section('extra-css')
<style>
    .filter-grey {
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
    }

</style>
@endsection
