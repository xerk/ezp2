@extends('vendor.ezp.layout')
@section('title', __('Homepage'))
@section('content')
@include('vendor.ezp.partials.slider')
<!-- ***** New Arrivals Area Start ***** -->
<section class="new_arrivals_area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading new_arrivals">
                    <h5>{{__('Brands')}}</h5>
                </div>
            </div>
        </div>
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
<!-- ***** New Arrivals Area Start ***** -->
<div class="new_arrival home-3 section_padding_70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="popular_section_heading mb-50 text-center">
                    <h5>{{__('POPULAR Cards')}}</h5>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach (App\Product::where('featured', true)->take(8)->inRandomOrder()->get() as $item)
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="single_popular_item">
                        <div class="product_image">
                            <!-- Product Image -->
                            <img class="first_img" src="{{ asset('storage/'.$item->image) }}" alt="">

                            <!-- Add to cart -->
                            <div class="product_add_to_cart">
                                    <a href="{{ route('cart.store', $item) }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('cart-form-{{$item->id}}').submit();"><i class="ti-shopping-cart" aria-hidden="true"></i> Add to
                                        Cart</a>
                                </div>
                                    <form id="cart-form-{{$item->id}}" action="{{ route('cart.store', $item) }}" method="POST" style="display: none;">
                                            @csrf
                                    </form>
                        </div>
                        <!-- Product Description -->
                        <div class="product_description">
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
<!-- ***** New Arrivals Area End ***** -->
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
