<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()->user_type == 3) {
        //     return redirect()->route('landingPage');
        // }

        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop');
        }

        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }
        return view('vendor.ezp.checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        // Check race condition when there are less items available to purchase
        try {
            $order = $this->addToOrdersTables($request, null);
            // dd($order);
            // Mail::send(new OrderPlaced($order));
            // decrease the quantities of all the products in the cart
            Cart::instance('default')->destroy();
            return redirect()->route('confirmation.index', [$order])->with([
                'success_message' => __('Thank you! Your order has been successfully accepted!')]);
        } catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'city_id' => $request->city,
            'billing_phone' => $request->phone,
            'billing_subtotal' => Cart::total(),
            'billing_tax' => Cart::tax(),
            'billing_total' => Cart::total(),
            'payment_gateway' => 1,
            'error' => $error,
            'status' => 1,
        ]);
        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }
        return $order;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function distributor(Request $request)
    {
        $user = auth()->user();
        if ($user && $user->user_type == 3) {
            // Insert into orders table
            $order = Order::create([
                'user_id' => $user->id,
                'user_type' => $user->user_type,
                'billing_email' => $user->email,
                'billing_name' => $user->name,
                'billing_address' => $user->address,
                'city_id' => $user->city_id,
                'billing_phone' => $user->phone,
                'billing_subtotal' => Cart::total(),
                'billing_tax' => Cart::tax(),
                'billing_total' => Cart::total(),
                'payment_gateway' => 1,
                'error' => '',
            ]);
            // Insert into order_product table
            foreach (Cart::content() as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty,
                ]);
            }
        } else {
            return redirect()->back()->with(['warning_message' => __('You are not a distributor or not authorized')]);
        }
        Cart::instance('default')->destroy();
        return redirect()->route('confirmation.index', [$order])->with(['success_message' => __('Thank you! Your order has been successfully accepted!')]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
