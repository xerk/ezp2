@extends('vendor.ezp.layout')
@section('title', __('Homepage'))
@section('content')
    <!-- ***** Breadcumb Area Start ***** -->
    <div class="breadcumb_area bg-img background-overlay-white" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Breadcumb Area End ***** -->
<!-- ***** Cart Area Start ***** -->
<div class="cart_area section_padding_100 clearfix">
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
                <div class="cart-table clearfix">
                    @if (Cart::instance('default')->count() > 0)
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $item)
                                <tr>
                                    <td class="action">
                                        <a href="{{ route('cart.destroy', $item->rowId) }}"
                                            onclick="event.preventDefault();document.getElementById('cart-form-{{$item->rowId}}').submit();"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        <form id="cart-form-{{$item->rowId}}"
                                            action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
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
                                            <select class="quantity form-control" data-id="{{ $item->rowId }}"
                                                data-productQuantity="{{ $item->qty }}">
                                                @for ($i = 1; $i < 5 + 1 ; $i++) <option
                                                    {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </td>
                                    <td class="total_price"><span>$49.88</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total (tax incl.)</td>
                                    <td>{{ Cart::total() }} L.E</td>
                                </tr>
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><strong>{{ Cart::subtotal() }} L.E</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>

                <div class="cart-footer d-flex mt-30">
                    @if (Cart::instance('default')->count() > 0)
                        <div class="back-to-shop w-50">
                            <a href="{{ route('shop') }}" class="btn bigshop-btn"><i class="fa fa-undo"
                                    aria-hidden="true"></i> Back to Shopping</a>
                        </div>
                        <div class="update-checkout w-50 text-right">
                            {{-- <a href="#" class="btn bigshop-btn">Update Cart</a> --}}
                            <a href="{{ route('checkout.index') }}" class="btn bigshop-btn">Checkout</a>
                        </div>
                    @else
                        <div class="update-checkout w-100 text-center">
                            <h1>Not item in your cart</h1>
                        </div>
                        <div class="update-checkout w-100 text-center">
                        <a href="{{ route('shop') }}" class="btn bigshop-btn  justify-content-center"><i class="fa fa-undo"
                            aria-hidden="true"></i> Back to Shopping</a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
<!-- ***** Cart Area End ***** -->
@endsection
@section('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    (function () {
        const classname = document.querySelectorAll('.quantity')
        Array.from(classname).forEach(function (element) {
            element.addEventListener('change', function () {
                const id = element.getAttribute('data-id')
                const productQuantity = element.getAttribute('data-productQuantity')
                axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        // console.log(error);
                        window.location.href = '{{ route('cart.index') }}'
                    });
            })
        })
    })();

</script>
@endsection
