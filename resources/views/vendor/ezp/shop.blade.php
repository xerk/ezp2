@extends('vendor.ezp.layout')
@section('title', __('Shop'))
@section('content')
<!-- ***** Quick View Modal Area Start ***** -->
<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img">
                                    <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                    <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span class="badge-new">New</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview_pro_des">
                                    <h4 class="title">Boutique Silk Dress</h4>
                                    <div class="top_seller_product_rating mb-15">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="price">$120.99 <span>$130</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita
                                        quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium
                                        eligendi, in fugiat?</p>
                                    <a href="#">View Full Product Details</a>
                                </div>
                                <!-- Add to Cart Form -->
                                <form class="cart" method="post">
                                    <div class="quantity">
                                        <span class="qty-minus"
                                            onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12"
                                            name="quantity" value="1">
                                        <span class="qty-plus"
                                            onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="cart-submit">Add to
                                        cart</button>
                                    <!-- Wishlist -->
                                    <div class="modal_pro_wishlist">
                                        <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                    </div>
                                    <!-- Compare -->
                                    <div class="modal_pro_compare">
                                        <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                    </div>
                                </form>

                                <div class="share_wf mt-30">
                                    <p>Share With Friend</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Quick View Modal Area End ***** -->

<section class="shop_grid_area section_padding_100_70">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="shop_sidebar_area">
                    <div class="widget catagory mb-30">
                        <h6 class="widget-title">Product Categories</h6>
                        <div class="widget-desc">
                            <div class="custom-control custom-radio d-flex align-items-center mb-2">
                                <input type="radio" onclick='window.location.assign("{{route("shop")}}")'
                                    {{ (route("shop") == Request::fullUrl() ? 'checked' : '') }}
                                    class="custom-control-input" name="company" id="all">
                                <label class="custom-control-label" for="all">All Companies <span
                                        class="text-muted">({{App\Product::count()}})</span></label>
                            </div>
                            @foreach ($companies as $company)
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-radio d-flex align-items-center mb-2">
                                <input type="radio"
                                    onclick='window.location.assign("{{route("shop", ["company" => $company->id])}}")'
                                    {{ (route("shop", ["company" => $company->id]) == Request::fullUrl() ? 'checked' : '') }}
                                    class="custom-control-input" name="company" id="{{$company->name}}">
                                <label class="custom-control-label" for="{{$company->name}}">{{$company->name}} <span
                                        class="text-muted">({{$company->products_count}})</span></label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9">
                <div class="shop_grid_product_area">
                    <div class="shop_top_sidebar_area mb-30">
                        <div class="view_area d-inline-block">
                            <div class="grid_view d-inline-block"><a href="shop-grid-left-sidebar.html"><i
                                        class="fa fa-th" aria-hidden="true"></i></a></div>
                            <div class="list_view ml-15 d-inline-block"><a href="shop-list-left-sidebar.html"><i
                                        class="fa fa-th-list" aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single_product_area mb-30">
                                <div class="single_arrivals_slide">
                                    <div class="product_image">
                                        <!-- Product Image -->
                                        <img class="normal_img" src="{{ asset('storage/'. $product->image) }}" alt="">
                                        <img class="hover_img" src="{{ asset('storage/'. $product->image) }}" alt="">

                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                        <!-- Add to cart -->
                                        <div class="product_add_to_cart">
                                            <a href="{{ route('cart.store', $product) }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('cart-form-{{$product->id}}').submit();"><i class="ti-shopping-cart" aria-hidden="true"></i> Add to
                                                Cart</a>
                                        </div>
                                            <form id="cart-form-{{$product->id}}" action="{{ route('cart.store', $product) }}" method="POST" style="display: none;">
                                                    @csrf
                                            </form>
                                        <!-- Quick View -->
                                        <div class="product_quick_view">
                                            <a href="#" data-toggle="modal" data-target="#product-{{ $product->id }}"><i class="ti-eye"
                                                    aria-hidden="true"></i> Quick View</a>
                                        </div>
                                    </div>
                                    <!-- Product Description -->
                                    <div class="product_description">
                                        <p class="brand_name">Top</p>
                                        <h5><a href="#">{{ $product->name }}</a></h5>
                                        <h6>{{ $product->price }} <span>{{ $product->price }}</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="shop_pagination_area">
                    <nav aria-label="Page navigation">
                        {{$products->links('vendor.pagination.bootstrap-4')}}
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
